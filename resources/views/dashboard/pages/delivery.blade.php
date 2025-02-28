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
                    <h2 class="main-color font-bold">{{trans('dashboard.delivery.delivery_man')}}</h2>
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
                <div class="Delivery-content">
                    <div class="row mb-3">
                        <div class="col-md-12 mb-2 d-flex justify-content-end">
                            <button class="btn btn-warning text-white width-100" data-toggle="modal" data-target="#admin_info">{{trans('admin.categories.add')}}</button>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive scroll-ele height-300 card-box-shadow border-radius-10">
                                <table class="table table-borderless codiano-datatable table-middle table-hover text-center table-font font-size-14 m-0">
                                    <thead class="main-bg text-white">
                                    <tr>
                                        <th>{{trans('dashboard.beverages.id')}}</th>
                                        <th>{{trans('dashboard.beverages.branch_name')}}</th>
                                        <th>{{trans('dashboard.cashers.email')}} </th>
                                        <th>{{trans('dashboard.beverages.username')}}</th>
                                        <th>{{trans('admin.portfolio.image')}}</th>
                                        <th>{{trans('dashboard.beverages.role')}}</th>
                                        <th>{{trans('dashboard.beverages.status')}}</th>
                                        <th>{{trans('admin.phone')}}</th>
                                        <th>{{trans('dashboard.beverages.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($Deliveries as $Delivery)
                                        <tr class="border-bottom">

                                            <td class="width-50">
                                                <div>{{$Delivery->id}}</div>
                                            </td>
                                            <td class="width-100">
                                                <div>{{$Delivery->branch->name}}</div>
                                            </td>
                                            <td class="width-100">
                                                <div>{{$Delivery->user->email}}</div>
                                            </td>
                                            <td class="width-100">
                                                <div>{{$Delivery->user->name}}</div>
                                            </td>
                                            <td class="width-100">
                                                <div>
                                                    <img src="{{asset('/public/uploads/User/'.$Delivery->user->image)}}" width="23" alt="">
                                                </div>
                                            </td>
                                            <td class="width-100">
                                                <div>Delivery</div>
                                            </td>
                                            <td class="width-100">
                                                <button class="btn btn-success btn-sm width-100">Active</button>
                                            </td>
                                            <td class="width-100">
                                                <div>{{$Delivery->user->mobile}}</div>
                                            </td>
                                            <td class="width-100">
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <div class="mr-2 cursor-pointer">
                                                        <a href=""><img src="{{asset('resources/views/dashboard/assets/images/view.svg')}}" alt=""></a>
                                                    </div>
                                                    <div class="mr-2 cursor-pointer">
                                                        <img src="{{asset('resources/views/dashboard/assets/images/edit.svg')}}" alt="" data-toggle="modal" data-target="#Admin_edit{{$Delivery->id}}">
                                                    </div>
                                                    <div class="cursor-pointer">
                                                        <img src="{{asset('resources/views/dashboard/assets/images/delete.svg')}}" alt="" data-toggle="modal" data-target="#delete{{$Delivery->user->id}}">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
            <!-- Start Footer -->
        @yield('footer')
        <!-- End Footer -->
        </div>
    </div>
</main>


<!-- add delivery  -->
<div class="modal fade" id="admin_info" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <h4 class="py-3 px-2"> {{trans('dashboard.admin.admin_info')}} </h4>
            <div class="modal-body">
                <form action="{{url('api/create/branch-staff')}}"  class="add_Admin" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">{{trans('dashboard.admin.admin_name')}}*</label>
                            <input type="text" class="form-control radius" placeholder="name" name="name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">{{trans('dashboard.cashers.email')}}*</label>
                            <input type="email" name="email" class="form-control radius" placeholder="{{trans('dashboard.cashers.email')}}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">{{trans('dashboard.beverages.branch')}}*</label>
                            <select class="form-control radius" placeholder="branch_id" name="branch_id" required>
                                @foreach($Branches as $Branch)
                                    <option value="{{$Branch->id}}">{{$Branch->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">{{trans('dashboard.beverages.type')}}*</label>
                            <select name="type" class="form-control radius">
                                <option value="4">Delivery</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">{{trans('admin.password')}}*</label>
                            <input type="password" name="password" class="form-control radius" value="" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">{{trans('admin.password_confirmation')}}*</label>
                            <input type="password" name="password_confirmation" class="form-control radius" value="" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">{{trans('admin.phone')}}*</label>
                            <input type="number" name="mobile" class="form-control radius">
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="">{{trans('admin.portfolio.image')}}*</label>
                                <input name="image" type="file" id="photo"  accept="image/*" onchange="loadFile(event)" class="form-control upload-image" aria-describedby="emailHelp" required />
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

@foreach($Deliveries as $Delivery)

    <!-- edit Delivery  -->
    <div class="modal fade" id="Admin_edit{{$Delivery->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <h4 class="py-3 px-2"> {{trans('dashboard.admin.admin_info')}} </h4>
                <div class="modal-body">
                    <form action="{{url('api/edit/branch-staff/'. $Delivery->id)}}"  class="add_Admin" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="">{{trans('dashboard.cashers.casher_name')}}*</label>
                                <input type="text" name="name" class="form-control radius" placeholder="name" value="{{$Delivery->user->name}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">{{trans('admin.categories.email')}}*</label>
                                <input type="email" name="email" class="form-control radius" placeholder="{{trans('admin.categories.email')}}" value="{{$Delivery->user->email}}" >
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">{{trans('dashboard.beverages.branch')}}*</label>
                                <select class="form-control radius" placeholder="branch_id" name="branch_id" required>
                                    @foreach($Branches as $Branch)
                                        <option value="{{$Branch->id}}">{{$Branch->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">{{trans('dashboard.beverages.type')}}*</label>
                                <select type="" name="type" class="form-control radius">
                                    <option value="4">Delivery</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">{{trans('admin.phone')}}*</label>
                                <input type="number" name="mobile" class="form-control radius" value="{{$Delivery->user->mobile}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">{{trans('admin.portfolio.address')}}</label>
                                <input type="text" name="address" class="form-control radius" value="{{$Delivery->user->address}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">{{trans('admin.password')}}*</label>
                                <input type="password" name="password" class="form-control radius" value="">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="d-block">{{trans('admin.portfolio.image')}}</label>
                                <img src="{{asset('/public/uploads/User/'.$Delivery->user->image)}}" width="100" alt="">
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="">{{trans('admin.portfolio.image')}}*</label>
                                    <input name="image" type="file" id="photo"  accept="image/*" onchange="loadFile(event)" class="form-control upload-image" />
                                </div>
                            </div>
                        </div>
                        <div id="message">
                            <div class="spinner-border text-danger d-none" role="status">
                                <span class="sr-only">Loading...</span>
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
    <div class="modal fade" id="delete{{$Delivery->user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{url('api/delete/branch-staff/'.$Delivery->id)}}" class="delete">
                    <div class="modal-body">
                        <h6 class="text-dark"> {{trans('admin.categories.delete_p4')}} {{$Delivery->user->name}}</h6>
                    </div>
                    <div class="modal-footer d-flex justify-content-between align-items-center">
                        <button type="button" class="btn btn-secondary border-0 bg-transparent text-danger" data-dismiss="modal">{{trans('admin.categories.close')}}</button>
                        <button type="submit" class="btn btn-danger radius text-white">{{trans('admin.categories.delete')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

@yield('script')
</body>
</html>
