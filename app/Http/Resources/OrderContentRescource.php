<?php

namespace App\Http\Resources;

use App\Models\BranchProduct;
use App\Offer;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderContentRescource extends JsonResource
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
            'product' => new BranchProductRescource($this->product),
            'sauce' => null,
            'sauces' => [],
            'price' => round($this->price ,2).'',
            'comment' => $this->comment,
            'qty' => $this->qty,
        ];

        if ($this->sauce_ids && count($this->sauce_ids) > 0) {
            foreach ($this->sauce_ids as $sauceId) {
                $sauce = BranchProduct::where(["id" => $sauceId])->first();
                $time = Carbon::now();
                $sauceOffer = Offer::where(["product_id" => $sauceId])
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
