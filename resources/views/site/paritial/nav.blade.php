@section('Nav')
    <!-- Start Main Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid ">
            <a class="navbar-brand" href="#">
                <img src="{{asset('public/uploads/setting/'.$share_setting->logo)}}" width="100" alt="Eboro Logo">
            </a>
            <button class="hamburger hamburger--spin navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="hamburger-box">
                  <span class="hamburger-inner"></span>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto d-flex align-items-center">
                    <li class="nav-item @php if(Request::is('/')) {echo 'active'; } @endphp">
                        <a class="nav-link bold px-3" href="{{asset('/')}}">{{trans('public.navbar.home')}}</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link bold px-3 text-center dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{trans('public.navbar.category')}}
                        </a>
                        <div class="dropdown-menu nav-dropmenu animated flipInY p-0" aria-labelledby="navbarDropdown" style="width:300px">
                            <div class="d-flex flex-wrap">
                                @foreach($Categories as $Category)
                                    <a class="text-center py-2 dropdown-item px-1 d-flex flex-column align-items-center justify-content-center" href="{{asset('/category/'.$Category->id .'/'.$Category->{'name_'.session('lang')} )}}" style="width:33.333333%">
                                        <img src="{{asset('/public/uploads/Category/'.$Category->image)}}" width="40" height="40" alt="">
                                        <div style="font-size:13px;margin-top:5px;">{{$Category->{'name_'.session('lang')} }}</div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </li>

                    <li class="nav-item @php if(Request::is('aboutus')) {echo 'active'; } @endphp">
                        <a class="nav-link bold px-3" href="{{asset('/aboutus')}}">{{trans('public.navbar.about')}}</a>
                    </li>
                    <li class="nav-item @php if(Request::is('contact')) {echo 'active'; } @endphp">
                        <a class="nav-link bold px-3" href="{{asset('/contact')}}">{{trans('public.navbar.contact')}}</a>
                    </li>
                    <li class="nav-item @php if(Request::is('privacy')) {echo 'active'; } @endphp">
                        <a class="nav-link bold px-3" href="{{asset('/privacy')}}">{{trans('public.footer.privacy')}}</a>
                    </li>
                    <li class="nav-item @php if(Request::is('deliver')) {echo 'active'; } @endphp">
                        <a class="nav-link bold px-3" href="{{asset('/deliver')}}">{{trans('public.deliver.title')}}</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto d-flex align-items-center">

                    @guest
                        <li class="nav-item">
                            <a class="nav-link bold px-3 btn-login" href="#">{{trans('public.navbar.login')}}</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link px-3 py-1 btn red-bg text-white btn-sm btn-sign">{{trans('public.navbar.signup')}}</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link px-3 bold px-3 dropdown-toggle d-flex align-items-center flex-center-mob" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{asset('/public/uploads/User/'.Auth::user()->image)}}" class="card-box-shadow user-pic image" width="40" height="40" alt="" style="border-radius:50%;"> <span class="bold ml-2 username">{{Auth::user()->name}}</span>
                            </a>
                            <div class="dropdown-menu animated flipInY drop-lang width-200" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item d-flex align-items-center" href="{{asset('/Profile/'.Auth::user()->name)}}">
                                    <img src="{{asset('/public/uploads/User/'.Auth::user()->image)}}" width="16" /> <span class="ml-2">{{Auth::user()->name}} Profile</span>
                                </a>
                                @foreach($MyProviders as $Provider)
                                    @if(Auth::user()->type == 1)
                                        <a class="dropdown-item d-flex align-items-center" href="{{asset('/dashboard/provider/'.$Provider->name)}}">
                                            <img src="{{asset('/public/uploads/Provider/'.$Provider->logo)}}" width="16" /> <span class="ml-2">{{$Provider->name}}</span>
                                        </a>
                                    @else
                                        <a class="dropdown-item d-flex align-items-center" href="{{asset('/dashboard/Orders/'.$Provider->name)}}">
                                            <img src="{{asset('/public/uploads/Provider/'.$Provider->logo)}}" width="16" /> <span class="ml-2">{{$Provider->name}}</span>
                                        </a>
                                    @endif
                                @endforeach
                                @if(Auth::user()->type == 1)
                                    <a class="dropdown-item d-flex align-items-center" href="{{asset('/admin/home/')}}">
                                        <img src="{{asset('images/sitelogo.jpeg')}}" width="16" /> <span class="ml-2">Admin Dashboard</span>
                                    </a>
                                @endif
                                <a class="dropdown-item d-flex align-items-center" id="logout" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> <span class="ml-2">{{trans('admin.logout')}}</span>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>

                    @endif
                    <li class="nav-item dropdown mega-dropdown">
                        @if (Auth::user())
                            <a class="nav-link link-cart px-3" href="#" data-cart="dropdown-cart">
                                <div class="cart-result bold" id="cartQty">{{auth()->user()->carts->sum('qty')}}</div>
                                <img src="{{asset('svg-icons/cart-icon.svg')}}" style="width:25px;" alt="">
                            </a>

                            <div class="dropdown-cart animated flipInY drop-lang" style="width:350px;">
                                <div class="p-4">
                                    <h4 class="blue-color bold font-size-25">{{trans('admin.cart')}}</h4>
                                    <div class="cart-added-content">
                                        <div class="cart-added-in">

                                            @foreach(auth()->user()->carts as $item)
                                                <div class="d-flex align-items-center justify-content-between mb-3">
                                                    <div class="red-color semibold"></div>
                                                </div>
                                                <div class="cart-content d-flex align-items-center cart-one">
                                                    <div class="col-lg-4">
                                                        <img src="{{asset('public/uploads/Product/'.($item->product->image??'logo.jpeg'))}}" width="80" height="80" alt="{{$item->product->name}}" class="rounded-circle">
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <span class="bold blue-color font-size-16">{{$item->product->name}} ({{$item->qty}})</span>
                                                        @if($item->sauce)
                                                           <div class="row">
                                                               <div class="col-lg-8">
                                                                   <span class="text-secondary font-size-14">{{$item->sauce->name}} x {{$item->sauce->price}} &euro;</span>
                                                               </div>
                                                               <div class="col-lg-4">
                                                                   <img src="{{asset('public/uploads/Product/'.($item->sauce->image ?? 'logo.jpeg'))}}" width="25" height="25" alt="{{$item->sauce->name}}" class="rounded-circle">
                                                               </div>
                                                           </div>
                                                        @endif
                                                        <div class="row">
                                                            <div class="col-lg-10">
                                                                <span class="bold text-muted font-size-14">{{$item->product->price}} &euro;</span>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="cursor-pointer pr-3" onclick="RemoveToCart({{$item->id}})"><i class="fas fa-trash text-danger"></i></div>
                                                                <script>
                                                                    function RemoveToCart(item) {
                                                                        $.ajax({
                                                                            method: 'get',
                                                                            url: '{{url('api/delete-cart-item')}}'+ '/'+ item,
                                                                            headers: {"Authorization":"Bearer {{auth()->user()->generateAuthToken()??''}}" },
                                                                            success: function (res) {
                                                                                location.reload();
                                                                            }
                                                                        });
                                                                    }
                                                                </script>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between my-4">
                                        <div class="bold blue-color">{{trans('public.navbar.cart.subtotal')}} :</div>
                                        <div id="cartTotal">{{auth()->user()->carts->sum('price')}} &euro;</div>
                                    </div>
                                    <div class="px-3">
                                        <div class="mb-3 d-flex justify-content-center">
                                            <a href="{{asset('/cart')}}" class="btn btn-outline-danger btn-sm border-radius-10 width-200 py-2">
                                                <img src="{{asset('svg-icons/cart-icon-w.svg')}}" width="30" alt="">
                                                <span class="ml-3 bold">{{trans('public.navbar.cart.view')}}</span>
                                            </a>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{asset('/checkout')}}" class="btn red-bg text-white btn-sm border-radius-10 width-200 py-2">
                                                <img src="{{asset('svg-icons/creditcard-w.svg')}}" width="30" alt="">
                                                <span class="ml-3 bold">{{trans('public.navbar.cart.checkout')}}</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endif
                    </li>
                    <li class="nav-item dropdown">
                        @if(session()->has('lang') && session()->get('lang') == "en")
                            <a class="nav-link px-3 bold px-3 dropdown-toggle d-flex align-items-center flex-center-mob" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{asset('svg-icons/unitedkingdom.png')}}" class="width-20 mr-1" alt=""> <span class="bold">ENG</span>
                            </a>
                        @else
                            <a class="nav-link px-3 bold px-3 dropdown-toggle d-flex align-items-center flex-center-mob" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{asset('svg-icons/italyflag.svg')}}" class="width-20 mr-1" alt=""> <span class="bold">ITA</span>
                            </a>
                        @endif
                        <div class="dropdown-menu animated flipInY drop-lang" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item d-flex align-items-center" href="{{asset('lang/en')}}">
                                <img src="{{asset('svg-icons/unitedkingdom.png')}}" class="width-20 mr-1" alt=""> <span class="ml-2 bold">ENG</span>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="{{asset('lang/it')}}">
                                <img src="{{asset('svg-icons/italyflag.svg')}}" class="width-20 mr-1" alt=""> <span class="ml-2 bold">ITA</span>
                            </a>
                        </div>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

@endsection

