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

    <main id="page404">

        <div class="container">
            <div class="mt-3 width-100-per">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="red-color" style="font-size:12vw">5</div>
                    <div class="red-color" style="font-size:12vw">0</div>
                    <div class="red-color" style="font-size:12vw">0</div>
                </div>
                <div class="text-uppercase red-color text-center" style="font-size:4vw">OPS! <span class="red-color bold font-size-30 text-center mb-3 align-middle">Server Internal Error </span></div>

                <div class="text-center">
                    <a href="{{asset('contact')}}" class="btn red-bg text-white btn-lg">contact us </a>
                </div>
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
