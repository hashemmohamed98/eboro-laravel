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
    <div class="download-banner overlay my-5">
        <div class="container zindex pt-5">
            <div class="row align-items-center">
                <div class="col-md-6 text-white">
                    <div>
                        <h2 class="bold">{{trans('public.download_title')}}</h2>
                        <a href="{{$share_setting->android_link}}" target="_blank">
                            <button class="btn-downloaded btn bg-black text-white d-flex align-items-center px-4 mb-3 border-radius-10">
                                <img class="lazy" data-src="svg-icons/googleplay.svg" style="width:35px;"
                                     alt="">
                                <div class="ml-3">
                                    <span
                                        class="text-uppercase font-size-12">{{trans('public.app_caption_android')}}</span>
                                    <div class="font-size-30 bold">Google play</div>
                                </div>
                            </button>
                        </a>
                        <a href="{{$share_setting->iOS_link}}" target="_blank">
                            <button class="btn-downloaded btn bg-black text-white d-flex align-items-center px-4 border-radius-10">
                                <img class="lazy" data-src="svg-icons/applelogo.svg" style="width:35px;"
                                     alt="">
                                <div class="ml-3">
                                    <span class="text-uppercase font-size-12">{{trans('public.app_caption_ios')}}</span>
                                    <div class="font-size-30 bold">App Store</div>
                                </div>
                            </button>
                        </a>
                    </div>
                </div>
                <div class="col-md-6" style="margin-bottom:0 !important">
                    <img class="lazy" data-src="images/mob-download.png" style="width:100%" alt="">
                </div>
            </div>
        </div>
    </div>
<!-- Start Footer -->
@yield('footer')
<!-- End Footer -->
</main>
@yield('script')

<script>
    $(document).ready(function () {
        let userAgent = navigator.userAgent || navigator.vendor || window.opera;

        if (userAgent.toLowerCase().includes("huawei") || userAgent.toLowerCase().includes("android")) {
            document.location.href = 'market://details?id=com.codiano.eboro';
        } else if (userAgent.toLowerCase().includes("iphone") || userAgent.toLowerCase().includes("ipad")) {
            document.location.href = 'itms-apps://itunes.apple.com/app/id1626529297';
        }
    });
</script>
</body>
</html>
