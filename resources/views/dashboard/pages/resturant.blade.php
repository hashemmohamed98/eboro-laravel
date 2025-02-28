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
                    <h2 class="main-color font-bold">{{trans('dashboard.branch.rest_branch')}}</h2>
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
{{--                        <div class="col-md-12 d-flex justify-content-end">--}}
{{--                            <button class="btn btn-warning text-white width-100" data-toggle="modal" data-target="#Branch">{{trans('admin.categories.add')}}</button>--}}
{{--                        </div>--}}
                        <div class="col-md-12 mt-2 ">
                            <div class="table-responsive scroll-ele height-300 card-box-shadow border-radius-10">
                                <table class="table table-borderless codiano-datatable table-middle table-hover text-center table-font font-size-14 m-0">
                                    <thead class="main-bg text-white">
                                    <tr>
                                        <th>{{trans('dashboard.beverages.id')}}</th>
                                        <th>{{trans('dashboard.beverages.name')}}</th>
                                        <th>{{trans('admin.portfolio.address')}}</th>
                                        <th>{{trans('dashboard.beverages.location_map')}}</th>
                                        <th>{{trans('dashboard.beverages.open_times')}}</th>
                                        <th>{{trans('dashboard.beverages.open_days')}}</th>
                                        <th>{{trans('dashboard.beverages.branch_status')}}</th>
                                        <th>{{trans('admin.phone')}}</th>
                                        <th>{{trans('dashboard.beverages.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($Branches as $Branch)
                                        <tr class="border-bottom">
                                            <td class="width-50">
                                                <div>{{$Branch->id}}</div>
                                            </td>
                                            <td class="width-100">
                                                <div>{{$Branch->name}}</div>
                                            </td>
                                            <td class="width-100">
                                                <div>{{$Branch->address}}</div>
                                            </td>
                                            <td class="width-100">
                                                <a href="https://maps.google.com/?q={{$Branch->lat}},{{$Branch->long}}">
                                                    <img src="{{asset('resources/views/dashboard/assets/images/branchlocation.svg')}}" alt="">
                                                </a>
                                            </td>
                                            <td class="width-100">
                                                <div>{{$Branch->open_time}}</div>
                                                <div>{{$Branch->close_time}}</div>
                                            </td>
                                            <td class="width-100">
                                                <div>
                                                    @foreach(explode(',', $Branch->open_days) as $key)
                                                        {{trans('admin.'.$key)}}
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td class="width-100">
                                                <button class="btn btn-success btn-sm width-100">
                                                    {{$Branch->status == 0 ? trans('admin.open'):trans('admin.close')}}
                                                </button>
                                            </td>
                                            <td class="width-100">
                                                <div>{{$Branch->hot_line}}</div>
                                            </td>
                                            <td class="width-100">
                                                <div class="d-flex align-items-center justify-content-center">

                                                    <div class="mr-2 cursor-pointer">
                                                        <img src="{{asset('resources/views/dashboard/assets/images/edit.svg')}}" alt="" data-toggle="modal" data-target="#editBranch{{$Branch->id}}">
                                                    </div>
{{--                                                    <div class="cursor-pointer">--}}
{{--                                                        <img src="{{asset('resources/views/dashboard/assets/images/delete.svg')}}" alt="" data-toggle="modal" data-target="#delete{{$Branch->id}}">--}}
{{--                                                    </div>--}}
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

<!-- add branch  -->
<div class="modal fade" id="Branch" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <h4 class="py-3 px-2"> {{trans('dashboard.branch.add_branch')}}</h4>
            <div class="modal-body">
                <form action="{{url('api/create/branch')}}" class="add-branch" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">{{trans('admin.name')}}*</label>
                            <input type="text" name="name" class="form-control radius" placeholder="{{trans('admin.name')}}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">{{trans('admin.parent')}}</label>
                            <select class="form-control radius" placeholder="parent" name="parent">
                                <option value="">Select {{trans('admin.parent')}}</option>
                                @foreach($Branches as $Branch)
                                    <option value="{{$Branch->id}}">{{$Branch->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">{{trans('dashboard.branch.provider_id')}}*</label>
                            <select name="provider_id" class="form-control radius" required>
                                <option value="{{$Providers->id}}">{{$Providers->id}}</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">{{trans('dashboard.branch.hotline_number')}}*</label>
                            <input type="number" name="hot_line" class="form-control radius" placeholder="Hotloine number" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">{{trans('admin.address')}}*</label>
                            <input type="text" name="address" class="form-control radius" placeholder="address" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">{{trans('admin.address')}} *</label>
                            <select name="status" class="form-control radius" required>
                                <option value="0">Open</option>
                                <option value="1">Closed</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <hr>
                        </div>
                    </div>

                    <div class="Times">
                        <div class="row Times_content">
                            <div class="form-group col-md-3">
                                <label for="">{{trans('dashboard.beverages.open_days')}} *</label>
                                <select name="open_days[]" class="form-control border-radius-5" required>
                                    <option value="">Select Day</option>
                                    <option value="Monday">{{trans('admin.Monday')}}</option>
                                    <option value="Tuesday">{{trans('admin.Tuesday')}}</option>
                                    <option value="Wednesday">{{trans('admin.Wednesday')}}</option>
                                    <option value="Thursday">{{trans('admin.Thursday')}}</option>
                                    <option value="Friday">{{trans('admin.Friday')}}</option>
                                    <option value="Saturday">{{trans('admin.Saturday')}}</option>
                                    <option value="Sunday">{{trans('admin.Sunday')}}</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">{{trans('dashboard.branch.open_time')}} *</label>
                                <div class="input-group">
                                    <input type="time" name="open_time[]" class="form-control border-radius-5" placeholder="4:30" required>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">{{trans('dashboard.branch.close_time')}}*</label>
                                <div class="input-group">
                                    <input type="time" name="close_time[]" class="form-control border-radius-5" placeholder="4:30" required>
                                </div>
                            </div>
                            <div class="form-group col-md-1">
                                <label for="">Plus*</label>
                                <div class="input-group">
                                    <button type="button" class="btn btn-warning plus_time"><i class="fas fa-plus-circle text-white"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <input type="hidden" name="lat" id="lat2">
                        <input type="hidden" name="long" id="lng2">
                        <div class="form-group col-md-12">
                            <input type="text" value="" id="address2" name="address" class="form-control address mb-3">
                            <div id="us2" style="width: 100%; height: 400px;"></div>
                        </div>
                        <div class="form-group col-12">
                            <label for="">{{trans('admin.portfolio.description')}}*</label>
                            <textarea name="description" class="form-control radius" placeholder="{{trans('admin.portfolio.description')}}" cols="30" rows="5"></textarea>
                        </div>
                    </div>
                    <div id="message">
                        <div class="spinner-border text-danger d-none" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    <button type="submit" class="btn dashboard-main-bg px-4 text-white">{{trans('admin.categories.save')}} </button>
                </form>
            </div>
        </div>
    </div>
</div>

@foreach($Branches as $Branch)
    <!-- edit branch  -->
    <div class="modal fade" id="editBranch{{$Branch->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <h4 class="py-3 px-2"> {{trans('dashboard.branch.edit')}} {{$Branch->name}} {{trans('dashboard.branch.info')}} </h4>
                <div class="modal-body">
                    <form action="{{url('api/edit/branch/'. $Branch->id)}}" class="add-branch" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="">{{trans('dashboard.branch.branch_name')}}*</label>
                                <input type="text" value="{{$Branch->name}}" name="name" class="form-control radius">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">{{trans('admin.parent')}}</label>
                                <select class="form-control radius" placeholder="parent" name="parent">
                                    <option value="">Select {{trans('admin.parent')}}</option>
                                    @foreach($Branches as $Branch_new)
                                        @if($Branch_new->name != $Branch->name)
                                            <option value="{{$Branch_new->id}}" @if($Branch->parent == $Branch_new->id) selected @endif>{{$Branch_new->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">{{trans('dashboard.branch.provider_id')}}*</label>
                                <select name="provider_id" class="form-control radius">
                                    <option value="{{$Branch->provider_id}}">{{$Branch->provider_id}}</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">{{trans('dashboard.branch.status')}} *</label>
                                <select name="status" class="form-control radius">
                                    <option value="0">Open</option>
                                    <option value="1">Closed</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">{{trans('dashboard.branch.hotline_number')}}*</label>
                                <input type="number" value="{{$Branch->hot_line}}" name="hot_line" class="form-control radius" placeholder="Hotloine number">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">{{trans('dashboard.branch.status')}}*</label>
                                <input type="text" value="{{$Branch->address}}" name="address" class="form-control radius" placeholder="address">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                            </div>
                        </div>
                        <div class="Times">
                            @for($i =0; $i < count(explode(',', $Branch->open_days));$i++)
                                @php
                                    $open_days_array = explode(',', $Branch->open_days);
                                    $open_time_array = explode(',', $Branch->open_time);
                                    $close_time_array = explode(',', $Branch->close_time);
                                @endphp

                                <div class="row Times_content align-items-end">
                                    <div class="form-group col-md-3">
                                        <label for="">{{trans('dashboard.beverages.open_days')}} *</label>
                                        <select name="open_days[]" class="form-control border-radius-5" required>
                                            <option value="">Select Day</option>
                                            <option value="Monday" @if($open_days_array[$i] == "Monday") selected @endif>{{trans('admin.Monday')}}</option>
                                            <option value="Tuesday" @if($open_days_array[$i] == "Tuesday") selected @endif>{{trans('admin.Tuesday')}}</option>
                                            <option value="Wednesday" @if($open_days_array[$i] == "Wednesday") selected @endif>{{trans('admin.Wednesday')}}</option>
                                            <option value="Thursday" @if($open_days_array[$i] == "Thursday") selected @endif>{{trans('admin.Thursday')}}</option>
                                            <option value="Friday" @if($open_days_array[$i] == "Friday") selected @endif>{{trans('admin.Friday')}}</option>
                                            <option value="Saturday" @if($open_days_array[$i] == "Saturday") selected @endif>{{trans('admin.Saturday')}}</option>
                                            <option value="Sunday" @if($open_days_array[$i] == "Sunday") selected @endif>{{trans('admin.Sunday')}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="">{{trans('dashboard.branch.open_time')}} *</label>
                                        <div class="input-group">
                                            <input type="time" name="open_time[]" class="form-control border-radius-5" value="{{$open_time_array[$i]}}" placeholder="4:30" required>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="">{{trans('dashboard.branch.close_time')}}*</label>
                                        <div class="input-group">
                                            <input type="time" name="close_time[]" class="form-control border-radius-5" value="{{$close_time_array[$i]}}" placeholder="4:30" required>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-1">
                                        @if($i == 0)
                                            <!-- <label for="">Plus*</label> -->
                                            <div class="input-group">
                                                <button type="button" class="btn btn-warning plus_time"><i class="fas fa-plus-circle text-white"></i></button>
                                            </div>
                                        @else
                                            <!-- <label for=''>Remove*</label> -->
                                            <div class='input-group'>
                                                <button type='button' class='btn btn-danger remove_time'><i class='fas fa-minus-circle text-white'></i></button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endfor
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <input type="hidden" value="{{ $Branch->lat }}" name="lat" id="lat{{$Branch->id}}">
                            <input type="hidden" value="{{ $Branch->long }}" name="long" id="lng{{$Branch->id}}">
                            <div class="form-group col-12">
                                <label for="">{{trans('admin.portfolio.description')}}*</label>
                                <textarea name="description"  class="form-control radius" placeholder="{{trans('admin.portfolio.description')}}" cols="30" rows="5">{{$Branch->description}}</textarea>
                            </div>
                        </div>
                        <div id="message">
                            <div class="spinner-border text-danger d-none" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <button type="submit" class="btn dashboard-main-bg px-4 text-white">{{trans('admin.categories.save')}} </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- delete modal  -->
    <div class="modal fade" id="delete{{$Branch->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{url('api/delete/branch/'.$Branch->id)}}" class="delete">
                    <div class="modal-body">
                        <h6 class="text-dark"> {{trans('admin.categories.delete_p4')}} {{$Branch->name}}</h6>
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
