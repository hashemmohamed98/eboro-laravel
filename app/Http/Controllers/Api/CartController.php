<?php

namespace App\Http\Controllers\Api;


use App\Http\Requests\CartRequest;
use App\Http\Requests\ProductSauceRequest;
use App\Http\Resources\CartRescource;
use App\Mealoffer;
use App\Offer;
use App\Promocode;
use App\Repository\BranchProductRepository;
use App\Repository\CartRepository;
use App\Repository\ProductSauceRepository;
use App\Services\ApiResponseService;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class CartController extends Controller
{
    protected $ProductSauceRepo;
    protected $ProductRepo;
    protected $cartRepo;
    protected $apiResponse;

    public function __construct(CartRepository $cartRepo, BranchProductRepository $ProductRepo, ProductSauceRepository $ProductSauceRepo, ApiResponseService $apiResponse)
    {
        $this->ProductSauceRepo = $ProductSauceRepo;
        $this->ProductRepo = $ProductRepo;
        $this->cartRepo = $cartRepo;
        $this->apiResponse = $apiResponse;
    }

    public function add(CartRequest $request)
    {
        $product = $this->ProductRepo->getById($request->product_id);
        $time = Carbon::now();

        // Fetching offer for the product
        $productOffer = Offer::where(["product_id" => $product->id])
            ->whereDate('start_at', '<=', $time)
            ->whereDate('end_at', '>=', $time)
            ->first();

        // Calculate total price for the product
        $totalProductPrice = $product->price;
        if ($productOffer) {
            $totalProductPrice -= ($productOffer->value / 100) * $totalProductPrice;
        }

        // Fetching offers for each sauce ID and calculating total sauce price
        $sauceOffers = [];
        $totalSaucePrice = 0;
        $sauceIds = $request->sauce_ids ?? [];
        foreach ($sauceIds as $sauceId) {
            $sauce = $this->ProductRepo->getById($sauceId);
            $sauceOffer = Offer::where(["product_id" => $sauce->id])
                ->whereDate('start_at', '<=', $time)
                ->whereDate('end_at', '>=', $time)
                ->first();

            $saucePrice = $sauce->price;
            if ($sauceOffer) {
                $saucePrice -= ($sauceOffer->value / 100) * $saucePrice;
            }

            $sauceOffers[$sauceId] = $sauceOffer;
            $totalSaucePrice += $saucePrice;
        }


        // Calculate total price considering the product price, sauce prices, and quantity
        $totalPrice = ($totalProductPrice + $totalSaucePrice) * ($request->qty ?? 1);

        // Creating or updating cart item for sauce IDs
        $this->cartRepo->updateOrCreate(
            [
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
                'sauce_ids' => $sauceIds
            ],
            [
                'qty' => \DB::raw("IFNULL(qty, 0) + " . ($request->qty ?? 1)),
                'price' => $totalPrice
            ]
        );


        // Fetching cart items and calculating total price and quantity
        $cartItems = $this->cartRepo->where('user_id', auth()->id())->get();
        $totalPrice = $cartItems->sum('price');
        $totalQty = $cartItems->sum('qty');

        $res['cart_items'] = CartRescource::collection($cartItems);
        $res['total_price'] = $totalPrice;
        $res['total_qty'] = $totalQty;

        return $this->apiResponse->setSuccess(trans('admin.done'))->setData($res)->setCode(200)->send();
    }


    public function get()
    {
        $res['cart_items']=CartRescource::collection(auth()->user()->carts);
        $res['total_price']=auth()->user()->carts->sum('price');
        $res['total_qty']=auth()->user()->carts->sum('qty');
        return $this->apiResponse->setSuccess(trans('admin.done'))->setData($res)->setCode(200)->send();
    }

    public function delete($id)
    {
        $cart = $this->cartRepo->find($id);
        if ($cart) {
            $this->cartRepo->delete($id);
            return $this->apiResponse->setSuccess(trans('admin.deleted'))->setCode(200)->send();
        } else {
            return $this->apiResponse->setError(trans('admin.not_found'))->setCode(404)->send();
        }
    }

    public function rest()
    {
        $this->cartRepo->with('product', 'product', 'sauce')->where('user_id', auth()->id())->delete();
        return $this->apiResponse->setSuccess(trans('admin.deleted'))->setCode(200)->send();
    }
}
