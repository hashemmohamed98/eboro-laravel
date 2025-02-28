@include('site.paritial.include')
<!DOCTYPE html>
<html>
<head>
    @yield('SEO')
    <meta property="og:title" content="Eboro privacy policy" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://eboro.it/privacy" />
    <!-- TITLE TAG -->
    <title>Eboro Page</title>
    <!-- LINK TAGS -->
    @yield('home')
    <!-- FONTS TAGS -->
    @yield('font')
</head>
<body>
<main id="homepage">
    <!-- Start Navbar -->
    @yield('Nav')
    <!-- End Navbar -->

    <main id="privacy">

        <div class="contact-banner overlay">
            <div class="container height-100-per">
                <div class="zindex d-flex flex-column align-items-center justify-content-center height-100-per">
                    <div class="width-100-per mb-2">
                        <h1 class="bold text-white text-center">{{trans('public.terms_title')}}</h1>
                    </div>
                    <div class="zindex breadcrumb-menu text-white d-flex align-items-center">
                        <div class="font-size-30"><a href="#" class="text-white"><i class="fas fa-home font-size-30"></i></a></div>
                        <div class="mx-3 font-size-20"><i class="fas fa-caret-right"></i></div>
                        <div class="font-size-25">{{trans('public.terms_title')}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="mt-3 width-100-per">

                <h2 class="pb-3 bold">{{trans('public.terms_title')}}</h2>

                <p>{!! $share_setting->{'privacy_'.session('lang')} !!}</p>
            </div>
        </div>


    </main>

    <!-- Start Footer -->
    @yield('footer')
    <!-- End Footer -->
</main>
@yield('script')
</body>
</html>
