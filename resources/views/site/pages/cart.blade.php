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

    <main id="cart">

        <div class="container">
            <div class="mt-5 width-100-per">
                <div class="cart-details">
                    <div class="card card-box-shadow border-0 border-radius-20 p-5 mb-4">
                        <div class="row mb-5">
                            <div class="col-md-12">
                                <div class="cart-table height-300" style="max-height:300px;">
                                    <table class="table table-borderless table-middle table-hover table-font m-0">
                                        <thead class="blue-bg text-white">
                                        <tr>
                                            <th>{{trans('public.cart.product')}}</th>
                                            <th>{{trans('public.cart.product_name')}}</th>
                                            <th>{{trans('public.cart.quantity')}}</th>
                                            <th>{{trans('public.cart.total')}}</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach(auth()->user()->carts as $item)
                                            <tr class="border-bottom">
                                                <td class="width-100">
                                                    <div>
                                                        <img
                                                            src="{{url('public/uploads/Product/'.$item->product->image)}}"
                                                            class="width-70" alt="" title="">
                                                    </div>
                                                </td>
                                                <td class="width-100">
                                                    <div class="bold">{{$item->product->name}}</div>
                                                    @if($item->sauce)
                                                        <div class="row">
                                                            <div class="col-lg-2">
                                                                <img src="{{asset('public/uploads/Product/'.$item->sauce->image ?? '')}}" width="25" height="25" alt="{{$item->sauce->name}}" class="rounded-circle">
                                                            </div>
                                                            <div class="col-lg-10">
                                                                <span class="text-secondary font-size-14">{{$item->sauce->name}} x {{$item->sauce->price}} &euro;</span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td class="width-100">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-minus-circle" onclick="minus({{$item->product->id??''}},{{$item->sauce->id??''}})"></i>
                                                        <div class="qunt-value-{{$item->product->id}} mx-2">{{$item->qty}}</div>
                                                        <i class="fas fa-plus-circle" onclick="plus({{$item->product->id??''}},{{$item->sauce->id??''}})"></i>
                                                    </div>
                                                </td>
                                                <td class="width-100">
                                                    <div class="font-weight-bold">{{$item->product->price}} &euro;</div>
                                                </td>
                                                <td class="width-50">
                                                    <img src="svg-icons/deletecart.svg"
                                                         class="delete-product cursor-pointer" width="25" alt=""
                                                         onclick="deleteCart({{$item->id}})">
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 bold font-size-20">{{trans('public.cart.total')}}:
                            {{auth()->user()->carts->sum('price')}} &euro;
                        </div>
                        <div class="col-md-6 d-flex justify-content-end">
                            <a href="{{asset('checkout')}}" class="btn red-bg text-white btn-sm">{{trans('public.cart.checkout')}}</a>
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
    <script>
        function deleteCart(item) {
            $.ajax({
                method: 'get',
                url: '{{url('api/delete-cart-item')}}/' + item,
                headers: {"Authorization": "Bearer {{auth()->user()->generateAuthToken()??''}}"},
                success: function (res) {
                    window.location.reload();
                }
            });
        }
        function minus(item,suace=null) {
            $.ajax({
                method: 'post',
                url: '{{url('api/add-cart')}}',
                headers: {"Authorization":"Bearer {{auth()->user()->generateAuthToken() ?? ''}}" },
                data: {
                    product_id: item,
                    sauce_id: suace,
                    qty: -1,
                },
                success: function (res) {
                    location.reload();
                },
                error: function (res) {
                    location.reload();
                }
            });
        }
        function plus(item,suace=null) {
            $.ajax({
                method: 'post',
                url: '{{url('api/add-cart')}}',
                headers: {"Authorization":"Bearer {{auth()->user()->generateAuthToken() ?? ''}}" },
                data: {
                    product_id: item,
                    sauce_id: suace,
                    qty: 1,
                },
                success: function (res) {
                    location.reload();
                },
                error: function (res) {
                    location.reload();
                }
            });
        }
    </script>
</body>
</html>
