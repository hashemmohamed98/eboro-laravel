<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function setCookie(Request $request, $ID=null, $minutes=null ,$QTY=null , $COLOR=null,$SIZE=null,$WEIGHT=null)
    {
        return redirect()->back();
    }

    public function CreateCartArray(Request $request)
    {
        $Products = json_decode(\Cookie::get('ProductsA'), true);
        if ($request->isMethod('post'))
        {
            $Products[$request->input('ID').$request->input('Color').$request->input('Size').$request->input('Weight')] =
                [
                    'ID'=>$request->input('ID'),
                    'QTY'=>$request->input('quantity'),
                    'COLOR'=>$request->input('Color'),
                    'SIZE'=>$request->input('Size'),
                    'WEIGHT'=>$request->input('Weight'),
                ];
            \Cookie::queue(\Cookie::make('ProductsA', json_encode($Products), 4320));
        }
        return redirect()->back();
    }
    public function RemoveCartArray(Request $request, $ID=null ,$Color=null ,$Size=null ,$Weight=null )
    {
        $Products = json_decode(\Cookie::get('ProductsA'), true);
        unset($Products[$ID.$Color.$Size.$Weight]);
        \Cookie::queue(\Cookie::make('ProductsA', json_encode($Products), 4320));
        return redirect()->back();
    }

    public function getCookie(Request $request)
    {
        $Product=\Cookie::get('ProductsA');
        return response()->json(json_decode($Product));
    }

}
