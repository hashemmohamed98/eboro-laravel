@include('site.paritial.include')
    <!DOCTYPE html>
<html>

<head>
@yield('SEO')
<!-- TITLE TAG -->
    <title>Eboro Page</title>
    <!-- LINK TAGS -->
@yield('home')
<!-- FONTS TAGS -->
    @yield('font')

    <style>
        .reset-input:focus {
            background-color: #fff !important;
            border: 1px solid var(--red-color) !important;
        }
    </style>

</head>

<body>
<main id="homepage">
    <section id="forgetpassword-8">
        <div class="container sp-m text-center">
            <div class="red-color mb-5">
            </div>
            <div class="main-forms mb-5 d-flex align-items-center justify-content-center flex-column width-60-per">
                <form action="{{asset('api/resetPassword')}}" method="POST" id="reset-password" class="w-50 RLogin">
                    <h2 class="red-color mb-3 font-weight-normal">{{trans('passwords.forget.title')}}</h2>
                    <div class="card box-shadow border-0 border-radius" style="background: #EEE">
                        <div class="card-body p-5">
                            <p class="font-weight-bold red-color">{{trans('passwords.forget.reset_p')}}</p>
                            <input type="email" name="email" placeholder="{{trans('passwords.forget.email_paceholder')}}" class="form-control box-shadow border-0 mb-4 reset-input">
                            <input type="text" name="verify_code" placeholder="{{trans('passwords.forget.code')}}" class="form-control box-shadow border-0 mb-4 reset-input">
                            <input type="password" name="password" placeholder="{{trans('passwords.forget.new_password')}}" class="form-control box-shadow border-0 mb-4 reset-input">
                            <input type="password" name="password_confirmation" placeholder="{{trans('passwords.forget.confirm_password')}}" class="form-control box-shadow border-0 mb-4 reset-input">
                            <div id="register-errors" class="d-flex justify-content-center align-items-center">
                                <div class="spinner-border text-danger d-none" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                            <button type="submit" class="btn red-bg text-white btn-md mr-5">{{trans('passwords.forget.continue')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Start Footer -->
@yield('footer')
<!-- End Footer -->
</main>
@yield('script')
</body>
</html>
