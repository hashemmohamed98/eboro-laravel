@extends('admin.layouts.master')

@section('title')
    provider
@endsection
@section('icon')
    fas fa-credit-card
@endsection
@section('page')
    <div class="page-title-subheading"><a href="{{url('admin')}}" class="text-primary">{{trans('admin.dashboard')}}</a> - <span
            class="text-success">Branches
        </span></div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">{{$Branches[0]->provider->name??""}}
                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                            <button class="btn btn-success" data-toggle="modal"
                                    data-target=".bd-example-modal-lg-add">{{trans('admin.categories.add')}}
                            </button>
                            @push('modal')
                                <div class="modal fade bd-example-modal-lg-add" id="add" tabindex="-1"
                                     role="dialog"
                                     aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <form action="{{url('api/create/branch')}}" class="add_Category" enctype="multipart/form-data">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle2">Add {{trans('admin.Provider')}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">  <span aria-hidden="true">×</span> </button>
                                                </div>
                                                <div class="modal-body">
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
                                                                <option value="{{$Providers->id}}">{{$Providers->name}}</option>
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
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('admin.close')}}
                                                        </button>
                                                        <button type="submit" class="btn btn-success">{{trans('admin.categories.save')}}</button>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endpush

                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="example" class="table table-hover codiano-datatable table-striped table-bordered" style="width:100%">
                        <thead class="main-bg ">
                        <tr>
                            <th>{{trans('dashboard.beverages.id')}}</th>
                            <th>{{trans('dashboard.beverages.name')}}</th>
                            <th>{{trans('admin.portfolio.address')}}</th>
                            <th>{{trans('dashboard.beverages.location_map')}}</th>
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
                                    <div>
                                        @foreach(array_unique(explode(',', $Branch->open_days)) as $info)
                                            {{ $info }}</br>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="width-100">
                                    <button class="btn btn-success btn-sm width-100">
                                        {{$Branch->status == 0 ? "open":"close"}}
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
                                        <div class="cursor-pointer">
                                            <img src="{{asset('resources/views/dashboard/assets/images/delete.svg')}}" alt="" data-toggle="modal" data-target="#delete{{$Branch->id}}">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @push('modal')
                                <div class="modal fade" id="editBranch{{$Branch->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <h4 class="py-3 px-2"> {{trans('dashboard.branch.edit')}} {{$Branch->name}} {{trans('dashboard.branch.info')}} </h4>
                                            <div class="modal-body">
                                                <form action="{{url('api/edit/branch/'. $Branch->id)}}" class="add_Category" enctype="multipart/form-data">
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
                                                                <option value="{{$Branch->provider_id}}">{{$Branch->provider->name??""}}</option>
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

                                                            <div class="row Times_content">
                                                                <div class="form-group col-md-3">
                                                                    <label for="">{{trans('dashboard.beverages.open_days')}} *</label>
                                                                    <select name="open_days[]" class="form-control border-radius-5" required>
                                                                        <option value="">Select Day</option>
                                                                        <option value="Monday" @if($open_days_array[$i] == "Monday") selected @endif>
                                                                            {{trans('admin.Monday')}}</option>
                                                                        <option value="Tuesday" @if($open_days_array[$i] == "Tuesday") selected @endif>
                                                                            {{trans('admin.Tuesday')}}</option>
                                                                        <option value="Wednesday" @if($open_days_array[$i] == "Wednesday") selected @endif>
                                                                            {{trans('admin.Wednesday')}}</option>
                                                                        <option value="Thursday" @if($open_days_array[$i] == "Thursday") selected @endif>
                                                                            {{trans('admin.Thursday')}}</option>
                                                                        <option value="Friday" @if($open_days_array[$i] == "Friday") selected @endif>
                                                                            {{trans('admin.Friday')}}</option>
                                                                        <option value="Saturday" @if($open_days_array[$i] == "Saturday") selected @endif>
                                                                            {{trans('admin.Saturday')}}</option>
                                                                        <option value="Sunday" @if($open_days_array[$i] == "Sunday") selected @endif>
                                                                            {{trans('admin.Sunday')}}</option>
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
                                                                        <label for="">Plus*</label>
                                                                        <div class="input-group">
                                                                            <button type="button" class="btn btn-warning plus_time"><i class="fas fa-plus-circle text-white"></i></button>
                                                                        </div>
                                                                    @else
                                                                        <label for=''>Remove*</label>
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
                                                        <div class="form-group col-md-12">
                                                            <input type="text" value="" id="address-{{$Branch->id}}" name="address" class="form-control address mb-3">
                                                            <div id="us_{{$Branch->id}}" style="width: 100%; height: 400px;"></div>
                                                        </div>
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
                                                    <button type="submit" class="btn btn-warning px-4 text-white">{{trans('admin.categories.save')}} </button>
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
                            @endpush
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-block text-center card-footer">
                    <span>Codiano Dashboard</span>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('inner_script')
    @foreach($Branches as $Branch)

        <script>
            $('#us_{{$Branch->id}}').locationpicker({
                location: {
                    latitude: '{{ $Branch->lat??45.491606226544 }}',
                    longitude: '{{ $Branch->long??9.191102575671376 }}',
                },
                inputBinding: {
                    latitudeInput: $('#lat{{$Branch->id}}'),
                    longitudeInput: $('#lng{{$Branch->id}}'),
                    locationNameInput: $('#address-{{$Branch->id}}')
                },
                setCurrentPosition: true,
                enableAutocomplete: true,
                radius: 300,
                markerIcon: '{{ url('public/map-marker-2-xl.png')}}',

            });
        </script>
    @endforeach
@endsection
