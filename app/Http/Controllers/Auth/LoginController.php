<?php

namespace App\Http\Controllers\Auth;

use App\Helper\AppleToken;
use App\Helper\RandomCode;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Image;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */


    use AuthenticatesUsers;


    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->to('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirect_facebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handle_Facebook_allback()
    {
        try
        {
            try {
                $facebookUser = Socialite::driver('facebook')->stateless()->user();
            }
            catch (Exception $e) {

                return $e->getMessage();
            }

            $existUser = User::where('email',$facebookUser->email)->first();
            if($existUser)
            {
                if($existUser->active == 1)
                {
                    auth()->loginUsingId($existUser->id);
                }
                else
                {
                    abort(422, "Account deletion error: The account has been deleted.");
                }
            }
            else
            {
                $user = new User;
                $user->name = $facebookUser->name;
                $user->email = $facebookUser->email;
                $user->facebook_id = $facebookUser->id;

                $path = $facebookUser->getAvatar();
                $filename = sha1(random_int(1, 5000) * (float)microtime()) . '.' . "jpg";
                Image::make($path)->save(public_path('uploads/User/' . $filename));
                $user->image = $filename;

                $user->password = bcrypt(RandomCode::getToken(8));
                $user->email_verified_at = Carbon::now();
                $user->type = 0;
                $user->save();
                auth()->loginUsingId($user->id);
            }
            return redirect()->to('/');
        }
        catch (Exception $e)
        {
            return 'error';
        }
    }

    public function redirect_google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handle_google_allback()
    {
        try
        {
            $googleUser = Socialite::driver('google')->stateless()->user();
            $existUser = User::where('email',$googleUser->email)->first();
            if($existUser)
            {
                if($existUser->active == 1)
                {
                    auth()->loginUsingId($existUser->id);
                }
                else
                {
                    abort(422, "Account deletion error: The account has been deleted.");
                }
            }
            else
            {
                $user = new User;
                $user->name = $googleUser->name;
                $user->email = $googleUser->email;
                $user->google_id = $googleUser->id;

                $path = $googleUser->getAvatar();
                $filename = sha1(random_int(1, 5000) * (float)microtime()) . '.' . "jpg";
                Image::make($path)->save(public_path('uploads/User/' . $filename));
                $user->image = $filename;

                $user->password = bcrypt(RandomCode::getToken(8));
                $user->email_verified_at = Carbon::now();
                $user->type = 0;
                $user->save();
                auth()->loginUsingId($user->id);
            }
            return redirect()->to('/');
        }
        catch (Exception $e)
        {
            return 'error';
        }
    }

    public function handle_apple_callback()
    {
        //config()->set('services.apple.client_secret', $appleToken->generate());

        $socialiteUser = Socialite::driver("apple")->stateless()->user();
        $existUser = User::where('apple_id',$socialiteUser->getId())->first();

        if($existUser)
        {
            if($existUser->active == 1)
            {
                auth()->loginUsingId($existUser->id);
            }
            else
            {
                abort(422, "Account deletion error: The account has been deleted.");
            }

        }
        else
        {
            $user = new User;
            $user->name = $socialiteUser->getName() ?? "";
            $user->email = $socialiteUser->getEmail();
            $user->apple_id = $socialiteUser->getId();

            $user->password = bcrypt(RandomCode::getToken(8));
            $user->email_verified_at = Carbon::now();
            $user->type = 0;
            $user->save();
            auth()->loginUsingId($user->id);
        }

        return redirect()->to('/');
    }

    public function redirect_apple()
    {
        return Socialite::driver('apple')->redirect();
    }
}
