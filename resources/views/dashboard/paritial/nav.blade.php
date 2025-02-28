@section('Nav')
    <aside class="scroll-ele left-sidebar expanded" id="sidebar" >
        <a href="{{asset('/')}}" class="logo d-block text-center mb-4 @php if(Request::is('dashboard/Home')) {echo 'active'; } @endphp">
            <img src="{{asset('public/uploads/setting/'.$share_setting->logo)}}" class="expanded" width="150" alt="Logo" />
        </a>
        <div class="sidebar-links sm-padding">
            <ul class="list-unstyled p-0 m-0">
                @if(auth::user()->type == 4 )
                    <li>
                        <a href="{{url('dashboard/Orders/'.$Providers->name)}}" class="sidebar-link d-flex align-items-center main-color mb-4 @php if(Request::is('dashboard/Orders/'.$Providers->name)) {echo 'active'; } @endphp">
                            <div class="link-icon mr-3">
                                <img src="{{asset('resources/views/dashboard/assets/images/order.svg')}}" width="15" alt="" style="filter: brightness(100);">
                            </div>
                            <div class="link-text d-none">{{trans('dashboard.Navmenu.Orders')}}</div>
                        </a>
                    </li>
                @else
                    <li>
                        <a href="{{url('dashboard/provider/'.$Providers->name)}}" class="sidebar-link d-flex align-items-center main-color mb-4 @php if(Request::is('dashboard/provider/'.$Providers->name)) {echo 'active'; } @endphp">
                            <div class="link-icon mr-3">
                                <img src="{{asset('resources/views/dashboard/assets/images/dashboard.svg')}}" width="15" alt="" style="filter: brightness(100);">
                            </div>
                            <div class="link-text d-none">{{trans('dashboard.Navmenu.Dashboard')}}</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('dashboard/Orders/'.$Providers->name)}}" class="sidebar-link d-flex align-items-center main-color mb-4 @php if(Request::is('dashboard/Orders/'.$Providers->name)) {echo 'active'; } @endphp">
                            <div class="link-icon mr-3">
                                <img src="{{asset('resources/views/dashboard/assets/images/order.svg')}}" width="15" alt="" style="filter: brightness(100);">
                            </div>
                            <div class="link-text d-none">{{trans('dashboard.Navmenu.Orders')}}</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('dashboard/cashers/'.$Providers->name)}}" class="sidebar-link d-flex align-items-center main-color mb-4 @php if(Request::is('dashboard/cashers/'.$Providers->name)) {echo 'active'; } @endphp">
                            <div class="link-icon mr-3">
                                <img src="{{asset('resources/views/dashboard/assets/images/cashers.svg')}}" width="13" alt="" style="filter: brightness(100);">
                            </div>
                            <div class="link-text d-none">{{trans('dashboard.Navmenu.Cashers')}}</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('dashboard/resturant/'.$Providers->name)}}" class="sidebar-link d-flex align-items-center main-color mb-4 @php if(Request::is('dashboard/resturant/'.$Providers->name)) {echo 'active'; } @endphp">
                            <div class="link-icon mr-3">
                                <img src="{{asset('resources/views/dashboard/assets/images/restaurant.svg')}}" width="20" alt="" style="filter: brightness(100);">
                            </div>
                            <div class="link-text d-none">{{$Providers->category->{'name_'.session('lang')} }}</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('dashboard/inner_types/'.$Providers->name)}}" class="sidebar-link d-flex align-items-center main-color mb-4 @php if(Request::is('dashboard/inner_types/'.$Providers->name)) {echo 'active'; } @endphp">
                            <div class="link-icon mr-3">
                                <i class="fas fa-cubes" ></i>
                            </div>
                            <div class="link-text d-none">Types</div>
                        </a>
                    </li>
{{--                    <li>--}}
{{--                        <a href="{{url('dashboard/client/'.$Providers->name)}}" class="sidebar-link d-flex align-items-center main-color mb-4 @php if(Request::is('dashboard/client/'.$Providers->name)) {echo 'active'; } @endphp">--}}
{{--                            <div class="link-icon mr-3">--}}
{{--                                <img src="{{asset('resources/views/dashboard/assets/images/client.svg')}}" width="22" alt="" style="filter: brightness(100);">--}}
{{--                            </div>--}}
{{--                            <div class="link-text d-none">Clients</div>--}}
{{--                        </a>--}}
{{--                    </li>--}}
                    @if($Providers->delivery == 1)
                        <li>
                            <a href="{{url('dashboard/delivery/'.$Providers->name)}}" class="sidebar-link d-flex align-items-center main-color mb-4 @php if(Request::is('dashboard/delivery/'.$Providers->name)) {echo 'active'; } @endphp">
                                <div class="link-icon mr-3">
                                    <img src="{{asset('resources/views/dashboard/assets/images/delivery.svg')}}" width="23" alt="" style="filter: brightness(100);">
                                </div>
                                <div class="link-text d-none">{{trans('dashboard.Navmenu.Delivery')}}</div>
                            </a>
                        </li>
                    @endif
                    @if($Providers->category_id == 1)
                        <li>
                            <a href="{{url('dashboard/sauce/'.$Providers->name)}}" class="sidebar-link d-flex align-items-center main-color mb-4 @php if(Request::is('dashboard/sauce/'.$Providers->name)) {echo 'active'; } @endphp">
                                <div class="link-icon mr-3">
                                    <img src="{{asset('resources/views/dashboard/assets/images/sauce.svg')}}" width="15" alt="" style="filter: brightness(100);">
                                </div>
                                <div class="link-text d-none">{{trans('dashboard.Navmenu.Sauce')}}</div>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('dashboard/beveraged/'.$Providers->name)}}" class="sidebar-link d-flex align-items-center main-color mb-4 @php if(Request::is('dashboard/beveraged/'.$Providers->name)) {echo 'active'; } @endphp">
                                <div class="link-icon mr-3">
                                    <img src="{{asset('resources/views/dashboard/assets/images/Beverages.svg')}}" width="15" alt="" style="filter: brightness(100);">
                                </div>
                                <div class="link-text d-none">{{trans('dashboard.Navmenu.Beverages')}}</div>
                            </a>
                        </li>
                    @endif
                @endif
            </ul>
        </div>
        <div class="bycodiano-container">
            <a href="https://codiano.com/" class="bycodiano d-flex align-items-center justify-content-center">
                <div class="by-text d-none text-white mr-2">By</div>
                <img src="{{asset('resources/views/dashboard/assets/images/codianologo.svg')}}" width="50" alt="Codiano Logo">
            </a>
        </div>
    </aside>
@endsection
