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
                    <h2 class="main-color font-bold"> {{trans('admin.product_type')}}</h2>
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
                <div class="casher-content">
                    <div class="row mb-3">
                        <div class="col-md-12 mb-2 d-flex justify-content-end">
                            <button class="btn btn-warning text-white width-100" data-toggle="modal" data-target="#Cashier_info">{{trans('admin.categories.add')}}</button>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive scroll-ele height-300 card-box-shadow border-radius-10">
                                <table class="table table-borderless codiano-datatable table-middle table-hover text-center table-font font-size-14 m-0">
                                    <thead class="main-bg text-white">
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>{{trans('dashboard.beverages.name')}} IT</th>
                                        <th>{{trans('dashboard.beverages.name')}} EN</th>
                                        <th>updated_at</th>
                                        <th>{{trans('dashboard.beverages.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($inner_types as $type)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td class="width-100">
                                                <img src="{{asset('/public/uploads/Types/'.$type->image)}}" width="50" alt="">
                                            </td>
                                            <td class="width-100">
                                                <div>{{$type->type_it}}</div>
                                            </td>
                                            <td class="width-100">
                                                <div>{{$type->type_en}}</div>
                                            </td>

                                            <td class="width-100">
                                                <div>{{$type->updated_at}}</div>
                                            </td>

                                            <td>
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <div class="mr-2 cursor-pointer">
                                                        <img src="{{asset('resources/views/dashboard/assets/images/edit.svg')}}" alt="" data-toggle="modal" data-target="#edit{{$type->id}}">
                                                    </div>
                                                    <div class="cursor-pointer">
                                                        <img src="{{asset('resources/views/dashboard/assets/images/delete.svg')}}" alt="" data-toggle="modal" data-target="#delete{{$type->id}}">
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

<!-- add Cashier  -->
<div class="modal fade" id="Cashier_info" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <h4 class="py-3 px-2"> {{trans('dashboard.cashers.casher_info')}} </h4>
            <div class="modal-body">
                <form action="{{url('dashboard/add/inner_types')}}" method="post" class="add_Category" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="provider_id"  value="{{$Providers->id}}">
                        <div class="row px-2">
                            <div class="form-group col-md-6">
                                <label for="">{{trans('admin.categories.english_type')}}*</label>
                                <input type="text" name="type_en" class="form-control radius"  placeholder="{{trans('admin.categories.english_name')}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">{{trans('admin.categories.italy_type')}}*</label>
                                <input type="text" name="type_it" class="form-control radius"  placeholder="{{trans('admin.categories.italy_name')}}">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('admin.close')}}</button>
                        <button type="submit" class="btn btn-success">{{trans('admin.filter')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@foreach($inner_types as $type)

    <!-- edit Cashier  -->
    <div class="modal fade" id="edit{{$type->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <h4 class="py-3 px-2"> {{trans('dashboard.cashers.casher_info')}} </h4>
                <div class="modal-body">
                    <form action="{{url('dashboard/edit/inner_types/'. $type->id)}}" method="post" class="add_Category" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">

                            <div class="row px-2">
                                <div class="form-group col-md-6">
                                    <label for="">English Type*</label>
                                    <input type="text" name="type_en" class="form-control radius"  placeholder="English Name" value="{{$type->type_en}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Italy Type*</label>
                                    <input type="text" name="type_it" class="form-control radius"  placeholder="Italy Name" value="{{$type->type_it}}">
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="">{{trans('admin.portfolio.image')}}*</label>
                                        <input name="image" type="file"  accept="image/*" onchange="loadFile(event)" class="form-control upload-image" />
                                    </div>
                                </div>
                                <div class="col-md-6 ">
                                    <label for="" class="d-block">{{trans('admin.portfolio.image')}}</label>
                                    <img src="{{asset('/public/uploads/Types/'.$type->image)}}" width="100" alt="">
                                </div>
                            </div>
                            <div class="btn text-left px-2">
                                <button type="submit" class="btn btn-warning radius px-4 text-white ">save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- delete modal  -->

    <div class="modal fade" id="delete{{$type->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{url('dashboard/delete/inner_types/'.$type->id)}}"  method="post" class="add_Category" enctype="multipart/form-data">
                    <div class="modal-body">
                        <h6 class="text-dark"> {{trans('admin.categories.delete_p4')}}  {{$type->id}}</h6>
                    </div>
                    <div class="modal-footer d-flex justify-content-between align-items-center">
                        <button type="button" class="btn btn-secondary border-0 bg-transparent text-danger" data-dismiss="modal">{{trans('admin.categories.close')}} </button>
                        <button type="submit" class="btn btn-danger radius text-white">{{trans('admin.categories.delete')}} </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endforeach


@yield('script')
</body>
</html>
