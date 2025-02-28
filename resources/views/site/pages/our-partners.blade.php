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

    <main id="resturant">

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
                    <div class="col-md-3">
                        @if(isset($Providers[0]))
                            <div class="card border box-shadow border-radius overflow-hidden mx-auto mb-4">
                                <div class="card-header red-bg">
                                    <div class="d-flex align-items-center justify-content-between text-white">
                                        <div>Filter</div>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-body p-0">
                                        <div id="accordion">
                                            <form action="{{url('Filter/'. $Providers[0]->category_id)}}" class="Filter" enctype="multipart/form-data">
                                                @csrf
                                                <div class="border-bottom">
                                                    <div class="bg-white p-0" id="headingOne">
                                                        <h5 class="mb-0">
                                                            <button type="button" onclick="return false;"
                                                                class="btn px-4 btn-collapse btn-block d-flex align-items-center justify-content-between box-shadow-0"
                                                                data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                                                aria-controls="collapseOne">
                                                                <span>{{trans('public.filter.Order')}}</span>
                                                                <i class="fas fa-plus arrow-collapse"></i>
                                                            </button>
                                                        </h5>
                                                    </div>
                                                    <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                                                        <div class="card-body pt-0 px-4">
                                                            <ul class="list-unstyled p-0 m-0 chceks-wrapper">
                                                                <li>
                                                                    <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                                                        <input type="checkbox" class="custom-control-input" id="Near_Me" name='type[]' value='Near_Me'>
                                                                        <label class="custom-control-label" for="Near_Me">{{trans('public.filter.Near_Me')}}</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                                                        <input type="checkbox" class="custom-control-input" id="Top_Rate" name='type[]' value='Top_Rate'>
                                                                        <label class="custom-control-label" for="Top_Rate">{{trans('public.filter.Top_Rate')}}</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                                                        <input type="checkbox" class="custom-control-input" id="Time" name='type[]' value='Time'>
                                                                        <label class="custom-control-label" for="Time">{{trans('public.filter.Time')}}</label>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="border-bottom">
                                                    <div class="bg-white p-0" id="headingTwo">
                                                        <h5 class="mb-0">
                                                            <button type="button" onclick="return false;"
                                                                class="btn px-4 btn-collapse btn-block d-flex align-items-center justify-content-between box-shadow-0"
                                                                data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                                                aria-controls="collapseTwo">
                                                                <span>{{trans('public.filter.Offers')}}</span>
                                                                <i class="fas fa-plus arrow-collapse"></i>
                                                            </button>
                                                        </h5>
                                                    </div>
                                                    <div id="collapseTwo" class="collapse " aria-labelledby="headingTwo" data-parent="#accordion">
                                                        <div class="card-body pt-0 px-4">
                                                            <ul class="list-unstyled p-0 m-0 chceks-wrapper">
                                                                <li>
                                                                    <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                                                        <input type="checkbox" class="custom-control-input" id="All_offers" name='type[]' value='All_offers'>
                                                                        <label class="custom-control-label" for="All_offers">{{trans('public.filter.All_offers')}}</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                                                        <input type="checkbox" class="custom-control-input" id="BITM" name='type[]' value='BITM'>
                                                                        <label class="custom-control-label" for="BITM">{{trans('public.filter.BITM')}}</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                                                        <input type="checkbox" class="custom-control-input" id="Free_Delivery" name="type[]" value="Free_Delivery">
                                                                        <label class="custom-control-label" for="Free_Delivery">{{trans('public.filter.Free_Delivery')}}</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                                                        <input type="checkbox" class="custom-control-input" id="Free_Items" name="type[]" value="Free_Items">
                                                                        <label class="custom-control-label" for="Free_Items">{{trans('public.filter.Free_Items')}}</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                                                        <input type="checkbox" class="custom-control-input" id="Halal" name="type[]" value="Halal">
                                                                        <label class="custom-control-label" for="Halal">{{trans('public.filter.Halal')}}</label>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="border-bottom">
                                                    <div class="bg-white p-0" id="headingTwo">
                                                        <h5 class="mb-0">
                                                            <button type="button" onclick="return false;"
                                                                class="btn px-4 btn-collapse btn-block d-flex align-items-center justify-content-between box-shadow-0"
                                                                data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseTwo">
                                                                <span>Type</span>
                                                                <i class="fas fa-plus arrow-collapse"></i>
                                                            </button>
                                                        </h5>
                                                    </div>

                                                    <div id="collapseThree" class="collapse " aria-labelledby="headingthree" data-parent="#accordion">
                                                        <div class="card-body pt-0 px-4">
                                                            <ul class="list-unstyled p-0 m-0 chceks-wrapper">
                                                                @foreach($types as $type)
                                                                    <li>
                                                                        <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                                                            <input type="checkbox" class="custom-control-input" id="{{ $type->id }}" name='vtype[]' value='{{ $type->id }}'>
                                                                            <label class="custom-control-label" for="{{ $type->id }}">{{ $type->{'type_'.session('lang')} }}</label>
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-9">
                        <div class="row grid-layout contents current ajax_content">
                        @foreach($Providers as $Provider)
                            <div class="filter-result col-md-6 {{$Provider->category->{'name_'.session('lang')} }}">
                                <div class="card card-box-shadow border-0 border-radius-20 p-4 h-100">
                                    <div class="grid-content">
                                        <div class="mr-3">
                                            <img src="{{asset('/public/uploads/Provider/'.$Provider->logo)}}" class="card-img" alt="">
                                        </div>
                                        <div>
                                            <h4 class="c-ele red-color text-center font-size-18 bold mt-2">{{$Provider->description}}</h4>
{{--                                            <div class="c-ele text-muted text-center mb-2">{{$Provider->category->{'name_'.session('lang')} }}</div>--}}
                                            <div class="c-ele text-muted text-center mb-2">{{$Provider->{'type_'.session('lang')} }}</div>
                                            <p class="m-0 font-size-15">{{$Provider->description}}</p>
                                        </div>
                                    </div>
                                    <div class="card-line text-center my-3 mt-auto">
                                        <div class="card-poly">
                                            <img src="{{asset('public/uploads/Provider/'.$Provider->logo)}}" alt="">
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>{{$Provider->branch()->count()}} {{trans('public.branch')}}</div>
                                        <a href="{{asset('/Provider/'.$Provider->id.'/'.$Provider->name)}}" class="btn red-bg text-white btn-sm btn-added-cart">{{trans('public.view')}}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
