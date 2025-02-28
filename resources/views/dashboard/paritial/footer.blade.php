@section('footer')
    <aside class="right-sidebar right-bar">
        <div class="sidebarright-header position-relative">
            <div class="d-flex justify-content-between align-items-center px-3 pt-4">
                <div class="d-flex align-items-center">
                    <div class="user-img">
                        <img src="{{asset('/public/uploads/User/'.Auth::user()->image)}}" alt="">
                    </div>
                    <div class="font-bold text-white ml-2">{{Auth::user()->name}}</div>
                </div>

            </div>
        </div>
        <div class="mt-5">
            <div class="px-3 mb-3">
                <h5 class="font-bold mb-3">Notification</h5>
                @foreach($Favorites as $Favorite)
                    <div>
                        <div class="position-relative d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <img src="{{asset('/public/uploads/Provider/'.$Providers->logo)}}" alt="" width="50">
                                <div class="ml-2">
                                    <div class="font-size-15">"{{$Favorite->user->name}}" Favorites Us</div>
                                    <div class="text-muted font-size-14">{{$Favorite->created_at->format('d M, Y')}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="poly-card">
                            <div class="poly-img">
                                <img src="{{asset('resources/views/dashboard/assets/images/polygonincards.svg')}}" alt="">
                            </div>
                        </div>
                    </div>
                @endforeach
                @foreach($Rates as $Rate)
                    <div>
                        <div class="position-relative d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <img src="{{asset('/public/uploads/Provider/'.$Providers->logo)}}" alt="" width="50">
                                <div class="ml-2">
                                    <div class="font-size-15">"{{$Rate->user->name}}" Rate Us by {{$Rate->value}} Star</div>
                                    <div class="text-muted font-size-14">{{$Rate->created_at->format('d M, Y')}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="poly-card">
                            <div class="poly-img">
                                <img src="{{asset('resources/views/dashboard/assets/images/polygonincards.svg')}}" alt="">
                            </div>
                        </div>
                    </div>
                @endforeach
                @foreach($Comments as $Comment)
                    <div>
                        <div class="position-relative d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <img src="{{asset('/public/uploads/Provider/'.$Providers->logo)}}" alt="" width="50">
                                <div class="ml-2">
                                    <div class="font-size-15">"{{$Comment->user->name}}" Comment at <a href="{{asset('product-details/'.$Comment->product->id .'/'.$Comment->product->name)}}">{{$Comment->product->name}}</a></div>
                                    <div class="text-muted font-size-14">{{$Comment->created_at->format('d M, Y')}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="poly-card">
                            <div class="poly-img">
                                <img src="{{asset('resources/views/dashboard/assets/images/polygonincards.svg')}}" alt="">
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>

        </div>
    </aside>

@endsection

