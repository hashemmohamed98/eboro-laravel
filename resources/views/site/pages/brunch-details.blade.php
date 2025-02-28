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

    <style>
        .rating {
            display: -webkit-box;
            display: flex;
            width: 100%;
            -webkit-box-pack: center;
            justify-content: center;
            overflow: hidden;
            -webkit-box-orient: horizontal;
            -webkit-box-direction: reverse;
            flex-direction: row-reverse;
            position: relative;
        }

        .rating-0 {
            -webkit-filter: grayscale(100%);
            filter: grayscale(100%);
        }

        .rating>input {
            display: none;
        }

        .rating>label {
            cursor: pointer;
            width: 40px;
            height: 40px;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23e3e3e3' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: center;
            background-size: 60%;
            -webkit-transition: .3s;
            transition: .3s;
        }

        .rating>input:checked~label,
        .rating>input:checked~label~label {
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23fcd93a' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e");
        }

        .feedback {
            max-width: 360px;
            background-color: #fff;
            width: 100%;
            padding: 30px;
            border-radius: 8px;
            display: -webkit-box;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            flex-direction: column;
            flex-wrap: wrap;
            -webkit-box-align: center;
            align-items: center;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05);
        }
    </style>

</head>
<body>
<main id="homepage">
    <!-- Start Navbar -->
    @yield('Nav')
    <!-- End Navbar -->

    <main id="resturant-details">

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
                        <div class="row grid-layout contents current">
                            @foreach($items as $item)
                                <div class="col-md-4">
                                    <div class="card card-box-shadow border-0 border-radius-20 p-4">
                                        <div class="grid-content">
                                            <div class="mr-3">
                                                <img src="{{asset('public/uploads/Product/'.$item->image())}}" class="card-img" height="150" alt="{{$item->name}}">
                                            </div>
                                            <div>
                                                <a href="{{asset('/product-details/'.$item->id.'/'.$item->name)}}">
                                                    <h4 class="c-ele red-color text-center font-size-18 bold">{{$item->name}}</h4>
                                                    <div class="c-ele text-muted text-center">{{$item->type}}</div>
                                                    <p class="m-0 font-size-15">{{$item->description}}</p>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="card-line text-center my-3">
                                            <div class="card-poly">
                                                <img src="{{asset('public/uploads/Product/'.$item->image())}}" alt="{{$item->name}}">
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>{{$item->product->price}} €</div>
                                            @if (Auth::user())
                                                <button class="btn red-bg text-white btn-sm " onclick="addToCart({{$item->id}})">{{trans('public.add_to_cart')}}</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @foreach($Additions as $item)
                                <div class="col-md-4">
                                    <div class="card card-box-shadow border-0 border-radius-20 p-4">
                                        <div class="grid-content">
                                            <div class="mr-3">
                                                <img src="{{asset('public/uploads/Product/'.$item->image())}}" class="card-img" height="150" alt="{{$item->name}}">
                                            </div>
                                            <div>
                                                <a href="{{asset('/product-details/'.$item->id.'/'.$item->name)}}">
                                                    <h4 class="c-ele red-color text-center font-size-18 bold">{{$item->name}}</h4>
                                                    <div class="c-ele text-muted text-center">{{$item->type}}</div>
                                                    <p class="m-0 font-size-15">{{$item->description}}</p>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="card-line text-center my-3">
                                            <div class="card-poly">
                                                <img src="{{asset('public/uploads/Product/'.$item->image())}}" alt="{{$item->name}}">
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>{{$item->product->price}} €</div>
                                            @if (Auth::user())
                                                <button class="btn red-bg text-white btn-sm " onclick="addToCart({{$item->id}})">{{trans('public.add_to_cart')}}</button>
                                            @endif
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
