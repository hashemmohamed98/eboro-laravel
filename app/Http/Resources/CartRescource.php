<?php

namespace App\Http\Resources;

use App\Models\BranchProduct;
use App\Offer;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CartRescource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {

        $res = [
            'id' => $this->id,
            'product_name' => $this->product->name,
            'provider_id' => $this->product->branch->provider_id,
            'product_image' => url('public/uploads/Product/' . $this->product->image),
            'product_price' => $this->product->price,
            'product_id' => $this->product->id,
            'qty' => $this->qty,
            'price' => round($this->price, 2),
        ];
        $res['sauces'] = array();

        if (count($this->sauce_ids) > 0) {
            foreach ($this->sauce_ids as $sauceId) {
                $sauce = BranchProduct::where(["id" => $sauceId])->first();
                $time = Carbon::now();
                $sauceOffer = Offer::where(["product_id" => $sauce->id])
                    ->whereDate('start_at', '<=', $time)
                    ->whereDate('end_at', '>=', $time)
                    ->first();

                $saucePrice = $sauce->price;
                if ($sauceOffer) {
                    $saucePrice -= ($sauceOffer->value / 100) * $saucePrice;
                }

                $res['sauces'][] = [
                    'id' => $sauce->id,
                    'name' => $sauce->name,
                    'image' => url('public/uploads/Product/' . $sauce->image),
                    'price' => $saucePrice,
                ];
            }
        }

        return $res;

    }
}
