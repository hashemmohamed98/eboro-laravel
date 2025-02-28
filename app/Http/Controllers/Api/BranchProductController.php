<?php

namespace App\Http\Controllers\Api;


use App\Helper\UploadImages;
use App\Http\Requests\BranchProductRequest;
use App\Http\Requests\EditBranchProductRequest;
use App\Http\Requests\FilterBranchProductRequest;
use App\Http\Requests\ProviderBranchRequest;
use App\Http\Resources\BranchProductRescource;
use App\Http\Resources\SaucesRescource;
use App\Models\BranchProduct;
use App\Offer;
use App\Repository\BranchProductRepository;
use App\Repository\MealofferRepository;
use App\Repository\OfferRepository;
use App\Services\ApiResponseService;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class BranchProductController extends Controller
{
    protected $apiResponse;
    protected $ProductOfferRepo;
    protected $Product_Meal_offerRepo;
    protected $branchProductRepo;

    public function __construct(BranchProductRepository $branchProductRepo,OfferRepository $ProductOfferRepo,MealofferRepository $Product_Meal_offerRepo, ApiResponseService $apiResponse)
    {
        $this->branchProductRepo = $branchProductRepo;
        $this->ProductOfferRepo = $ProductOfferRepo;
        $this->Product_Meal_offerRepo = $Product_Meal_offerRepo;
        $this->apiResponse = $apiResponse;
    }

    public function create(BranchProductRequest $request)
    {
        $data = $request->except('image','value','start_at','end_at');
        if ($request->image)
        {
            $data['image']=UploadImages::upload($request->image,'Product');
        }
        $this->branchProductRepo->create($data);
        return $this->apiResponse->setSuccess(trans('admin.created'))->setCode(200)->send();
    }

    public function edit(EditBranchProductRequest $request, $id)
    {
        $product=$this->branchProductRepo->getById($id);
        $data=$request->except('image','value','start_at','end_at');
        if ($request->image){
            $old=$product->image?public_path('uploads/Product/'.$product->image):'';
            $data['image']=UploadImages::upload($request->image,'Product',$old);
        }
        if ($request->value)
        {
            $Offered = Offer::where('product_id' ,$id)->first();
            $Offer['value'] = $request->value;
            $Offer['start_at'] = $request->start_at;
            $Offer['end_at']= $request->end_at;
            if($Offered)
            {
                $this->ProductOfferRepo->update($Offered->id,$Offer);
            }
            else
            {
                $Offer['product_id'] = $id;
                $Offer['branch_id'] = $product->branch->id;
                $Offer['provider_id'] = $product->branch->provider->id;
                $this->ProductOfferRepo->create($Offer);
            }
        }

        if ($request->position) {
            $new_position = 1;
            foreach ($this->branchProductRepo->where("branch_id" , $product->branch->id)->orderBy('position', 'asc')->get() as $product) {
                if ($product['id'] == $id) {
                    $product['position'] = (int) $request->position;
                    $product->save();
                } elseif ($new_position >= $request->position) {
                    $new_position++;
                    $product['position'] = $new_position;
                    $product->save();
                } else {
                    $product['position'] = $new_position;
                    $new_position++;
                    $product->save();
                }
            }
        }

        if ($request->start_outofstock)
        {
            $now = Carbon::now()->addDay(1);
            $start_date = Carbon::parse($request->start_outofstock);
            $end_date = Carbon::parse($request->end_outofstock);

            if($start_date <= $now && $now <= $end_date) {
                $data['has_outofstock'] = 1;
            }else{
                $data['has_outofstock'] = 0;
            }
        }
        $this->branchProductRepo->update($id, $data);
        return $this->apiResponse->setSuccess(trans('admin.updated'))->setCode(200)->send();
    }

    public function filter(FilterBranchProductRequest $request)
    {
        $product=$this->branchProductRepo->with('branch','sauces','sauces.sauce');
        if (isset($request->name)){
            $product=$product->where('name','like','%'.$request->name.'%');
        }
        if (isset($request->type)){
            $product=$product->where('type',$request->type);
        }
        if (isset($request->product_type)){
            $product=$product->where('product_type',$request->product_type);
        }
        if (isset($request->price_to)){
            $product=$product->where('price','<=',$request->price_to);
        }
        if (isset($request->price_from)){
            $product=$product->where('price','>=',$request->price_from);
        }
        if (isset($request->branch_id)){
            $product=$product->where('branch_id',$request->branch_id)->orderBy('position', 'asc');
        }
        if (isset($request->provider_id)){
            $product=$product->whereHas('branch',function ($q) use ($request){
                $q->where('provider_id',$request->provider_id);
            })->orderBy('position', 'asc');
        }

        foreach ($product->get() as $item)
        {
            if ($item->start_outofstock)
            {
                $now = Carbon::now()->addDay(1);
                $start_date = Carbon::parse($item->start_outofstock);
                $end_date = Carbon::parse($item->end_outofstock);

                if($start_date <= $now && $now <= $end_date) {
                    BranchProduct::where(["id" => $item->id])->update(['has_outofstock' => 1]);
                }else{
                    BranchProduct::where(["id" => $item->id])->update(['has_outofstock' => 0]);
                }
            }
        }
        $product=$product->get();
        return $this->apiResponse->setData(BranchProductRescource::collection($product))->setCode(200)->send();
    }

    public function getById($id)
    {
        $branch = $this->branchProductRepo->with('branch','sauces','sauces.sauce')->find($id);
        if ($branch) {
            return $this->apiResponse->setData(new BranchProductRescource($branch))->setCode(200)->send();
        } else {
            return $this->apiResponse->setError(trans('admin.not_found'))->setCode(404)->send();
        }
    }

    public function delete($id)
    {
        $branch = $this->branchProductRepo->find($id);
        if ($branch) {
            $this->branchProductRepo->delete($id);
            return $this->apiResponse->setSuccess(trans('admin.deleted'))->setCode(200)->send();
        } else {
            return $this->apiResponse->setError(trans('admin.not_found'))->setCode(404)->send();
        }
    }

    public function productSauce($id)
    {
        $product=$this->branchProductRepo->with('sauces')->find($id);
        return $this->apiResponse->setData(SaucesRescource::collection($product->sauces))->setCode(200)->send();
    }

    public function newProducts()
    {
        $products=$this->branchProductRepo->with('branch','sauces','sauces.sauce')->orderBy('id','desc')->take(15)->get();
        return $this->apiResponse->setData(BranchProductRescource::collection($products))->setCode(200)->send();
    }

    public function mostSellProducts()
    {
        $products= $this->branchProductRepo->with('sales')->get()->sortBy(function ($q){
                $q->sales->count();
        })->take(15);
        return $this->apiResponse->setData(BranchProductRescource::collection($products))->setCode(200)->send();
    }
}
