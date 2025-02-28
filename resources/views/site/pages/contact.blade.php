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

        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDkJLdDZLd7eDqrcbSTcvlb6JJzNxs4oik&callback=initMap&libraries=&v=weekly"
                defer></script>

        <style>
            #map {
                height: 100%;
            }
        </style>
</head>
<body>
<main id="homepage">
    <!-- Start Navbar -->
    @yield('Nav')
    <!-- End Navbar -->
    <main id="contactus">
        <div class="contact-banner overlay">
            <div class="container height-100-per">
                <div class="zindex d-flex flex-column align-items-center justify-content-center height-100-per">
                    <div class="width-100-per mb-2">
                        <h1 class="bold text-white text-center">{{trans('public.navbar.contact')}}</h1>
                    </div>
                    <div class="zindex breadcrumb-menu text-white d-flex align-items-center">
                        <div class="font-size-30"><a href="#" class="text-white"><i class="fas fa-home font-size-30"></i></a></div>
                        <div class="mx-3 font-size-20"><i class="fas fa-caret-right"></i></div>
                        <div class="font-size-25">{{trans('public.navbar.contact')}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="contact-info">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <div class="contact-card  mb-5 red-bg text-center car4-box-shadow border-radius-20 px-5 py-4 c-height">
                            <div class="contact-icon">
                                <img src="../assets/svg-icons/con-emi.svg" width="35" alt="">
                            </div>
                            <h3 class="text-white bold mt-3">{{trans('public.contact.email')}}</h3>
                            {!! $share_setting->contact_email_1 !!}
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <div class="contact-card red-bg text-center car4-box-shadow border-radius-20 px-5 py-4 c-height  mb-5">
                            <div class="contact-icon">
                                <img src="../assets/svg-icons/con-emi.svg" width="35" alt="">
                            </div>
                            <h3 class="text-white bold mt-3">{{trans('public.contact.email')}}</h3>
                            {!! $share_setting->contact_email_2 !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="contact-card  mb-5 red-bg text-center car4-box-shadow border-radius-20 px-5 py-4 c-height">
                            <div class="contact-icon">
                                <img src="../assets/svg-icons/con-emi.svg" width="35" alt="">
                            </div>
                            <h3 class="text-white bold mt-3">{{trans('public.contact.email')}}</h3>
                            {!! $share_setting->contact_email_3 !!}
                        </div>
                    </div>
                </div>
                <div class="map-container my-5" style="height: 500px;">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </main>
    <!-- Start Footer -->
    @yield('footer')
    <!-- End Footer -->
</main>
@yield('script')
<script>
    let map;

    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: -34.397, lng: 150.644 },
            zoom: 8
        });
    }
</script>
</body>
</html>
