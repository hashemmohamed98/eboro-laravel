@include('dashboard.paritial.include')
    <!DOCTYPE html>
<html>
<head>
@yield('SEO')
<!-- TITLE TAG -->
    <title>Eboro-Dashboard</title>
    <!-- LINK TAGS -->
@yield('home')
<!-- FONTS TAGS -->
    @yield('font')
</head>
<body>
<main id="dashboard">
    <div class="container-fluid py-2">
        <div class="main-wrapper d-flex justify-content-between">
            <!-- Start Navbar -->
        @yield('Nav')
        <!-- End Navbar -->

            <section class="position-relative main-content sm-content">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h2 class="main-color font-bold">{{$Providers->category->{'name_'.session('lang')} }} {{trans('admin.dashboard')}}</h2>
                    <div class="menu-btn">
                        <button class="hamburger hamburger--spin" type="button">
                                <span class="hamburger-box">
                                  <span class="hamburger-inner"></span>
                                </span>
                        </button>
                    </div>
                    <div class="menu-btn-mob">
                        <button class="hamburger hamburger--spin" type="button">
                                <span class="hamburger-box">
                                  <span class="hamburger-inner"></span>
                                </span>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="card card-box-shadow border-0 border-radius-20 mb-4 bg-grident-green">
                            <div class="px-4 pt-4">
                                <h5 class="text-center font-bold">{{trans('dashboard.home.total_branches')}}</h5>
                                <div class="d-flex justify-content-center">
                                    <h4 class="text-center font-bold mr-2">{{count($Providers->branch)}}</h4>
                                </div>
                            </div>
                            <div class="card-line">
                                <img src="{{asset('resources/views/dashboard/assets/images/statisticswave.svg')}}" alt="">
                            </div>
                        </div>
                    </div>
                    @if($Providers->delivery == 1)
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <div class="card card-box-shadow border-0 border-radius-20 mb-4 bg-grident-red">
                                <div class="px-4 pt-4">
                                    <h5 class="text-center font-bold">{{trans('dashboard.home.total_deliveries')}}</h5>
                                    <div class="d-flex justify-content-center">
                                        <h4 class="text-center font-bold mr-2">{{count($Deliveries)}}</h4>
                                    </div>
                                </div>
                                <div class="card-line">
                                    <img src="{{asset('resources/views/dashboard/assets/images/statisticswave.svg')}}" alt="">
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="card card-box-shadow border-0 border-radius-20 mb-4 bg-grident-yellow">
                            <div class="px-4 pt-4">
                                <h5 class="text-center font-bold">{{trans('dashboard.home.total_cashers')}}</h5>
                                <div class="d-flex justify-content-center">
                                    <h4 class="text-center font-bold mr-2">{{count($Cashiers)}}</h4>

                                </div>
                            </div>
                            <div class="card-line">
                                <img src="{{asset('resources/views/dashboard/assets/images/statisticswave.svg')}}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="card card-box-shadow border-0 border-radius-20 mb-4 bg-grident-light-green">
                            <div class="px-4 pt-4">
                                <h5 class="text-center font-bold">{{trans('dashboard.home.total_products')}}</h5>
                                <div class="d-flex justify-content-center">
                                    <h4 class="text-center font-bold mr-2">{{count($items)}}</h4>

                                </div>
                            </div>
                            <div class="card-line">
                                <img src="{{asset('resources/views/dashboard/assets/images/statisticswave.svg')}}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="card card-box-shadow border-0 border-radius-20 mb-4 bg-grident-green2">
                            <div class="px-4 pt-4">
                                <h5 class="text-center font-bold">{{trans('dashboard.home.total_orders')}}</h5>
                                <div class="d-flex justify-content-center">
                                    <h4 class="text-center font-bold mr-2">{{count($Orders)}}</h4>
                                </div>
                            </div>
                            <div class="card-line">
                                <img src="{{asset('resources/views/dashboard/assets/images/statisticswave.svg')}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white card-box-shadow border-radius-20 p-4">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="row">
                            <div class="col-12">
                                <img src="{{asset('/public/uploads/Provider/'.$Providers->logo)}}" width="200" height="200" style="object-fit:contain" alt="">
                            </div>
                            <div class="col-12">

                                <div class="font-size-25 cursor-pointer">
                                    <label for="">{{trans('dashboard.home.prepare')}}</label>
                                    <select class="form-control radius" onchange="request()" id="filter_state">
                                        @foreach(\App\Helper\durations::arr as $item)
                                            <option value="{{$item}}" @if($Providers->duration == $item) selected @endif>{{$item}} Min</option>
                                        @endforeach
                                    </select>

                                        <form action="{{url('api/edit_range/provider/'.$Providers->id)}}" class="Add-meal" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="">{{trans('admin.type')}} Inner*</label>
                                                    <select name="typeInners[]" class="form-control radius select-two" multiple required>
                                                        @foreach($types as $type)
                                                            @if($type->provider_id == $Providers->id)
                                                                <option value="{{$type->id}}" @if(count($Providers->typeInner) > 0  && in_array($type->id,$Providers->typeInner->pluck('type_id')->toArray())) selected @endif>{{$type->{'type_'.session('lang')} }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if($Providers->delivery == 1)
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="">{{trans('admin.delivery_range')}}</label>
                                                    <input type="number" min="0" step="1" class="form-control radius" placeholder="{{trans('admin.delivery_range')}} Km" name="range_delivery"  value="{{$Providers->range_delivery}}" required>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="">{{trans('admin.delivery_fees')}} / KM</label>
                                                    <input type="number" min="0" step="1" class="form-control radius" placeholder="{{trans('admin.delivery_fees')}} / Km" name="delivery_fee"  value="{{$Providers->delivery_fee}}" required>
                                                </div>
                                            </div>
                                            @endif

                                            <div id="message">
                                                <div class="spinner-border text-danger d-none" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-warning px-4 text-white">{{trans('admin.categories.save')}}</button>
                                        </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="m-0">{{$Providers->name . ": " .$Providers->description}}</p>
                </div>
                <div class="mt-3">
                    <div class="row">
                        <div class="col-xl-3">
                            <input type="text" class="form-control card-box-shadow border-transparent input-search" placeholder="Search" style="border-radius: 15px;height:calc(1.5em + .75rem + 10px) !important">
                        </div>
                        <div class="col-xl-7"></div>
                        <div class="col-xl-2">
                            <div class="mt-2 text-right">
                                <span class="text-muted font-bold">{{trans('dashboard.beverages.sort')}} :</span>
                                <span class="text-black">{{trans('admin.categories.date')}}</span></div>
                        </div>
                    </div>
                </div>
                <!-- card-height -->
                <div class="row my-3 scroll-ele">
                    @if($Providers->category_id == 1)
                        @foreach($items as $item)
                            <div class="col-md-6 col-lg-6 col-xl-3 eboro-box">
                                @if($offers->where('product_id' , $item->id)->first() != null)
                                    <div class="Box">
                                        {{$item->offer->value}} %
                                    </div>
                                @endif
                                <div class="bg-white card-box-shadow border-radius-20 px-4 py-3 position-relative mb-4">
                                    <div class="adding-btn">
                                        <i class="fas fa-plus" data-toggle="modal" data-target="#addPOPUP{{$item->id}}"></i>
                                        <div class="pt-2">
                                            <a href="{{asset('product-details/'.$item->id .'/'.$item->name)}}" target="_blank"><i class="fas fa-eye text-black" style="color: #000;font-size:20px"></i></a>

                                        </div>
                                        <i class="fas fa-edit text-warning" data-toggle="modal" data-target="#Product-edit{{$item->id}}" style="font-size:20px"></i>
                                        <i class="fas fa-cart-plus text-warning" data-toggle="modal" data-target="#cart-plus{{$item->id}}" style="font-size:20px"></i>
                                        <i class="fas fa-trash-alt text-danger" data-toggle="modal" data-target="#delete{{$item->id}}" style="font-size:20px"></i>
                                    </div>
                                    <img src="{{asset('/public/uploads/Product/'.$item->image())}}" class="d-block mx-auto width-100 height-100 object-fit-contain" alt="">
                                    <div class="text-center font-bold mt-3">
                                        <div>{{$item->name}}</div>
                                        @if($offers->where('product_id' , $item->id)->first() != null)
                                            <div>{{$item->has_outofstock == 1 ? trans('admin.has_outofstock') : $item->price - (($item->offer->value/100)*$item->price).' €'}} </div>
                                        @else
                                            <div>{{$item->has_outofstock == 1 ? trans('admin.has_outofstock') : $item->price.' €'}} </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        @foreach($Additions as $item)
                            <div class="col-md-6 col-lg-6 col-xl-3 eboro-box">
                                @if($offers->where('product_id' , $item->id)->first() != null)
                                    <div class="Box">
                                        {{$item->offer->value}} %
                                    </div>
                                @endif
                                <div class="bg-white card-box-shadow border-radius-20 px-4 py-3 position-relative mb-4">
                                    <div class="adding-btn">
                                        <div class="" id="">
                                            <div class="card card-body d-flex flex-column pt-2 border-0 p-0" style="color: #000;">
                                                <i class="fas fa-edit text-warning p-1 fa-2x" data-toggle="modal" data-target="#Product-edit{{$item->id}}"></i>
                                                <i class="fas fa-cart-plus text-warning" data-toggle="modal" data-target="#cart-plus{{$item->id}}" style="font-size:20px"></i>
                                                <i class="fas fa-trash-alt text-danger p-1 fa-2x" data-toggle="modal" data-target="#delete{{$item->id}}"></i>
                                            </div>
                                        </div>

                                    </div>
                                    <img src="{{asset('/public/uploads/Product/'.$item->image())}}" class="d-block mx-auto width-100 height-100 object-fit-contain" alt="">
                                    <div class="text-center font-bold mt-3">
                                        <div>{{$item->name}}</div>
                                        @if($offers->where('product_id' , $item->id)->first() != null)
                                            <div>{{$item->has_outofstock == 1 ? trans('admin.has_outofstock') : $item->price - (($item->offer->value/100)*$item->price).' €'}} </div>
                                        @else
                                            <div>{{$item->has_outofstock == 1 ? trans('admin.has_outofstock') : $item->price.' €'}} </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-warning text-white width-100" data-toggle="modal" data-target="#Add-Product">{{trans('admin.categories.add')}}</button>
                </div>
            </section>

            <!-- Start Footer -->

        @yield('footer')
        <!-- End Footer -->
        </div>
    </div>
</main>




@if($Providers->category_id == 1)
    <!-- add modal  -->
    <div class="modal fade" id="Add-Product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <h4 class="py-3 px-2"> {{trans('dashboard.beverages.add_product')}} (Add)</h4>
                <div class="modal-body">
                    <form action="{{url('api/create/branch-product')}}" method="post" class="Add-Product"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="">{{trans('dashboard.beverages.category')}}*</label>
                                <select name="product_type" class="form-control radius" required>
                                    @if($Providers->category_id == 1)
                                        <option value="Food">Prouduct</option>
                                    @else
                                        <option value="Addition">Prouduct</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">{{trans('dashboard.beverages.branch')}}</label>
                                <select class="form-control radius" placeholder="branch_id" name="branch_id" required>

                                    @foreach($Branches as $Branch)
                                        <option value="{{$Branch->id}}">{{$Branch->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">{{trans('dashboard.beverages.product_name')}}*</label>
                                <input type="text" class="form-control radius" placeholder="name" name="name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">{{trans('dashboard.beverages.price')}}*</label>
                                <input type="text" class="form-control radius" placeholder="price"  name="price" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">position*</label>
                                <input type="text" class="form-control radius" placeholder="position"  name="position" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">{{trans('dashboard.beverages.type')}}*</label>
                                <select class="form-control radius" placeholder="type" name="type" required>
                                    <option >Please Select type</option>
                                @foreach($types as $type)
                                            <option value="{{$type->id}}">{{ $type->{'type_'.session('lang')} }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="">{{trans('dashboard.beverages.size')}}*</label>
                                <input type="text" class="form-control radius" placeholder="size"  name="size" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="">{{trans('dashboard.beverages.calories')}}*</label>
                                <input type="text" class="form-control radius" placeholder="calories"  name="calories" >
                            </div>

                            <div class="form-group col-md-6">
                                <label for="">{{trans('dashboard.beverages.addition')}}*</label>
                                <input type="text" class="form-control radius" placeholder="additions" name="additions" >
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="">{{trans('admin.portfolio.image')}}*</label>
                                    <input name="image" type="file" id="photo"  accept="image/*" onchange="loadFile(event)" class="form-control upload-image" aria-describedby="emailHelp" required />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="has_pig" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            {{trans('dashboard.beverages.lard')}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="has_alcohol" id="defaultCheck2">
                                        <label class="form-check-label" for="defaultCheck2">
                                            {{trans('dashboard.beverages.alcohol')}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input out_of_stock" type="checkbox" id="out_of_stock">
                                        <label class="form-check-label" for="out_of_stock">
                                            {{trans('admin.has_outofstock')}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="w-100 has_outofstock_box" style="display: none;">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="example-datetime-local-input" class="col-2 col-form-label">{{trans('admin.start_outofstock')}}</label>
                                        <div class="col-10">
                                            <input class="form-control start_outofstock_input" type="hidden" min="{{Carbon\Carbon::now()->format('Y-m-d')."T".Carbon\Carbon::now()->format('H:i')}}"  name="start_outofstock">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="example-datetime-local-input" class="col-2 col-form-label">{{trans('admin.end_outofstock')}}</label>
                                        <div class="col-10">
                                            <input class="form-control end_outofstock_input" type="hidden" min="{{Carbon\Carbon::now()->format('Y-m-d')."T".Carbon\Carbon::now()->format('H:i')}}" name="end_outofstock">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="example-datetime-local-input" class="col-2 col-form-label">{{trans('admin.offer_value')}}</label>
                                    <div class="col-10">
                                        <input type="number" class="form-control radius" placeholder="{{trans('admin.offer_value')}}" max="100"  name="value" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="example-datetime-local-input" class="col-2 col-form-label">{{trans('admin.offer_start')}}</label>
                                    <div class="col-10">
                                        <input class="form-control radius" type="datetime-local" min="{{Carbon\Carbon::now()->format('Y-m-d')."T".Carbon\Carbon::now()->format('H:i')}}" name="start_at">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="example-datetime-local-input" class="col-2 col-form-label">{{trans('admin.offer_end')}}</label>
                                    <div class="col-10">
                                        <input class="form-control radius" type="datetime-local" min="{{Carbon\Carbon::now()->format('Y-m-d')."T".Carbon\Carbon::now()->format('H:i')}}"  name="end_at">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-12">
                                <label for="">{{trans('admin.portfolio.description')}}*</label>
                                <textarea name="description" class="form-control radius" placeholder="{{trans('admin.categories.message')}}" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                        <div id="message">
                            <div class="spinner-border text-danger d-none" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <button type="submit" class="btn dashboard-main-bg px-4 text-white">{{trans('admin.categories.save')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @foreach($items as $item)

        <!-- delete modal  -->
        <div class="modal fade" id="delete{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{url('api/delete/branch-product/'.$item->id)}}" class="delete">
                        <div class="modal-body">
                            <h6 class="text-dark">  {{trans('admin.categories.delete_p4')}}  {{$item->name}}</h6>
                        </div>
                        <div class="modal-footer d-flex justify-content-between align-items-center">
                            <button type="button" class="btn btn-secondary border-0 bg-transparent text-danger" data-dismiss="modal">{{trans('admin.categories.close')}}</button>
                            <button type="submit" class="btn btn-danger radius text-white">{{trans('admin.categories.delete')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Product edit -->
        <div class="modal fade" id="Product-edit{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <h4 class="py-3 px-2"> {{trans('dashboard.beverages.add_product')}} {{$item->name}}</h4>
                    <div class="modal-body">
                        <form action="{{url('api/edit/branch-product/'.$item->id)}}" class="Add-Product" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="">{{trans('dashboard.beverages.category')}}*</label>
                                    <select name="product_type" class="form-control radius" required>
                                        @if($Providers->category_id == 1)
                                            <option value="Food">Prouduct</option>
                                        @else
                                            <option value="Addition">Prouduct</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">{{trans('dashboard.beverages.branch')}}</label>
                                    <select class="form-control radius" placeholder="branch_id" name="branch_id" required>
                                        @foreach($Branches as $Branch)
                                            <option value="{{$Branch->id}}">{{$Branch->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="">{{trans('dashboard.beverages.product_type')}}*</label>
                                    <select name="product_type" class="form-control radius" required>
                                        <option value="{{$item->product_type}}">{{$item->product_type}}</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="">{{trans('dashboard.beverages.product_name')}}*</label>
                                    <input type="text" class="form-control radius" placeholder="{{trans('dashboard.beverages.product_name')}}" value="{{$item->name}}" name="name" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="">{{trans('dashboard.beverages.price')}}*</label>
                                    <input type="text" class="form-control radius" placeholder="{{trans('dashboard.beverages.price')}}" value="{{$item->price}}" name="price" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="">position *</label>
                                    <input type="text" class="form-control radius" placeholder="position" value="{{$item->position??0}}" name="position" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="">{{trans('dashboard.beverages.type')}}*</label>
                                    <select class="form-control radius" placeholder="type" name="type" required>
                                        <option >Please Select type</option>
                                       @foreach($types as $type)
                                            <option value="{{$type->id}}" @if($type->id == $item->type) selected @endif>{{ $type->{'type_'.session('lang')} }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="">{{trans('dashboard.beverages.size')}}*</label>
                                    <input type="text" class="form-control radius" placeholder="{{trans('dashboard.beverages.size')}}" value="{{$item->size}}" name="size" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="">{{trans('dashboard.beverages.calories')}}*</label>
                                    <input type="text" class="form-control radius" placeholder="{{trans('dashboard.beverages.calories')}}" value="{{$item->calories}}" name="calories" >
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="">{{trans('dashboard.beverages.addition')}}*</label>
                                    <input type="text" class="form-control radius" placeholder="{{trans('dashboard.beverages.addition')}}" value="{{$item->additions}}" name="additions" >
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="">{{trans('admin.portfolio.image')}}*</label>
                                        <input type="file" id="" name="image"  accept="image/*" onchange="loadFile(event)" class="form-control upload-image" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="">{{trans('admin.portfolio.image')}}*</label>
                                    <div class="input-group-append">
                                        <img src="{{asset('/public/uploads/Product/'.$item->image())}}" class="d-block mx-auto" width="100" height="80" style="object-fit:cover" alt="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="has_pig" id="defaultCheck1" @if($item->has_pig == 1) checked @endif>
                                            <label class="form-check-label" for="defaultCheck1">
                                                {{trans('dashboard.beverages.lard')}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="has_alcohol" id="defaultCheck2" @if($item->has_alcohol == 1) checked @endif>
                                            <label class="form-check-label" for="defaultCheck2">
                                                {{trans('dashboard.beverages.alcohol')}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input out_of_stock" type="checkbox" @if($item->has_outofstock == 1) checked @endif id="out_of_stock-{{$item->id}}">
                                            <label class="form-check-label" for="out_of_stock-{{$item->id}}">
                                                {{trans('admin.has_outofstock')}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-100 has_outofstock_box" @if($item->has_outofstock != 1) style="display: none; @endif">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="example-datetime-local-input" class="col-2 col-form-label">{{trans('admin.start_outofstock')}}</label>
                                            <div class="col-10">
                                                <input class="form-control start_outofstock_input" type="hidden"  value="{{Carbon\Carbon::parse($item->start_outofstock)->format('Y-m-d')."T".Carbon\Carbon::parse($item->start_outofstock)->format('H:i')}}"  name="start_outofstock" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="example-datetime-local-input" class="col-2 col-form-label">{{trans('admin.end_outofstock')}}</label>
                                            <div class="col-10">
                                                <input class="form-control end_outofstock_input" type="hidden" min="{{Carbon\Carbon::now()->format('Y-m-d')."T".Carbon\Carbon::now()->format('H:i')}}" value="{{Carbon\Carbon::parse($item->end_outofstock)->format('Y-m-d')."T".Carbon\Carbon::parse($item->end_outofstock)->format('H:i')}}" name="end_outofstock">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="example-datetime-local-input" class="col-2 col-form-label">{{trans('admin.offer_value')}}</label>
                                        <div class="col-10">
                                            <input type="number" class="form-control radius" placeholder="{{trans('admin.offer_value')}}" max="100" value="{{$item->offer->value??''}}" name="value" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="example-datetime-local-input" class="col-2 col-form-label">{{trans('admin.offer_start')}}</label>
                                        <div class="col-10">
                                            <input class="form-control radius" type="datetime-local"
                                                   value="{{Carbon\Carbon::parse($item->offer->start_at??'')->format('Y-m-d')."T".Carbon\Carbon::parse($item->offer->start_at??'')->format('H:i')}}"  name="start_at">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="example-datetime-local-input" class="col-2 col-form-label">{{trans('admin.offer_end')}}</label>
                                        <div class="col-10">
                                            <input class="form-control radius" type="datetime-local" min="{{Carbon\Carbon::now()->format('Y-m-d')."T".Carbon\Carbon::now()->format('H:i')}}"
                                                   value="{{Carbon\Carbon::parse($item->offer->end_at??'')->format('Y-m-d')."T".Carbon\Carbon::parse($item->offer->end_at??'')->format('H:i')}}" name="end_at">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-12">
                                    <label for="">{{trans('admin.portfolio.description')}}*</label>
                                    <textarea name="description" class="form-control radius" placeholder="{{trans('admin.portfolio.description')}}" cols="30" rows="5">{{$item->description}}</textarea>
                                </div>
                            </div>
                            <div id="message">
                                <div class="spinner-border text-danger d-none" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                            <button type="submit" class="btn dashboard-main-bg px-4 text-white">{{trans('admin.categories.save')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- delete modal  -->
        <div class="modal fade" id="cart-plus{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <h4 class="py-3 px-2"> {{trans('dashboard.beverages.add_product')}} {{$item->name}}</h4>
                    <div class="modal-body">
                        <form action="{{url('api/edit/product-meal/'.$item->id)}}" class="Add-meal" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                @if(isset($item->Meal))
                                    <div class="col-md-12">
                                        <div class="meals">
                                            @foreach($item->Meal->Meal_products as  $key => $pro)

                                                <div class="row meals_content">
                                                    <div class="form-group col-md-6">
                                                        <label for="">{{trans('dashboard.beverages.name')}} *</label>
                                                        <select name="products[]" class="form-control border-radius-5" required>
                                                            <option value="">{{trans('dashboard.beverages.name')}} </option>
                                                            @foreach($Products as $item2)
                                                                <option value="{{$item2->id}}" @if($pro->product->id == $item2->id) selected @endif>[{{$item2->id}}] - {{$item2->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-5">
                                                        <label for="">Amount*</label>
                                                        <div class="input-group">
                                                            <input type="number" name="amounts[]" class="form-control border-radius-5" value="{{$pro->amounts}}" placeholder="amount" required>
                                                        </div>
                                                    </div>
                                                    @if($key==0)
                                                        <div class="form-group col-md-1">
                                                            <label for="">Plus*</label>
                                                            <div class="input-group">
                                                                <button type="button" class="btn btn-warning plus_meal"><i class="fas fa-plus-circle text-white"></i></button>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="form-group col-md-1">
                                                            <label for=''>Remove*</label>
                                                            <div class='input-group'>
                                                                <button type='button' class='btn btn-danger remove_time'><i class='fas fa-minus-circle text-white'></i></button>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-12">
                                        <div class="meals">
                                            <div class="row meals_content">
                                                <div class="form-group col-md-6">
                                                    <label for="">{{trans('dashboard.beverages.name')}} *</label>
                                                    <select name="products[]" class="form-control border-radius-5" required>
                                                        <option value="">{{trans('dashboard.beverages.name')}} </option>
                                                        @foreach($Products as $item2)
                                                            <option value="{{$item2->id}}" >[{{$item2->id}}] - {{$item2->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label for="">Amount*</label>
                                                    <div class="input-group">
                                                        <input type="number" name="amounts[]" class="form-control border-radius-5" placeholder="amount" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-1">
                                                    <label for="">Plus*</label>
                                                    <div class="input-group">
                                                        <button type="button" class="btn btn-warning plus_meal"><i class="fas fa-plus-circle text-white"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="example-datetime-local-input" class="col-2 col-form-label">Amount</label>
                                        <div class="col-10">
                                            <input type="number" class="form-control radius" placeholder="Amount" value="{{$item->Meal->value ?? ''}}" name="value">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="example-datetime-local-input" class="col-2 col-form-label">{{trans('admin.offer_start')}}</label>
                                        <div class="col-10">
                                            <input class="form-control radius" type="datetime-local"
                                                   value="{{Carbon\Carbon::parse($item->Meal->start_at??'')->format('Y-m-d')."T".Carbon\Carbon::parse($item->Meal->start_at??'')->format('H:i')}}"  name="start_at">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="example-datetime-local-input" class="col-2 col-form-label">{{trans('admin.offer_end')}}</label>
                                        <div class="col-10">
                                            <input class="form-control radius" type="datetime-local" min="{{Carbon\Carbon::now()->format('Y-m-d')."T".Carbon\Carbon::now()->format('H:i')}}"
                                                   value="{{Carbon\Carbon::parse($item->Meal->end_at??'')->format('Y-m-d')."T".Carbon\Carbon::parse($item->Meal->end_at ?? '')->format('H:i')}}" name="end_at">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div id="message">
                                <div class="spinner-border text-danger d-none" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                            <button type="submit" class="btn dashboard-main-bg px-4 text-white">{{trans('admin.categories.save')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add extra  -->
        <div class="modal fade" id="addPOPUP{{$item->id}}">
            <div class="modal-dialog modal-xl">
                <div class="modal-content p-3">
                    <div class="modal-header p-0 border-0">
                        <h4 class="py-3 px-2"> {{trans('dashboard.sauce.sauce_info')}} </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{url('dashboard/add/product-sauce/'.$item->id)}}"  method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="">{{trans('dashboard.sauce.select_sauce')}} *</label>
                                    <select class="form-control select2box" multiple name="sauce_id[]">
                                        @foreach($Sauces as $items)
                                            <option value="{{$items->id}}" @if($item->sauces->where('sauce_id', $items->id)->first()) selected @endif>{{$items->name}}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-warning text-white">{{trans('admin.categories.save')}}</button>
                        </form>
                    </div>
                    <div class="modal-footer border-0 d-flex justify-content-start">
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <!-- add modal  -->
    <div class="modal fade" id="Add-Product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <h4 class="py-3 px-2"> {{trans('dashboard.beverages.add_product')}} (Add)</h4>
                <div class="modal-body">
                    <form action="{{url('api/create/branch-product')}}" method="post" class="Add-Product"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="">{{trans('dashboard.beverages.category')}}*</label>
                                <select name="product_type" class="form-control radius" required>
                                    @if($Providers->category_id == 1)
                                        <option value="Food">Prouduct</option>
                                    @else
                                        <option value="Addition">Prouduct</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">{{trans('dashboard.beverages.branch')}}</label>
                                <select class="form-control radius" placeholder="branch_id" name="branch_id" required>
                                    @foreach($Branches as $Branch)
                                        <option value="{{$Branch->id}}">{{$Branch->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">{{trans('dashboard.beverages.product_name')}}*</label>
                                <input type="text" class="form-control radius" placeholder="name" name="name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">{{trans('dashboard.beverages.price')}}*</label>
                                <input type="text" class="form-control radius" placeholder="price"  name="price" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">{{trans('dashboard.beverages.type')}}*</label>
                                <select class="form-control radius" placeholder="type" name="type" required>
                                    <option >Please Select type</option>
                                    @foreach($types as $type)
                                        <option value="{{$type->id}}">{{ $type->{'type_'.session('lang')} }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="">{{trans('dashboard.beverages.size')}}*</label>
                                <input type="text" class="form-control radius" placeholder="size"  name="size" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="">{{trans('dashboard.beverages.calories')}}*</label>
                                <input type="text" class="form-control radius" placeholder="calories"  name="calories" >
                            </div>

                            <div class="form-group col-md-6">
                                <label for="">{{trans('dashboard.beverages.addition')}}*</label>
                                <input type="text" class="form-control radius" placeholder="additions" name="additions" >
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="">{{trans('admin.portfolio.image')}}*</label>
                                    <input name="image" type="file" id="photo"  accept="image/*" onchange="loadFile(event)" class="form-control upload-image" aria-describedby="emailHelp" required />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="has_pig" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            {{trans('dashboard.beverages.lard')}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="has_alcohol" id="defaultCheck2">
                                        <label class="form-check-label" for="defaultCheck2">
                                            {{trans('dashboard.beverages.alcohol')}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input out_of_stock" type="checkbox" id="out_of_stock">
                                        <label class="form-check-label" for="out_of_stock">
                                            {{trans('admin.has_outofstock')}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="w-100 has_outofstock_box" style="display: none;">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="example-datetime-local-input" class="col-2 col-form-label">{{trans('admin.start_outofstock')}}</label>
                                        <div class="col-10">
                                            <input class="form-control start_outofstock_input" type="hidden" min="{{Carbon\Carbon::now()->format('Y-m-d')."T".Carbon\Carbon::now()->format('H:i')}}"  name="start_outofstock">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="example-datetime-local-input" class="col-2 col-form-label">{{trans('admin.end_outofstock')}}</label>
                                        <div class="col-10">
                                            <input class="form-control end_outofstock_input" type="hidden" min="{{Carbon\Carbon::now()->format('Y-m-d')."T".Carbon\Carbon::now()->format('H:i')}}" name="end_outofstock">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="example-datetime-local-input" class="col-2 col-form-label">{{trans('admin.offer_value')}}</label>
                                    <div class="col-10">
                                        <input type="number" class="form-control radius" placeholder="{{trans('admin.offer_value')}}" max="100"  name="value" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="example-datetime-local-input" class="col-2 col-form-label">{{trans('admin.offer_start')}}</label>
                                    <div class="col-10">
                                        <input class="form-control radius" type="datetime-local" min="{{Carbon\Carbon::now()->format('Y-m-d')."T".Carbon\Carbon::now()->format('H:i')}}" name="start_at">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="example-datetime-local-input" class="col-2 col-form-label">{{trans('admin.offer_end')}}</label>
                                    <div class="col-10">
                                        <input class="form-control radius" type="datetime-local" min="{{Carbon\Carbon::now()->format('Y-m-d')."T".Carbon\Carbon::now()->format('H:i')}}"  name="end_at">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-12">
                                <label for="">{{trans('admin.portfolio.description')}}*</label>
                                <textarea name="description" class="form-control radius" placeholder="{{trans('admin.categories.message')}}" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                        <div id="message">
                            <div class="spinner-border text-danger d-none" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <button type="submit" class="btn dashboard-main-bg px-4 text-white">{{trans('admin.categories.save')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @foreach($Additions as $item)
        <!-- delete modal  -->
        <div class="modal fade" id="delete{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{url('api/delete/branch-product/'.$item->id)}}" class="delete">
                        <div class="modal-body">
                            <h6 class="text-dark">  {{trans('admin.categories.delete_p4')}}  {{$item->name}}</h6>
                        </div>
                        <div class="modal-footer d-flex justify-content-between align-items-center">
                            <button type="button" class="btn btn-secondary border-0 bg-transparent text-danger" data-dismiss="modal">{{trans('admin.categories.close')}}</button>
                            <button type="submit" class="btn btn-danger radius text-white">{{trans('admin.categories.delete')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Product edit -->
        <div class="modal fade" id="Product-edit{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <h4 class="py-3 px-2"> {{trans('dashboard.beverages.add_product')}} {{$item->name}}</h4>
                    <div class="modal-body">
                        <form action="{{url('api/edit/branch-product/'.$item->id)}}" class="Add-Product" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="">{{trans('dashboard.beverages.category')}}*</label>
                                    <select name="product_type" class="form-control radius" required>
                                        @if($Providers->category_id == 1)
                                            <option value="Food">Prouduct</option>
                                        @else
                                            <option value="Addition">Prouduct</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">{{trans('dashboard.beverages.branch')}}</label>
                                    <select class="form-control radius" placeholder="branch_id" name="branch_id" required>
                                        @foreach($Branches as $Branch)
                                            <option value="{{$Branch->id}}">{{$Branch->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="">{{trans('dashboard.beverages.product_type')}}*</label>
                                    <select name="product_type" class="form-control radius" required>
                                        <option value="{{$item->product_type}}">{{$item->product_type}}</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="">{{trans('dashboard.beverages.product_name')}}*</label>
                                    <input type="text" class="form-control radius" placeholder="{{trans('dashboard.beverages.product_name')}}" value="{{$item->name}}" name="name" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="">{{trans('dashboard.beverages.price')}}*</label>
                                    <input type="text" class="form-control radius" placeholder="{{trans('dashboard.beverages.price')}}" value="{{$item->price}}" name="price" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="">{{trans('dashboard.beverages.type')}}*</label>
                                    <select class="form-control radius" placeholder="type" name="type" required>
                                        <option >Please Select type</option>
                                        @foreach($types as $type)
                                            <option value="{{$type->id}}" @if($type->id == $item->type) selected @endif>{{ $type->{'type_'.session('lang')} }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="">{{trans('dashboard.beverages.size')}}*</label>
                                    <input type="text" class="form-control radius" placeholder="{{trans('dashboard.beverages.size')}}" value="{{$item->size}}" name="size" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="">{{trans('dashboard.beverages.calories')}}*</label>
                                    <input type="text" class="form-control radius" placeholder="{{trans('dashboard.beverages.calories')}}" value="{{$item->calories}}" name="calories" >
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="">{{trans('dashboard.beverages.addition')}}*</label>
                                    <input type="text" class="form-control radius" placeholder="{{trans('dashboard.beverages.addition')}}" value="{{$item->additions}}" name="additions" >
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="">{{trans('admin.portfolio.image')}}*</label>
                                        <input type="file" id="" name="image"  accept="image/*" onchange="loadFile(event)" class="form-control upload-image" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="">{{trans('admin.portfolio.image')}}*</label>
                                    <div class="input-group-append">
                                        <img src="{{asset('/public/uploads/Product/'.$item->image())}}" class="d-block mx-auto" width="100" height="80" style="object-fit:cover" alt="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="has_pig" id="defaultCheck1" @if($item->has_pig == 1) checked @endif>
                                            <label class="form-check-label" for="defaultCheck1">
                                                {{trans('dashboard.beverages.lard')}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="has_alcohol" id="defaultCheck2" @if($item->has_alcohol == 1) checked @endif>
                                            <label class="form-check-label" for="defaultCheck2">
                                                {{trans('dashboard.beverages.alcohol')}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input out_of_stock" type="checkbox" @if($item->has_outofstock == 1) checked @endif id="out_of_stock-{{$item->id}}">
                                            <label class="form-check-label" for="out_of_stock-{{$item->id}}">
                                                {{trans('admin.has_outofstock')}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-100 has_outofstock_box" @if($item->has_outofstock != 1) style="display: none; @endif">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="example-datetime-local-input" class="col-2 col-form-label">{{trans('admin.start_outofstock')}}</label>
                                            <div class="col-10">
                                                <input class="form-control start_outofstock_input" type="hidden"  value="{{Carbon\Carbon::parse($item->start_outofstock)->format('Y-m-d')."T".Carbon\Carbon::parse($item->start_outofstock)->format('H:i')}}"  name="start_outofstock" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="example-datetime-local-input" class="col-2 col-form-label">{{trans('admin.end_outofstock')}}</label>
                                            <div class="col-10">
                                                <input class="form-control end_outofstock_input" type="hidden" min="{{Carbon\Carbon::now()->format('Y-m-d')."T".Carbon\Carbon::now()->format('H:i')}}" value="{{Carbon\Carbon::parse($item->end_outofstock)->format('Y-m-d')."T".Carbon\Carbon::parse($item->end_outofstock)->format('H:i')}}" name="end_outofstock">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="example-datetime-local-input" class="col-2 col-form-label">{{trans('admin.offer_value')}}</label>
                                        <div class="col-10">
                                            <input type="number" class="form-control radius" placeholder="{{trans('admin.offer_value')}}" max="100" value="{{$item->offer->value??''}}" name="value" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="example-datetime-local-input" class="col-2 col-form-label">{{trans('admin.offer_start')}}</label>
                                        <div class="col-10">
                                            <input class="form-control radius" type="datetime-local"
                                                   value="{{Carbon\Carbon::parse($item->offer->start_at??'')->format('Y-m-d')."T".Carbon\Carbon::parse($item->offer->start_at??'')->format('H:i')}}"  name="start_at">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="example-datetime-local-input" class="col-2 col-form-label">{{trans('admin.offer_end')}}</label>
                                        <div class="col-10">
                                            <input class="form-control radius" type="datetime-local" min="{{Carbon\Carbon::now()->format('Y-m-d')."T".Carbon\Carbon::now()->format('H:i')}}"
                                                   value="{{Carbon\Carbon::parse($item->offer->end_at??'')->format('Y-m-d')."T".Carbon\Carbon::parse($item->offer->end_at??'')->format('H:i')}}" name="end_at">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-12">
                                    <label for="">{{trans('admin.portfolio.description')}}*</label>
                                    <textarea name="description" class="form-control radius" placeholder="{{trans('admin.portfolio.description')}}" cols="30" rows="5">{{$item->description}}</textarea>
                                </div>
                            </div>
                            <div id="message">
                                <div class="spinner-border text-danger d-none" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                            <button type="submit" class="btn dashboard-main-bg px-4 text-white">{{trans('admin.categories.save')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif


@yield('script')
<script>
    $(".out_of_stock").change(function() {
        $(this).closest("form").find('.has_outofstock_box').toggle();

        if ($(this).closest("form").find('.out_of_stock').is(":checked"))
        {
            $(this).closest("form").find('.start_outofstock_input').attr('type', 'datetime-local');
            $(this).closest("form").find('.end_outofstock_input').attr('type', 'datetime-local');
        }
        else
        {
            $(this).closest("form").find('.start_outofstock_input').attr('type', 'hidden').val("0000-00-00T00:00");
            $(this).closest("form").find('.end_outofstock_input').attr('type', 'hidden').val("0000-00-00T00:00");
        }
    });
    $(".plus_meal").on("click", function() {
        let e =  "<div class='row meals_content'>" +
            "                                <div class='form-group col-md-6'>" +
            "                                    <label for=''>{{trans('dashboard.beverages.name')}} *</label>" +
            "                                    <select name='products[]' class='form-control border-radius-5' required>" +
            @foreach($Products as $item2)
                "<option value='{{$item2->id}}'>[{{$item2->id}}] - {{$item2->name}}</option>" +
            @endforeach
                "                                    </select>" +
            "                                </div>" +
            "                                <div class='form-group col-md-5'>" +
            "                                    <label for=''>Amount *</label>" +
            "                                    <div class='input-group'>" +
            "                                        <input type='number' name='amounts[]' class='form-control border-radius-5' placeholder='Amount' required>" +
            "                                    </div>" +
            "                                </div>" +
            "                                <div class='form-group col-md-1'>" +
            "                                    <label for=''>Remove*</label>" +
            "                                    <div class='input-group'>" +
            "                                        <button type='button' class='btn btn-danger remove_time'><i class='fas fa-minus-circle text-white'></i></button>" +
            "                                    </div>" +
            "                                </div>" +
            "                            </div>";
        $(this).parent().parent().parent().parent().append(e);
    })

    function request()
    {
        axios({
            method: 'get',
            url: '{{asset('dashboard/update_time/'.$name.'?duration=')}}'+$('#filter_state').val(),
        }).then(function (response)
        {

        });
    }
</script>
</body>
</html>
