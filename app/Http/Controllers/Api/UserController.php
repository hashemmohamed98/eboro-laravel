<?php

namespace App\Http\Controllers\Api;

use App\Helper\RandomCode;
use App\Helper\UploadImages;
use App\Helper\UsersType;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\EditBranchStaaffRequest;
use App\Http\Requests\EditProfileRequest;
use App\Http\Requests\ForgetPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserSocialRegisterRequest;
use App\Http\Requests\VerifyEmailRequest;
use App\Http\Resources\BranchRescource;
use App\Http\Resources\FavoriteRescource;
use App\Http\Resources\RateRescource;
use App\Http\Resources\UserRescource;
use App\Mail\VerfiyMail;
use App\Models\User;
use App\Notifications\VerifiedCode;
use App\Repository\BranchStaffRepository;
use App\Repository\UserRepository;
use App\Services\ApiAuthService;
use App\Services\ApiResponseService;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Psy\Util\Json;
use Image;
use AppleSignIn\ASDecoder;


class UserController extends Controller
{
    protected $userRepo;
    protected $apiResponse;
    protected $userAuth;
    protected $branchStaffRepo;
    public function __construct(BranchStaffRepository $branchStaffRepo,UserRepository $userRepo, ApiResponseService $apiResponse, ApiAuthService $userAuth)
    {
        $this->userRepo = $userRepo;
        $this->userAuth = $userAuth;
        $this->apiResponse = $apiResponse;
        $this->branchStaffRepo = $branchStaffRepo;
    }

    public function register(UserRegisterRequest $request)
    {

        $user = $this->userRepo->register($request->validated());
        if(isset($request->flag))
        {
            try {
                $datar = base64_decode($request->base64Image);
                $filenames = sha1(random_int(1, 5000) * (float)microtime()) . '.' . $request->fileNames;
                file_put_contents(public_path().'/uploads/User/'.$filenames,$datar);
                $data['image'] = $filenames;
                $this->userRepo->update($user->id,$data);
            }catch (\Exception $r)
            {

            }
        }
        if(!isset($user['type']))
            $user['type'] = UsersType::Client;

        //Mail::to($user->email)->send(new VerfiyMail($user));
        $data['token'] = $this->userAuth->getUserToken($user);
        $data['user'] = new UserRescource($user);
        auth()->login($user);
        return $this->apiResponse->setData($data)->setCode(200)->send();
    }

    public function Re_verify()
    {
        if (auth()->check()) {
            auth()->user()->verify_code=RandomCode::getToken(6);
            auth()->user()->save();
            Mail::to(auth()->user()->email)->send(new VerfiyMail(auth()->user()));
            return $this->apiResponse->setSuccess(trans('api.verification_send'))
                ->setData('cc')->setCode(200)->send();
//            auth()->user()->verify_code
        }
    }

    public function verifyEmail(VerifyEmailRequest $request)
    {
        if (auth()->check()) {
            if(auth()->user()->verify_code == $request["verify_code"])
            {
                auth()->user()->email_verified_at=Carbon::now();
                auth()->user()->verify_code=null;
                auth()->user()->save();
                $res['token'] = $this->userAuth->getUserToken(auth()->user());
                $res['user'] = new UserRescource(auth()->user());
                return $this->apiResponse->setSuccess(trans('api.thanks'))->setData($res)->setCode(200)->send();
            }
            else
            {
                return $this->apiResponse->setError(trans('api.verification_code_error'))->setCode(406)->send();
            }
        } else {
            return $this->apiResponse->setError(trans('api.unauthorized'))->setCode(401)->send();
        }

    }

    public function login(UserLoginRequest $request)
    {
        if ($token = $this->userAuth->login($request->validated())) {
            $data['token'] = $token;
            $data['user'] = new UserRescource(auth()->user());
            if(auth()->user()->active == 0)
            {
                abort(422, "Account deletion error: The account has been deleted.");
            }
            return $this->apiResponse->setData($data)->setCode(200)->send();
        } else {
            return $this->apiResponse->setError(trans('api.login_error'))->setCode(422)->send(422);
        }
    }
//    public function it_is_permitted_for_apple()
//    {
//        $token = app(Configuration::class)
//            ->parser()
//            ->parse(app(AppleToken::class)->generate());
//
//        $this->assertTrue($token->isPermittedFor('https://appleid.apple.com'));
//    }
//
    public function socialLogin(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $flag = $request->flag;
        if ($flag == 3) {
            $appleSignInPayload = ASDecoder::getAppleSignInPayload($request->socialid);
            $user = User::where('apple_id', $appleSignInPayload->sub)->first();
            $request->name = $request->name??$appleSignInPayload->email;
            $request->email = $appleSignInPayload->email."apple";
            $request->socialid = $appleSignInPayload->sub;
        }

        if ($user) {
            auth()->loginUsingId($user->id);
            $data['token'] = auth()->user()->generateAuthToken();
            $data['user'] = new UserRescource(auth()->user());
            return $this->apiResponse->setData($data)->setCode(200)->send();
        } else {
            $user = new User;
            if ($flag == 1) {
                $user->google_id = $request->socialid;
            } elseif ($flag == 2) {
                $user->facebook_id = $request->socialid;
            } elseif ($flag == 3) {
                $user->apple_id = $request->socialid;
            }

            if ($request->image!="null") {
                $path = $request->image;
                $filename = sha1(random_int(1, 5000) * (float)microtime()). '.'. "jpg";
                Image::make($path)->save(public_path('uploads/User/'. $filename));
                $user->image = $filename;
            }

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt(RandomCode::getToken(8));
            $user->email_verified_at = Carbon::now();
            $user->type = 0;
            $user->save();

            auth()->loginUsingId($user->id);
            $data['token'] = auth()->user()->generateAuthToken();
            $data['user'] = new UserRescource(auth()->user());
            return $this->apiResponse->setData($data)->setCode(200)->send();
        }

    }


    public function changePassword(ChangePasswordRequest $request)
    {
        if (auth()->check()) {
            if ($this->userRepo->checkPassword(auth()->user(), $request->validated())) {
                return $this->apiResponse->setSuccess(trans('api.password_changed'))->setCode(200)->send();
            } else {
                return $this->apiResponse->setError(trans('api.password_error'))->setCode(406)->send();
            }
        } else {
            return $this->apiResponse->setError(trans('api.unauthorized'))->setCode(401)->send();
        }
    }

    public function logout()
    {
        auth()->logout();
        return $this->apiResponse->setSuccess(trans('admin.logout'))->setCode(200)->send();
    }

    public function forgetPassword(ForgetPasswordRequest $request)
    {
        if ($user = $this->userRepo->where('email', $request->email)->first()) {
            $user->verify_code = RandomCode::getToken(6);
            $user->save();
            $data['message']=trans('admin.verify_code_message') . $user->verify_code;
            Notification::send($user,new VerifiedCode($data));
            return $this->apiResponse->setSuccess(trans('api.verification_send'))
                ->setData($user->verify_code)->setCode(200)->send();
        } else {
            return $this->apiResponse->setError(trans('api.email_not_found'))->setCode(406)->send();
        }
    }

    public function userDetails()
    {
        $user=auth()->user();
        if($user){
            return $this->apiResponse->setData(new UserRescource($user))->setCode(200)->send();
        }else{
            return $this->apiResponse->setError(trans('api.unauthorized'))->setCode(401)->send();
        }
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        if ($user = $this->userRepo->where('email', $request->email)->first()) {
            if ($user->verify_code == $request->verify_code) {
                $user->password = bcrypt($request->password);
                $user->verify_code = null;
                $user->save();
                $res['token'] = $this->userAuth->getUserToken($user);
                $res['user'] = new UserRescource($user);
                return $this->apiResponse->setSuccess(trans('api.password_changed'))
                    ->setData($res)->setCode(200)->send();
            } else {
                return $this->apiResponse->setError(trans('api.verification_code_error'))->setCode(406)->send();
            }
        } else {
            return $this->apiResponse->setError(trans('api.email_not_found'))->setCode(406)->send();
        }
    }

    public function editProfile(EditProfileRequest $request)
    {
        $data = $request->except('password', 'image');

        if ($request->image) {
            $old = (auth()->user()->image) ?public_path('uploads/User/' . auth()->user()->image):'';
            $data['image'] = UploadImages::upload($request->image, 'User', $old);
        }
        if(isset($request->flag))
        {
            $datar = base64_decode($request->base64Image);
            $filenames = sha1(random_int(1, 5000) * (float)microtime()) . '.' . $request->fileNames;
            file_put_contents(public_path().'/uploads/User/'.$filenames,$datar);
            $data['image'] = $filenames;
            $this->userRepo->update(auth()->id(),$data);
        }
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        $user = $this->userRepo->update(auth()->id(), $data);
        $res['token'] = $this->userAuth->getUserToken($user);
        $res['user'] = new UserRescource($user);
        return $this->apiResponse->setSuccess(trans('admin.done'))->setData($res)->setCode(200)->send();
    }

     public function editLocation(Request $request)
    {
        $data = $request->only('house', 'intercom', 'mobile');
        $user = $this->userRepo->update(auth()->id(), $data);
        $res['token'] = $this->userAuth->getUserToken($user);
        $res['user'] = new UserRescource($user);
        return $this->apiResponse->setSuccess(trans('admin.done'))->setData($res)->setCode(200)->send();
    }

    public function edit(Request $request, $id)
    {
        $user = $this->userRepo->find($id);
        $data = $request->except('password', 'image','front_id_image','back_id_image','license_image','license_expire');
        if ($request->image) {
            $old = ($user->image) ?public_path('uploads/User/' . $user->image):'';
            $data['image'] = UploadImages::upload($request->image, 'User', $old);
        }
        if(isset($request->flag))
        {
            $datar = base64_decode($request->base64Image);
            $filenames = sha1(random_int(1, 5000) * (float)microtime()) . '.' . $request->fileNames;
            file_put_contents(public_path().'/uploads/User/'.$filenames,$datar);
            $data['image'] = $filenames;
            $this->userRepo->update(auth()->id(),$data);
        }
        if ($request->front_id_image) {
            $old = ($user->front_id_image) ?public_path('uploads/Delivery/' . $user->front_id_image):'';
            $data['front_id_image'] = UploadImages::upload($request->front_id_image, 'Delivery', $old);
        }
        if ($request->back_id_image) {
            $old = ($user->back_id_image) ?public_path('uploads/Delivery/' . $user->back_id_image):'';
            $data['back_id_image'] = UploadImages::upload($request->back_id_image, 'Delivery', $old);
        }
        if ($request->license_image) {
            $old = ($user->license_image) ?public_path('uploads/Delivery/' . $user->license_image):'';
            $data['license_image'] = UploadImages::upload($request->license_image, 'Delivery', $old);
        }
        if ($request->license_expire) {
            $old = ($user->license_expire) ?public_path('uploads/Delivery/' . $user->license_expire):'';
            $data['license_expire'] = UploadImages::upload($request->license_expire, 'Delivery', $old);
        }
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        $update_user = $this->userRepo->update($user->id, $data);
        $data = [];
        $staff = $this->branchStaffRepo->where('user_id' , $update_user->id)->first();
        if($staff)
        {
            if($request['branch_id'])
                $this->branchStaffRepo->update($staff->id, $request->only('type','branch_id'));
            else
                $this->branchStaffRepo->delete($staff->id);
        }
        else
        {
            if($request['branch_id']) {
                $data = $request->only('type','branch_id');
                $data['user_id']=$user->id;
                $this->branchStaffRepo->create($data);
            }
        }
        return $this->apiResponse->setSuccess(trans('admin.updated'))->setCode(200)->send();
    }

    public function delete(Request $request, $id)
    {
        $user = $this->userRepo->find($id);
        if($user)
        {
            $data['active'] = 0;
            $this->userRepo->update($id ?? auth()->id(),$data);
        }
        return $this->apiResponse->setSuccess(trans('admin.updated'))->setCode(200)->send();
    }

    public function userBranches()
    {
        $branches=auth()->user()->provider->branch;
        return $this->apiResponse->setData(BranchRescource::collection($branches))->setCode(200)->send();
    }

    public function favorite()
    {
        $favs=auth()->user()->Favorite;
        return $this->apiResponse->setData(FavoriteRescource::collection($favs))->setCode(200)->send();
    }

    public function Rates()
    {
        $Rates=auth()->user()->Rate;
        return $this->apiResponse->setData(RateRescource::collection($Rates))->setCode(200)->send();
    }

}
