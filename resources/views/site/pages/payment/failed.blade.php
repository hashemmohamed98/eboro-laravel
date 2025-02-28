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
        <div class="section py-5">
            <div class="container text-center">
                <div class="row flex-column text-center">
                    <div class="img mb-3"><img src="{{asset('images/Order%20Failed.svg')}}" alt=""></div>
                    <h2 class="red-rate mb-3">OOPS! <br> Payment Failed</h2>
                    <p class="text-secondary mb-3">Payment for order couldn't be proceed. Try again later</p>
                </div>
                <a class="btn red-bg text-white d-inline-block py-2 px-5" href="{{asset('/')}}">Back to checkout</a>
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
