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
    <!-- Start Navbar -->
@yield('Nav')
<!-- End Navbar -->
    <section id="forgetpassword-9" class="with-wave">
        <div class="container sp-m">
            <div class="red-color mb-5">
            </div>
            <div class="main-forms d-flex align-items-center justify-content-center flex-column height-50-view width-60-per">
                <form action="{{asset('api/verifyEmail')}}" class="RLogin">
                    @csrf
                    <h2 class="red-color mb-3 font-weight-normal">{{trans('passwords.forget.title')}}</h2>
                    <div class="card box-shadow border-0 border-radius" style="background-color: #EEE;">
                        <div class="card-body p-5">
                            <p class="font-weight-bold">{{trans('passwords.forget.code_caption')}} {{auth()->user()->email}}</p>
                            <div class="mb-1 font-weight-normal">{{trans('passwords.forget.code_caption2')}} "{{auth()->user()->email}}"</div>
                            <input type="text" name="verify_code" class="form-control box-shadow border-0 mb-4 reset-input">
                            <div class="d-flex justify-content-center align-items-center register-errors">
                                <div class="spinner-border text-danger d-none" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                            <button type="submit" class="btn red-bg text-white btn-md">{{trans('passwords.forget.continue')}}</button>
                            <button type="button" action="{{asset('api/send_verifyEmail')}}" class="btn red-bg text-white btn-md float-right RSend">Resend</button>
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
