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

    <main id="editprofile">
        <div class="container">
            <div class="mt-5 width-100-per">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="card card-box-shadow border-0 border-radius-20 p-5 mb-4">
                            <div class="profile-image mb-2 width-120 height-120 mx-auto">
                                <form action="{{asset('/api/edit-profile')}}" method="POST" class="profile-pic">
                                    <img src="{{asset('/public/uploads/User/'.Auth::user()->image)}}" class="d-block rounded-circle image" style='width:100%;height:100%' alt="">
                                    <input type="file" class="d-none" name="image" id="profile-pic">
                                    <label for="profile-pic">
                                        <i class="fas fa-camera change-image"></i>
                                    </label>
                                </form>
                            </div>
                            <div class="bold text-center mb-3 username">{{Auth::user()->name}} </div>
                            <div class="profile-tabs">
                                <div class="tab-items semibold cursor-pointer mb-3 active" data-tabing="myorder_content">{{trans('public.profile.orders')}}</div>
                                <div class="tab-items semibold cursor-pointer mb-3" data-tabing="favoritelist_content">{{trans('public.profile.favourite')}}</div>
                                <div class="tab-items semibold cursor-pointer" data-tabing="editaccount_content">{{trans('public.profile.edit')}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div id="myorder_content">

                            <div class="table-responsive mb-4">
                                <table  class="table table-hover codiano-datatable table-striped table-middle text-center font-size-15 mb-0">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="border-top-0">{{trans('public.profile.id')}}</th>
                                        <th scope="col" class="border-top-0">{{trans('public.profile.department')}}</th>
                                        <th scope="col" class="border-top-0">{{trans('public.profile.address')}}</th>
                                        <th scope="col" class="border-top-0">{{trans('public.profile.price')}}</th>
                                        <th scope="col" class="border-top-0">{{trans('public.profile.tax_price')}}</th>
                                        <th scope="col" class="border-top-0">{{trans('public.profile.shipping_price')}}</th>
                                        <th scope="col" class="border-top-0">{{trans('dashboard.delivery.payment')}}</th>
                                        <th scope="col" class="border-top-0">{{trans('public.profile.order_status')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(Auth::user()->Orders as $Order)
                                        <tr class="border-bottom">
                                            <th scope="row">{{$Order->id}}</th>
                                            <td class="bold"> {{$Order->branch->name ?? 'Eboro'}} </td>
                                            <td class="bold text-left">
                                                <a href="https://maps.google.com/?q={{$Order->drop_lat}},{{$Order->drop_long}}">
                                                    <img src="{{asset('resources/views/dashboard/assets/images/branchlocation.svg')}}" alt="">
                                                </a>
                                            </td>
                                            <td class="bold text-left">{{$Order->total_price}} &euro;</td>
                                            <td class="bold">{{$Order->tax_price}} &euro;</td>
                                            <td class="bold text-left">{{$Order->shipping_price}} &euro;</td>
                                            <td class="width-100">
                                                <div>{{$Order->payment == 0 ? 'Cash':''}}</div>
                                                <div>{{$Order->payment == 1 ? 'debit card':''}}</div>
                                                <div>{{$Order->payment == 2 ? 'Paypal':''}}</div>
                                            </td>
                                            <td><button class="btn btn-outline-warning btn-sm">{{$Order->status}}</button></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="favoritelist_content">

                            <div class="row contents current">
                                @foreach(Auth::user()->Favorite as $Order)
                                <div class="col-md-4">
                                    <div class="card card-box-shadow border-0 border-radius-20 p-4">
                                        <img src="{{asset('/public/uploads/Provider/'.$Order->provider->logo)}}" class="card-img" alt="">
                                        <h4 class="red-color text-center font-size-18 bold">{{$Order->provider->name}}</h4>
                                        <span class="text-muted text-center">{{$Order->provider->category->{'name_'.session('lang')} }}</span>
                                        <p class="m-0 font-size-15">{{$Order->provider->description}}</p>
                                        <div class="card-line text-center my-3">
                                            <div class="card-poly">
                                                <img src="{{asset('/public/uploads/Provider/'.$Order->provider->logo)}}" alt="">
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>{{$Order->provider->branch()->count()}} {{trans('public.branch')}}</div>
                                            <a href="{{asset('/Provider/'.$Order->provider->id.'/'.$Order->provider->name)}}" class="btn red-bg text-white btn-sm btn-added-cart">{{trans('public.view')}}</a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div id="editaccount_content" class="card card-box-shadow border-0 border-radius-20 p-4 mb-4">
                            <div class="d-flex align-items-center justify-content-between mb-2 font-size-25">
                                <div class="red-color bold">{{trans('public.profile.edit_profile')}}</div>
                                <div class="edit-BTN" data-edit="edit-profileuser">
                                    <i class="fas fa-pencil-alt red-color cursor-pointer"></i>
                                </div>
                            </div>
                            <form action="{{asset('/api/edit-profile')}}" method="POST" class="edit-profile">
                                <div class="mb-2 font-size-18 mr-2 username">
                                    <span class="semibold">{{trans('public.profile.name')}}:</span>
                                    <input type="text" name="name" value="{{Auth::user()->name}}" class="border-0 bg-white edit-profile-input" disabled>
                                </div>
                                <div class="mb-2 font-size-18 mr-2 email">
                                    <span class="semibold">{{trans('public.profile.email')}}:</span>
                                    <input type="email" name="email" value="{{Auth::user()->email}}" class="border-0 bg-white edit-profile-input" disabled>
                                </div>
                                <div class="mb-2 font-size-18 mr-2 mobile">
                                    <span class="semibold">{{trans('public.profile.mobile')}}:</span>
                                    <input type="number" name="mobile" value="{{Auth::user()->mobile}}" class="border-0 bg-white edit-profile-input" disabled>
                                </div>
                                <div class="mb-2 font-size-18 mr-2 mobile">
                                    <span class="semibold">{{trans('public.profile.address')}}:</span>
                                    <input type="text" name="address" value="{{Auth::user()->address}}" class="border-0 bg-white edit-profile-input" disabled>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-2 font-size-18 mr-2">
                                    <div class="semibold">
                                        {{trans('public.profile.password')}}:
                                        <input type="password" name="password" class="ch-password in-disabled password edit-profile-input"  disabled class="psw-user" value="" style="border:0"></div>
                                    <div class="showpsw" data-chpsw="ch-password">
                                        <i class="fas fa-eye-slash red-color cursor-pointer"></i>
                                    </div>
                                </div>
                                <div class="mb-2 font-size-18 mr-2 mobile">
                                    <span class="semibold">{{trans('public.profile.confirm_password')}}:</span>
                                    <input type="password" name="password_confirmation" class="ch-password in-disabled password edit-profile-input"  disabled class="psw-user" value="" style="border:0"></div>
                                </div>
                                <div class="bold red-color font-size-13 cursor-pointer edit-BTN d-inline" data-edit="ch-psw">
                                </div>
                                <div id="register-errors">
                                    <div class="spinner-border text-danger d-none" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                                <button class="red-bg text-white btn mt-3" hidden type="submit">{{trans('public.profile.save')}}</button>
                            </form>
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
