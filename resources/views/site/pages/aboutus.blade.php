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

    <main id="aboutus">

        <div class="contact-banner overlay">
            <div class="container height-100-per">
                <div class="zindex d-flex flex-column align-items-center justify-content-center height-100-per">
                    <div class="width-100-per mb-2">
                        <h1 class="bold text-white text-center">{{trans('public.navbar.about')}}</h1>
                    </div>
                    <div class="zindex breadcrumb-menu text-white d-flex align-items-center">
                        <div class="font-size-30"><a href="#" class="text-white"><i class="fas fa-home font-size-30"></i></a></div>
                        <div class="mx-3 font-size-20"><i class="fas fa-caret-right"></i></div>
                        <div class="font-size-25">{{trans('public.navbar.about')}}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="ourstory py-5">
            <div class="container">
                <h2 class="text-center red-color bold mb-5">{{trans('public.about_us.story_title')}}</h2>
                <div class="row">
                    <div class="col-md-12">
                        <p>{!! $share_setting->{'about_'.session('lang')} !!}</p>
                    </div>
                </div>
            </div>
        </div>

{{--        <div class="dialy-offer py-5 overlay d-flex align-items-center">--}}
{{--            <div class="container">--}}
{{--                <div class="dialy-info zindex">--}}
{{--                    <h2 class="text-white bold text-center mb-5">{{trans('public.about_us.daily_title')}}</h2>--}}
{{--                    <p class="text-white">{{trans('public.about_us.daily_caption')}}</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="whyeboro py-5">--}}
{{--            <div class="container">--}}
{{--                <h2 class="red-color bold text-center mb-5">{{trans('public.about_us.why_title')}}</h2>--}}
{{--                <table class="table table-hover table-striped table-middle text-left font-size-15 mb-0 w-50 mx-auto">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th scope="col" class="border-top-0">{{trans('public.about_us.table_title')}}</th>--}}
{{--                        <th scope="col" class="border-top-0">{{trans('public.about_us.table_description')}}</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    <tr class="border-bottom">--}}
{{--                        <th scope="row">{{trans('public.about_us.table_name')}}</th>--}}
{{--                        <td class="bold">Eboro</td>--}}
{{--                    </tr>--}}
{{--                    <tr class="border-bottom">--}}
{{--                        <th scope="row">{{trans('public.about_us.table_estable')}}</th>--}}
{{--                        <td class="bold">Soon</td>--}}
{{--                    </tr>--}}
{{--                    <tr class="border-bottom">--}}
{{--                        <th scope="row">{{trans('public.about_us.table_iva')}}</th>--}}
{{--                        <td class="bold">10340450963</td>--}}
{{--                    </tr>--}}
{{--                    <tr class="border-bottom">--}}
{{--                        <th scope="row">{{trans('public.about_us.table_address')}}</th>--}}
{{--                        <td class="bold">Italia Sede legalevial lario 7/20159</td>--}}
{{--                    </tr>--}}
{{--                    <tr class="border-bottom">--}}
{{--                        <th scope="row">{{trans('public.about_us.table_phone')}}</th>--}}
{{--                        <td class="bold">+39 02 39465 615</td>--}}
{{--                    </tr>--}}
{{--                    <tr class="border-bottom">--}}
{{--                        <th scope="row">{{trans('public.about_us.table_email')}}</th>--}}
{{--                        <td class="bold">info@eboro.it</td>--}}
{{--                    </tr>--}}
{{--                    <tr class="border-bottom">--}}
{{--                        <th scope="row">{{trans('public.about_us.table_website')}}</th>--}}
{{--                        <td class="bold">www.eboro.it</td>--}}
{{--                    </tr>--}}
{{--                    <tr class="border-bottom">--}}
{{--                        <th scope="row">{{trans('public.about_us.table_employees')}}</th>--}}
{{--                        <td class="bold">--</td>--}}
{{--                    </tr>--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="dialy-offer py-5 overlay d-flex align-items-center">--}}
{{--            <div class="container">--}}
{{--                <div class="dialy-info zindex">--}}
{{--                    <h2 class="text-white bold text-center mb-5">{{trans('public.about_us.orderd_title')}}</h2>--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-lg-4">--}}
{{--                            <div class="c100 p70 big float-none mx-auto">--}}
{{--                                <span>750</span>--}}
{{--                                <div class="slice">--}}
{{--                                    <div class="bar"></div>--}}
{{--                                    <div class="fill"></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="bold text-center text-white font-size-30">Pizza</div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-4">--}}
{{--                            <div class="c100 p60 big float-none mx-auto">--}}
{{--                                <span>680</span>--}}
{{--                                <div class="slice">--}}
{{--                                    <div class="bar"></div>--}}
{{--                                    <div class="fill"></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="bold text-center text-white font-size-30">Pasta</div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-4">--}}
{{--                            <div class="c100 p50 big float-none mx-auto">--}}
{{--                                <span>630</span>--}}
{{--                                <div class="slice">--}}
{{--                                    <div class="bar"></div>--}}
{{--                                    <div class="fill"></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="bold text-center text-white font-size-30">Salad</div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="meetteam py-5">--}}
{{--            <div class="container">--}}
{{--                <h2 class="red-color bold text-center mb-5">{{trans('public.about_us.team')}}</h2>--}}
{{--                <div class="row">--}}
{{--                    <div class="col-lg-3">--}}
{{--                        <div class="card card-box-shadow border-0 border-radius-20 px-4 pb-4 pt-2">--}}
{{--                            <div class="plat">--}}
{{--                                <img src="images/face2.jpg" class="pan-inner" alt="">--}}
{{--                            </div>--}}
{{--                            <h3 class="blue-color text-center font-size-18 mb-1 bold">Ahmed Maher</h3>--}}
{{--                            <span class="red-color text-center semibold">CEO</span>--}}
{{--                            <p class="light-grey text-center mt-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. At optio dolore delectus voluptas adipisci hic accusantium? Excepturi nihil totam tempora in fuga placeat omnis inventore. Dolore iusto delectus architecto quod.</p>--}}
{{--                            <ul class="list-unstyled d-flex justify-content-center flex-center-mob p-0 m-0 about-links">--}}
{{--                                <li class="social-links"><a href="#" class="text-white"><i class="fab fa-facebook-f"></i></a></li>--}}
{{--                                <li class="social-links"><a href="#" class="text-white"><i class="fab fa-twitter"></i></a></li>--}}
{{--                                <li class="social-links"><a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a></li>--}}
{{--                                <li class="social-links"><a href="#" class="text-white"><i class="fab fa-youtube"></i></a></li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-3">--}}
{{--                        <div class="card card-box-shadow border-0 border-radius-20 px-4 pb-4 pt-2">--}}
{{--                            <div class="plat">--}}
{{--                                <img src="images/face2.jpg" class="pan-inner" alt="">--}}
{{--                            </div>--}}
{{--                            <h3 class="blue-color text-center font-size-18 mb-1 bold">Ahmed Maher</h3>--}}
{{--                            <span class="red-color text-center semibold">CEO</span>--}}
{{--                            <p class="light-grey text-center mt-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. At optio dolore delectus voluptas adipisci hic accusantium? Excepturi nihil totam tempora in fuga placeat omnis inventore. Dolore iusto delectus architecto quod.</p>--}}
{{--                            <ul class="list-unstyled d-flex justify-content-center flex-center-mob p-0 m-0 about-links">--}}
{{--                                <li class="social-links"><a href="#" class="text-white"><i class="fab fa-facebook-f"></i></a></li>--}}
{{--                                <li class="social-links"><a href="#" class="text-white"><i class="fab fa-twitter"></i></a></li>--}}
{{--                                <li class="social-links"><a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a></li>--}}
{{--                                <li class="social-links"><a href="#" class="text-white"><i class="fab fa-youtube"></i></a></li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-3">--}}
{{--                        <div class="card card-box-shadow border-0 border-radius-20 px-4 pb-4 pt-2">--}}
{{--                            <div class="plat">--}}
{{--                                <img src="images/face2.jpg" class="pan-inner" alt="">--}}
{{--                            </div>--}}
{{--                            <h3 class="blue-color text-center font-size-18 mb-1 bold">Ahmed Maher</h3>--}}
{{--                            <span class="red-color text-center semibold">CEO</span>--}}
{{--                            <p class="light-grey text-center mt-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. At optio dolore delectus voluptas adipisci hic accusantium? Excepturi nihil totam tempora in fuga placeat omnis inventore. Dolore iusto delectus architecto quod.</p>--}}
{{--                            <ul class="list-unstyled d-flex justify-content-center flex-center-mob p-0 m-0 about-links">--}}
{{--                                <li class="social-links"><a href="#" class="text-white"><i class="fab fa-facebook-f"></i></a></li>--}}
{{--                                <li class="social-links"><a href="#" class="text-white"><i class="fab fa-twitter"></i></a></li>--}}
{{--                                <li class="social-links"><a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a></li>--}}
{{--                                <li class="social-links"><a href="#" class="text-white"><i class="fab fa-youtube"></i></a></li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-3">--}}
{{--                        <div class="card card-box-shadow border-0 border-radius-20 px-4 pb-4 pt-2">--}}
{{--                            <div class="plat">--}}
{{--                                <img src="images/face2.jpg" class="pan-inner" alt="">--}}
{{--                            </div>--}}
{{--                            <h3 class="blue-color text-center font-size-18 mb-1 bold">Ahmed Maher</h3>--}}
{{--                            <span class="red-color text-center semibold">CEO</span>--}}
{{--                            <p class="light-grey text-center mt-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. At optio dolore delectus voluptas adipisci hic accusantium? Excepturi nihil totam tempora in fuga placeat omnis inventore. Dolore iusto delectus architecto quod.</p>--}}
{{--                            <ul class="list-unstyled d-flex justify-content-center flex-center-mob p-0 m-0 about-links">--}}
{{--                                <li class="social-links"><a href="#" class="text-white"><i class="fab fa-facebook-f"></i></a></li>--}}
{{--                                <li class="social-links"><a href="#" class="text-white"><i class="fab fa-twitter"></i></a></li>--}}
{{--                                <li class="social-links"><a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a></li>--}}
{{--                                <li class="social-links"><a href="#" class="text-white"><i class="fab fa-youtube"></i></a></li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </main>
    <!-- Start Footer -->
@yield('footer')
<!-- End Footer -->
</main>
@yield('script')
</body>
</html>
