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
</head>
<body>
<main id="homepage">
    <!-- Start Navbar -->
@yield('Nav')
<!-- End Navbar -->

    <main id="pagelock">
        <div class="container">
            <div class="mt-3 width-100-per">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="red-color" style="font-size:12vw">L</div>
                    <div class="red-color" style="font-size:12vw">o</div>
                    <div class="red-color" style="font-size:12vw">c</div>
                    <div class="red-color" style="font-size:12vw">k</div>
                </div>
                <div class="text-uppercase red-color text-center" style="font-size:4vw">Hint! <span class="red-color bold font-size-30 text-center mb-3 align-middle">{!! $setting->{'state_message_'.app()->getLocale()} !!}</span></div>


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
