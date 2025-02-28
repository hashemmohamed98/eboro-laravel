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
                    <div class="img mb-3"><img src="{{asset('images/Successfull.svg')}}" alt=""></div>
                    <h2 class="successfull display-4 mb-3">Congratulations</h2>
                    <p class="text-secondary mb-3">Order places successfully </p>
                </div>
                <a class="btn blue-bg text-white d-inline-block py-2 px-5" href="{{asset('/')}}">Back to Homepage</a>
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
