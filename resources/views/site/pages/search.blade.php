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

    <main id="search">

        <div class="container">
            <div class="mt-5 width-100-per">
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
            </div>
        </div>

        <div class="bestinmonth-banner py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row grid-layout">
                            @isset($items)
                                @foreach($items as $item)
                                    <div class="col-md-4">
                                        <a href="{{asset('/Provider/'.$item->provider->id.'/'.$item->provider->name)}}">
                                            <div class="card card-box-shadow border-0 border-radius-20 p-4">
                                                <div class="grid-content">
                                                    <div class="mr-3">
                                                        <img src="{{url('public/uploads/Provider/'.$item->provider->logo)}}"
                                                             class="card-img" alt="{{$item->provider->name}}">
                                                    </div>
                                                    <div>
                                                        <h4 class="c-ele red-color text-center font-size-18 bold">{{$item->name}}</h4>
                                                        <div class="c-ele text-muted text-center">{{$item->provider->category->{'name_'.session('lang')} }}</div>
                                                        <p class="m-0 font-size-15">{!! $item->description !!}</p>
                                                    </div>
                                                </div>
                                                <div class="card-line text-center my-3">
                                                    <div class="card-poly">
                                                        <img src="{{asset('svg-icons/polygonincards.svg')}}"
                                                             alt="eboro splash">
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div><i class="fas fa-phone-square"></i> {{$item->hot_line}}</div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @endisset
                        </div>
                    </div>
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
