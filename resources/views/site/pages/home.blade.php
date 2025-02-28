@include('site.paritial.include')
    <!DOCTYPE html>
<html>
<head>
@yield('SEO')
<!-- TITLE TAG -->
    <title>Eboro.consegna a domicilio</title>
    <!-- LINK TAGS -->
@yield('home')
<!-- FONTS TAGS -->
    @yield('font')
</head>
<body>
<main id="homepage">

    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    <!-- Start Navbar -->
@yield('Nav')
<!-- End Navbar -->

    <main id="home">
        <div class="carousel-banner">
            <div id="carousel-products" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators p-0 m-0">
                {{--                    <li data-target="#carousel-products" data-slide-to="0" class="active"></li>--}}
                <!-- <li data-target="#carousel-products" data-slide-to="1"></li> -->
                </ol>
                <div class="carousel-inner overlay">
                    <div class="carousel-item topcarousel active" style="background-image: url('{{asset('public/uploads/setting/'.$share_setting->slider_image)}}');">
                        <img data-src="{{asset('public/uploads/setting/'.$share_setting->slider_image)}}" class="height-carousel-img d-block w-100 lazy" alt="carousel-one" style="visibility: hidden">
                        <div class="carousel-intro align-middle w-75">
                            <div class="justify-content-center">
                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="text-uppercase bold">eb</div>
                                    <img class="lazy" data-src="svg-icons/logo-o.svg" alt="">
                                    <div class="text-uppercase bold">ro</div>
                                </div>
                                <div>Discover &amp; Order</div>
                                <div>You Dream, we deliver</div>
                            </div>
                            <div class="row align-items-center justify-content-center">
                                @foreach($Categories as $Category)
                                    <div class="col-lg-2 col-md-3 col-4">
                                        <a href="{{asset('/category/'.$Category->id .'/'.$Category->{'name_'.session('lang')} )}}"
                                           class=" border-0"
                                           style="font-size:14px;">
                                            <img  data-src="{{asset('/public/uploads/Category/'.$Category->image)}}"
                                                 class="mx-auto lazy" style="width:90px;height:90px;"

                                                 alt="{{$Category->{'name_'.session('lang')} }}">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="menu-banner">
            <div class="container">
                <form action="{{url('search')}}" method="post">
                    @csrf
                    <div class="menu-box d-flex justify-content-end">
                        <div class="search-area height-60">
                            <i class="fas fa-search search-icon light-grey"></i>
                            <input type="text" class="main-input form-control border-radius-0 height-60 placeholder-gray border-0" placeholder="{{trans('public.search.placeholder')}}" name="search" id="providerName">
                        </div>

                        <div class="btn red-bg search-menu text-white border-radius-0 border-radius-top-bottom-right d-flex align-items-center justify-content-center height-60 px-4">
                            <button type="submit" class="btn red-bg text-white"> <i class="fas fa-search"></i> </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>


        <div class="bestinmonth-banner py-5">
            <div class="container">
                <h2 class="text-center red-color bold mb-5">{{trans('public.best_title')}}</h2>
                <div class="row">
                    @foreach($Providers->wherein('id' , explode(',', str_replace(['"','[',']',' '], '', $share_setting->providers_array))) as $key => $item)
                        <div class="col-md-4 d-flex align-items-stretch">
                            @if($item->I_offer() > 0)
                                <div class="Box">
                                    {{$item->I_offer()}} %
                                </div>
                            @endif
                            <div class="card card-box-shadow border-0 border-radius-20 p-4 h-100">
                                <a href="{{asset('/Provider/'.$item->id.'/'.$item->name)}}">
                                    <div class="grid-content">
                                        <div class="mr-3">
                                            <img data-src="{{asset('public/uploads/Provider/'.$item->logo)}}" class="card-img lazy" height="150" alt="{{$item->name}}">
                                        </div>
                                    </div>
                                    <div class="card-line text-center mt-auto">
                                        <div class="card-poly">
                                            {{$item->name}}
                                        </div>
                                        <div class="card-poly">
                                            <p>
                                                @foreach($item->typed as $it)
                                                    {{ $it->type->{'type_'.session('lang')} }}
                                                @endforeach
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="bestinmonth-banner py-5">
            <div class="container">
                <h2 class="text-center red-color bold mb-5">{{trans('public.best_title')}}</h2>
                <div class="row">
                    @foreach($products->wherein('id' , explode(',', str_replace(['"','[',']',' '], '', $share_setting->product_array))) as $key => $item)
                        @if($item->branch->provider->lock != "lock")
                            <div class="col-md-4 d-flex align-items-stretch">
                                @if($offers->where('product_id' , $item->id)->first() != null)
                                    <div class="Box">
                                        {{$item->offer->value}} %
                                    </div>
                                @endif
                                <div class="card card-box-shadow border-0 border-radius-20 p-4 h-100 w-100">
                                    <div class="grid-content">
                                        <div class="mr-3">
                                            <img data-src="{{asset('public/uploads/Product/'.$item->image())}}" class="card-img lazy" height="150" alt="{{$item->name}}">
                                        </div>
                                        <div>

                                            <a href="{{asset('/product-details/'.$item->id.'/'.$item->name)}}">
                                                <h4 class="c-ele red-color text-center font-size-18 bold">{{$item->name}}</h4>
                                                <div class="c-ele text-muted text-center">
                                                    {{ $item->typed->{'type_'.session('lang')} ?? "" }}
                                                </div>
                                                <p class="m-0 font-size-15">{{$item->description}}</p>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-line text-center mt-auto">
                                        <div class="card-poly">
                                            <img class="lazy" data-src="{{asset('public/uploads/Product/'.$item->image())}}" alt="{{$item->name}}">
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        @if($offers->where('product_id' , $item->id)->first() != null)
                                            <div>{{$item->has_outofstock == 1 ? trans('admin.has_outofstock') : $item->price - (($item->offer->value/100)*$item->price).' €'}} </div>
                                        @elseif(!empty($item))
                                            <div>{{$item->has_outofstock == 1 ? trans('admin.has_outofstock') : $item->price.' €'}} </div>
                                        @endif

                                        @if (Auth::user() && $item->has_outofstock == 0)
                                            {{--                                        <button class="btn red-bg text-white btn-sm " onclick="addToCart({{$item->id}})">{{trans('public.add_to_cart')}}</button>--}}
                                            <a href="{{asset('/product-details/'.$item->id.'/'.$item->name)}}" class="btn red-bg text-white btn-sm">{{trans('public.add_to_cart')}}</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>
            </div>
        </div>

        <div class="staysafe-banner">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 pr-0">
                        <div class="blue-bg height-100-per p-5">
                            <h2 class="text-white bold"> {{trans('public.stay_title')}}</h2>
                            <p class="orange-color font-size-25"> {{trans('public.stay_caption1')}}
                                <br>{{trans('public.stay_caption1_br')}}.</p>
                        </div>
                    </div>
                    <div class="col-md-6 px-0">
                        <img class="lazy" data-src="images/man.jpg" style="width:100%;height:100%" alt="">
                    </div>
                </div>
            </div>
        </div>

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


        <div class="subscribe-banner overlay">
            <div class="container pt-5 height-100-per">
                <div class="pt-5 zindex height-100-per d-flex align-items-center flex-column justify-content-center">
                    <h2 class="bold text-white mt-5">{{trans('public.become_seller')}}</h2>
                    <form action="{{url('subscribe')}}" method="post" style="width: 100%">
                        @csrf
                        <div class="input-group width-50-per cust-input" style="margin: auto;">
                            <input type="email" class="form-control placeholder-gray" required name="email" placeholder="Your E-mail">
                            @error('email')
                            <span class="invalid-feedback border-danger  alert-danger"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                            <div class="input-group-prepend">
                                <button class="btn blue-bg text-white" type="submit">
                                    {{trans('public.submit')}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="bestinmonth-banner pt-5">
            <div class="container">
                <h2 class="text-center red-color bold">{{trans('public.families_title')}}</h2>
                <div class="container-fixed stacked-cards stacked-cards-fanOut pb-0">
                    <ul style="height: 400px">
                        @foreach($products->wherein('id' , explode(',', str_replace(['"','[',']',' '], '', $share_setting->product_offer_array))) as $key => $item)
                            <li data-bg="{{asset('/public/uploads/Product/'.$item->image())}}" class="lazy" style="background: url() no-repeat scroll center center; background-size: cover;">
                                <div class="col-12 p-0 m-0">
                                    <div class="card card-box-shadow border-0 p-2 layout-black" style=" position: fixed; bottom: 0; ">
                                        <a href="{{asset('/product-details/'.$item->id.'/'.$item->name)}}" target="_blank">
                                            <div class="grid-content">
                                                <h4 class="c-ele text-white text-left font-size-18 bold">{{$item->name}}</h4>
                                                <div class="c-ele text-muted text-left">{{$item->type}}</div>
                                                <p class="m-0 text-white font-size-15">{{$item->description}}</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="customer-review-banner py-5">
            <div class="container">
                <h2 class="text-center red-color bold mb-5">
                    {{trans('public.review_title')}}
                </h2>
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($tests as $test)
                            <div class="carousel-item {{$loop->iteration==1?'active':''}} px-5">
                                <i class="fas fa-quote-left red-color"></i>
                                <p class="text-black">
                                    {{$test->comment}}
                                </p>
                                <img data-src="{{url('public/uploads/Testmonial/'.$test->image)}}"
                                     class="d-block mx-auto width-80 height-80 rounded-circle lazy" class="d-block w-100" alt="">
                                <div class="text-center">{{$test->name}}</div>
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
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
    $(document).ready(function() {
        let stackedCardFanOut = new stackedCards({
            selector: '.stacked-cards-fanOut',
            layout: "fanOut",
            transformOrigin: "bottom",
        });
        stackedCardFanOut.init();
    });
</script>
@if (Auth::user() )
    <script>
        function addToCart(item,suace=null,qty=null) {
            $.ajax({
                method: 'post',
                url: '{{url('api/add-cart')}}',
                headers: {"Authorization":"Bearer {{auth()->user()->generateAuthToken() ?? ''}}" },
                data: {
                    product_id: item,
                    sauce_id: suace,
                    qty: qty,
                },
                success: function (res) {
                    location.reload();
                }
            });
        }

    </script>
@endif
</body>
</html>
