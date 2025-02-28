@include('site.paritial.include')
    <!DOCTYPE html>
<html>
<head>
@yield('SEO')
<!-- TITLE TAG -->
    <title>{{$items->name??"Eboro"}}</title>
    <meta property="og:description" content="{{$items->description}}">
    <meta name="description" content="{{$items->description}}">
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

    <main id="product-details">

        <div class="container">
            <div class="mt-5 width-100-per">
                <div class="container">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="row">
                                <img src="{{asset('public/uploads/Product/'.$items->image()??"")}}"
                                     alt="Eboro {{$items->name}}"
                                     style="width:100%;height: 100%;max-height: 300px;object-fit: none;">
                            </div>

                            @if($offers->where('product_id' , $items->id)->first() != null)
                                <div class="row">
                                    <div class="Box">
                                        {{$items->offer->value}} %
                                    </div>
                                </div>
                            @endif
                            @if($meal_offer)
                                <div class="row">
                                    <div class="card border-0 border-radius-20 mt-4 p-5 bg-all overlay-blue">
                                        <div class="zindex">
                                            <h3 class="bold orange-color mb-4">{{trans('public.product_details.offer')}}</h3>
                                            <h3 class="bold text-white mb-4">Buy ({{$meal_offer->value}}) {{$meal_offer->product->name}} </h3>
                                            <h3 class="bold text-white mb-4">TO Get</h3>
                                            @foreach($meal_offer->Meal_products as $pro)
                                                <h3 class="bold orange-color">({{$pro->amounts}}) {{$pro->product->name}}</h3>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex">
                                        <div class="mr-3">
                                            @if($items->has_outofstock == 1)
                                                <h4 class="red-color font-size-20 bold mb-0">{{$items->name}} - {{trans('admin.has_outofstock') }}</h4>
                                            @else
                                                <h4 class="red-color font-size-20 bold mb-0">{{$items->name}}</h4>
                                            @endif
                                            <div class="blue-color">{{$items->branch->provider->name}}</div>
                                        </div>
                                        {{--<div class="rate-box cursor-pointer" onclick="addToFav()">--}}
                                            {{--<i class="far fa-star"></i>--}}
                                        {{--</div>--}}
                                    </div>
                                </div>
                            </div>
                            <h2>{{$items->description}}</h2>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <div class="blue-color bold font-size-18 mb-2">
                                        @if($offers->where('product_id' , $items->id)->first() != null)
                                            Offer {{trans('public.product_details.price')}} : {{$items->price - (($offer->value/100)*$items->price)}} &euro;  ({{$offer->value}} %)<br/>
                                            {{trans('public.product_details.price')}} : <del>{{$items->price}}</del>  &euro;
                                        @else
                                            {{trans('public.product_details.price')}} : {{$items->price}} &euro;
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 text-right">
                                    @if (auth()->user() && $items->branch->status === 0)
                                        @if($items->has_outofstock == 0 && $items->branch->provider->lock != "lock" && count($Sauces) == 0)
                                            <button class="btn btn-outline-danger btn-sm mr-2" id="addToCart" onclick="addToCart({{$items->id}})">{{trans('public.add_to_cart')}}</button>
                                        @elseif($items->has_outofstock == 0 && $items->branch->provider->lock != "lock" && count($Sauces) > 0)
                                            <div class="dropdown">
                                                <a href="#" class="btn btn-outline-danger btn-sm mr-2" type="button"
                                                   id="dropdownMenuButton" data-toggle="modal" data-target="#addPOPUP"
                                                   aria-haspopup="true" aria-expanded="false">
                                                    {{trans('public.add_to_cart')}}
                                                </a>
                                            </div>
                                        @endif
                                    @elseif($items->branch->status === 1)
                                        <button class="btn btn-outline-danger btn-sm mr-2" >Closed</button>
                                    @else
                                        <button class="btn btn-outline-danger btn-sm mr-2 btn-login" >{{trans('public.add_to_cart')}}</button>
                                    @endif

                                </div>
                            </div>

                            <div>

                                <div class="semibold mb-3">{{trans('public.product_details.type')}}
                                    : {{ $items->typed->{'type_'.session('lang')} }}</div>
                                <div class="semibold mb-3">{{trans('public.product_details.size')}}
                                    : {{$items->size}}</div>
                                <div class="semibold mb-3">{{trans('public.product_details.brand')}}
                                    : {{$items->branch->provider->name}}</div>
                                <div class="semibold mb-3">{{trans('public.product_details.type')}}
                                    : {{$items->branch->provider->category->{'name_'.session('lang')} }}</div>
                                <div class="semibold mb-3">{{trans('public.product_details.product_type')}}
                                    : {{$items->product_type}}</div>
                                @if($items->calories)
                                    <div class="semibold mb-3">{{trans('public.product_details.calories')}}
                                        : {{$items->calories}}</div>
                                @endif
                                @if($items->additions)
                                <div class="semibold mb-3">{{trans('public.product_details.additions')}}
                                    : {{$items->additions}}</div>
                                @endif
                                <div class="semibold mb-3">{{trans('public.product_details.has_alcohol')}}
                                    : {{$items->has_alcohol == 1 ? 'Yes' : 'NO'}}</div>
                                <div class="semibold mb-3">{{trans('public.product_details.has_pig')}}
                                    : {{$items->has_pig == 1 ? 'Yes' : 'NO'}}</div>
                            </div>
                        </div>
                    </div>
                    <div>
                        @if(count($comments) > 0)
                            <h2 class="bold blue-color mb-5">{{trans('public.product_details.reviews')}}</h2>
                        @endif
                        @foreach($comments as $comment)
                            <div class="mb-4">
                                <div class="d-flex mb-3">
                                    <img src="{{asset('/public/uploads/User/'.$comment->user->image)}}"
                                         class="width-70 height-70 rounded-circle" alt="">
                                    <div class="ml-3">
                                        <div class="blue-color bold">{{$comment->user->name}}</div>
                                        <div class="semibold">{{$comment->created_at->diffForHumans()}}</div>
                                    </div>
                                </div>
                                <div>
                                    <p>{{$comment->comment}}</p>
                                </div>
                                <div
                                    class="text-right red-color font-size-18 d-flex align-items-center justify-content-end">
                                    <div action="{{asset('CommentLike/'.$comment->id)}}"
                                         class="like-box cursor-pointer mr-2 @if(Auth::user() && count($comment_likes->where('user_id', Auth::user()->id)) > 0) filled @endif"
                                         data-liking="like-count{{$comment->id}}">
                                        <i class="@if(Auth::user() && count($comment_likes->where('user_id', Auth::user()->id)) > 0) fas @else far @endif fa-thumbs-up"></i>
                                    </div>
                                    <span
                                        class="bold like-count{{$comment->id}}">{{count($comment_likes->where('comment_id', $comment->id))}}</span>
                                </div>
                            </div>
                        @endforeach
                        @if(Auth::user())
                            <div>
                                <h4 class="blue-color bold mb-3">{{count($comments)}} {{trans('public.product_details.comments')}}</h4>
                                <form action="{{asset('Comment/'.$items->id)}}" method="POST">
                                    @csrf
                                    <textarea name="comment" minlength="10"
                                              class="form-control border-0 p-3 placeholder-gray" rows="5"
                                              style="background:#F5F5F5" placeholder="Write a response..."></textarea>
                                    <div class="text-right">
                                        <button type="submit" class="btn red-bg text-white btn-sm my-3 "
                                                data-open="alert-successfuly-message">{{trans('public.product_details.submit')}}</button>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="addPOPUP">
        <div class="modal-dialog modal-lg">
            <div class="modal-content p-3">
                <div class="modal-header p-0 border-0">
                    <h4 class="py-3 px-2">  {{trans('public.product_details.sauce_info')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">  {{trans('public.product_details.sauce_select')}}*</label>
                            <div class="input-group mb-0 search" style="width:90%;">
                                <select class="form-control right-radius" id="sauce_select_option" required>
{{--                                    <option value="">{{trans('public.product_details.select')}}</option>--}}
                                    @foreach($Sauces as $Sauce)
                                        <option value="{{$Sauce->sauce->id}}">{{$Sauce->sauce->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="">  {{trans('public.product_details.size')}}*</label>
                            <div class="input-group mb-0 search" style="width:90%;">
                                <select class="form-control right-radius" id="size" required>
{{--                                    <option value="">{{trans('public.product_details.select')}}</option>--}}
                                    @foreach(explode(',',$items->size) as $row)
                                        <option>{{$row}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 d-flex justify-content-end">
                    @if (auth()->user())
                    <button class="btn btn-outline-danger btn-sm mr-2" id="addToCart" onclick="addToCart({{$items->id}})">{{trans('public.add_to_cart')}}</button>
                    @elseif($items->branch->status === 1)
                        <button class="btn btn-outline-danger btn-sm mr-2" >Closed</button>
                    @else
                        <button class="btn btn-outline-danger btn-sm mr-2 btn-login" >{{trans('public.add_to_cart')}}</button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Start Footer -->
@yield('footer')
<!-- End Footer -->
</main>
@yield('script')
@if (auth()->user() && $items->branch->status === 0)
    <script>
        function addToCart(item,qty=1)
        {
            suace = $('#sauce_select_option').val();
            $.ajax({
                method: 'post',
                url: '{{url('api/add-cart')}}',
                headers: {"Authorization":"Bearer {{auth()->user()->generateAuthToken()??''}}" },
                data: {
                    product_id: item,
                    sauce_id: suace,
                    qty: qty,
                },
                success: function (res) {
                    window.location.reload(3000)
                }
            });
        }
    </script>

@endif
</body>
</html>
