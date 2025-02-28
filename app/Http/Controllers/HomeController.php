<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductSauceRequest;
use App\Models\CommentLike;
use App\Models\Favorite;
use App\Models\Provider;
use App\Models\Rate;
use App\Repository\CommentLikeRepository;
use App\Repository\CommentRepository;
use App\Repository\FavoriteRepository;
use App\Repository\RateRepository;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Stripe\Token;
use Tymon\JWTAuth\Facades\JWTAuth;

class HomeController extends Controller
{

    protected $RateRepo;
    protected $FavoriteResponse;
    protected $CommentResponse;
    protected $CommentLikeResponse;

    public function __construct(RateRepository $RateRepo,FavoriteRepository $FavoriteResponse ,CommentLikeRepository $CommentLikeResponse , CommentRepository $CommentResponse)
    {
        $this->RateRepo = $RateRepo;
        $this->FavoriteResponse = $FavoriteResponse;
        $this->CommentResponse = $CommentResponse;
        $this->CommentLikeResponse = $CommentLikeResponse;
    }

    public function lang($lang)
    {
        if (in_array($lang, ['it', 'en']))
        {
            if (session()->has('lang'))
            {
                session()->forget('lang');
            }
            session()->put('lang', $lang);
            App::setLocale($lang);
        }
        return back();
    }

    public function logout()
    {
        auth()->logout();
        return back();
    }


    public function Rate($provider ,$stars)
    {
        $Rate = Rate::where(["provider_id" => $provider , "user_id" => auth()->id()])->first();
        $data['provider_id'] = $provider;
        $data['value'] = $stars;
        $data['user_id'] = auth()->id();
        if($Rate)
        {
            $this->RateRepo->update($Rate->id , $data);
        }
        else
        {
            $this->RateRepo->create($data);
        }
        return back();
    }
    public function Favorite($provider)
    {
        $Favorite = Favorite::where(["provider_id" => $provider , "user_id" => auth()->id()])->first();
        $data['provider_id'] = $provider;
        $data['user_id'] = auth()->id();
        if($Favorite)
        { $this->FavoriteResponse->delete($Favorite->id); }
        else
        { $this->FavoriteResponse->create($data);}
        return back();
    }

    public function Comment(Request $request , $product)
    {
        $data['product_id'] = $product;
        $data['comment'] = $request->comment;
        $data['user_id'] = auth()->id();
        $this->CommentResponse->create($data);
        return back();
    }

    public function CommentLike($comment)
    {
        $CommentLike = CommentLike::where(["comment_id" => $comment , "user_id" => auth()->id()])->first();
        $data['comment_id'] = $comment;
        $data['user_id'] = auth()->id();
        if($CommentLike)
        { $this->CommentLikeResponse->delete($CommentLike->id); }
        else
        { $this->CommentLikeResponse->create($data);}

        return back();
    }

}
