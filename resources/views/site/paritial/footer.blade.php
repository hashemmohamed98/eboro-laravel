@section('footer')
    <!-- Footer -->
    <footer class="footer blue-bg text-white mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <h3 class="bold text-white mb-3">{{trans('public.footer.about_title')}}</h3>
                    <p class="m-0 text-white line-height-1-6 regular">
                        {{trans('public.footer.about_caption')}}
                    </p>
                </div>
                <div class="col-lg-5 text-center">
                    <h3 class="bold text-white mb-3">{{trans('public.footer.links_title')}}</h3>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="{{asset('/')}}" class="text-white l-hover">{{trans('public.navbar.home')}}</a>
                        </li>
                        {{--                        <li class="mb-2">--}}
                        {{--                            <a href="{{asset('category-grid')}}" class="text-white l-hover">{{trans('public.navbar.category')}}</a>--}}
                        {{--                        </li>--}}
                        <li class="mb-2">
                            <a href="{{asset('aboutus')}}" class="text-white l-hover">{{trans('public.navbar.about')}}</a>
                        </li>
                        <li class="mb-2">
                            <a href="{{asset('/contact')}}" class="text-white l-hover">{{trans('public.navbar.contact')}}</a>
                        </li>
                        <li class="mb-2">
                            <a href="{{asset('/privacy')}}" class="text-white l-hover">{{trans('public.footer.privacy')}}</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h3 class="bold text-white mb-3">{{trans('public.become_seller')}}</h3>
                    <div class="d-flex flex-column justify-content-center">
                        <p>{{trans('public.footer.newsletter_p')}}</p>
                        <form action="{{url('subscribe')}}" method="post">
                            @csrf
                            <div class="input-group in-footer">
                                <img src="{{asset('svg-icons/emailaddress.svg')}}" width="30" alt="">
                                <input type="email" class="form-control placeholder-gray bg-transparent" name="email" required
                                       placeholder="{{trans('public.footer.placeholder')}}">
                                @if(!empty($errors))
                                    @if($errors->any())
                                        @foreach($errors->all() as $error)
                                            <span class="invalid-feedback border-danger  alert-danger"
                                                  role="alert"><strong>{{ $error }}</strong></span>
                                        @endforeach
                                    @endif
                                @endif
                                <div class="btn-subscribe" type="submit">
                                    <i class="fa fa-paper-plane"></i>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="copy-right red-bg pt-3">
        <div class="container">
            <div class="row">
                <div class="col-md-6 d-flex align-items-center flex-center-mob">
                    <div class="bold text-white">&copy; {{trans('public.footer.copyright')}}</div>
                </div>
                <div class="col-md-6">
                    <ul class="list-unstyled d-flex justify-content-end flex-center-mob p-0 m-0">
                        <li class="social-links"><a href="{{$share_setting->facebook}}" class="text-white"><i class="fab fa-facebook-f"></i></a></li>
                        <li class="social-links"><a href="{{$share_setting->twitter}}" class="text-white"><i class="fab fa-twitter"></i></a></li>
                        <li class="social-links"><a href="{{$share_setting->linkedin}}" class="text-white"><i class="fab fa-linkedin-in"></i></a></li>
                        <li class="social-links"><a href="{{$share_setting->youtube}}" class="text-white"><i class="fab fa-youtube"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="btn-scroll-top">
            <img src="{{asset('svg-icons/scrollbutton.svg')}}" alt="">
        </div>
    </div>

    <!-- POPUP Advertise -->
    {{--    <div class="pop-wrapper advertise-pop">--}}
    {{--        <div class="container">--}}
    {{--            <div class="pop-banner">--}}
    {{--                <div class="pop-content">--}}
    {{--                    <div class="pop-close">--}}
    {{--                        <i class="fas fa-times-circle"></i>--}}
    {{--                    </div>--}}
    {{--                    <div class="pop-text">--}}
    {{--                        <h2 class="red-color bold">--}}
    {{--                            {{trans('public.advertise.title')}}--}}
    {{--                            </h2>--}}
    {{--                        <h3 class="blue-color bold">--}}
    {{--                            {{trans('public.advertise.subtitle')}}--}}
    {{--                        </h3>--}}
    {{--                        <div class="input-group mb-2 cust-input width-400 mx-auto">--}}
    {{--                            <input type="text" class="form-control placeholder-gray" placeholder="{{trans('public.footer.placeholder')}}">--}}
    {{--                            <div class="input-group-prepend">--}}
    {{--                                <button class="btn blue-bg text-white btn-successmsg" data-open="alert-successfuly-message" data-close="advertise-pop">{{trans('public.submit')}}</button>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="custom-control custom-checkbox my-1 mr-sm-2 text-left">--}}
    {{--                            <input type="checkbox" class="filter-input custom-control-input nosee-again" id="dont" name="type" value="all">--}}
    {{--                            <label class="custom-control-label" for="dont">{{trans('public.advertise.dont_show')}}--}}
    {{--                            </label>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <img src="{{asset('images/pop-image.jpg')}}" style="width:100%;height:70vh" alt="">--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}

    <!-- POPUP SignIn -->
    <div class="pop-wrapper-sign sign-login">
        <div class="pop-content card card-box-shadow border-0 pb-5" style="width:40%; min-height:350px">
            <div class="d-flex sign-btns-container mb-4">
                <div class="sign-btn sign-in-box-btn bold font-size-30 cursor-pointer active" data-signing="sign-in-box">
                    {{trans('public.signIn.sign_in')}}
                </div>
                <div class="sign-btn sign-up-box-btn bold font-size-30 cursor-pointer" data-signing="sign-up-box">
                    {{trans('public.signIn.sign_up')}}
                </div>
            </div>
            <div class="pop-text-sign px-4">
                <form id="sign-in" action="{{route('login')}}" class="RLogin" enctype="multipart/form-data">
                    <div id="sign-in-box" class="sign-form" style="display:none;">
                        <div class="form-group sign-input">
                            <input type="text" name="email" class="form-control placeholder-gray"
                                   placeholder="{{trans('public.signIn.email')}}">
                        </div>
                        <div class="form-group sign-input">
                            <input type="password" name="password" class="form-control placeholder-gray"
                                   placeholder="{{trans('public.signIn.password')}}">
                        </div>
                        <div class="d-flex justify-content-between align-items-center form-group">
                            <a href="#" class="light-grey l-hover forget_pass">{{trans('public.signIn.forget_password')}}</a>
                        </div>
                        <div class="d-flex justify-content-center align-items-center register-errors">
                            <div class="spinner-border text-danger d-none" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <button type="submit" class="btn red-bg text-white btn-lg">{{trans('public.navbar.login')}}</button>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <ul class="list-unstyled d-flex justify-content-end flex-center-mob p-0 m-0">
                                    <li class="social-links"><a href="{{ url('/login/facebook') }}" class="text-secondary"><i class="fab fa-facebook-f"></i></a></li>
                                    <li class="social-links"><a href="{{ url('/login/google') }}" class="text-primary"><i class="fab fa-google"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </form>
                <form id="forget_password" action="{{asset('api/forgetPassword')}}" class="RLogin">
                    <div id="forget_password-box" class="sign-form" style="display:none;">
                        <div class="form-group sign-input">
                            <input type="text" name="email" class="form-control placeholder-gray"
                                   placeholder="{{trans('public.signIn.email')}}">
                        </div>
                        <div class="d-flex justify-content-center align-items-center register-errors">
                            <div class="spinner-border text-danger d-none" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <button type="submit" class="btn red-bg text-white btn-lg">{{trans('public.navbar.login')}}</button>
                    </div>
                </form>
                <form id="sign-up" action="{{asset('api/register')}}" class="RLogin">
                    <div id="sign-up-box" class="sign-form">
                        <div class="form-group sign-input">
                            <input type="text" name="name" class="form-control placeholder-gray"
                                   placeholder="{{trans('public.signup.name')}}">
                        </div>
                        <div class="form-group sign-input">
                            <input type="email" name="email" class="form-control placeholder-gray"
                                   placeholder="{{trans('public.signup.email')}}">
                        </div>
                        <div class="form-group sign-input">
                            <input type="number" name="mobile" class="form-control placeholder-gray"
                                   placeholder="{{trans('public.signup.mobile')}}">
                        </div>
                        <div class="form-group sign-input">
                            <input type="text" name="address" class="form-control placeholder-gray"
                                   placeholder="{{trans('public.signup.address')}}">
                        </div>
                        <div class="form-group sign-input">
                            <input type="password" name="password" class="form-control placeholder-gray"
                                   placeholder="{{trans('public.signup.password')}}">
                        </div>
                        <div class="form-group sign-input">
                            <input type="password" name="password_confirmation" class="form-control placeholder-gray"
                                   placeholder="{{trans('public.signup.confirm_password')}}">
                        </div>
                        <div class="form-group sign-input">
                            <input type="file" name="image" class="form-control placeholder-gray dropify">
                        </div>
                        <div class="d-flex justify-content-center align-items-center register-errors">
                            <div class="spinner-border text-danger d-none" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <button type="submit" class="btn red-bg text-white btn-lg">{{trans('public.navbar.signup')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="alert-successfuly-message" role="alert" style="display:none;">
        <div class="success-message">
            <div class="success-img">
                <img src="{{asset('svg-icons/Successfull.svg')}}" alt="">
            </div>
            <span class="bold">{{trans('public.success_alert')}}</span>
        </div>
    </div>
    <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Organization",
      "name": "Eboro",
      "url": "{{asset('/')}}",
      "telephone": "(+000) 0000 0000",
      "email": "email@example.com",
      "sameAs" : [ "facebooklink" ]
    }
    </script>
@endsection
