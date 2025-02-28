@extends('admin.layouts.master')
@section('title')
{{trans('admin.home')}}
@endsection
@section('icon')
    fas fa-home
@endsection
@section('page')
    <div class="page-title-subheading"><a href="Home" class="text-primary">{{trans('admin.dashboard')}}</a> - <span
            class="text-success">{{trans('admin.home')}}
        </span></div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">{{trans('admin.home')}}
                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                            <button class="btn btn-success" data-toggle="modal"
                                    data-target=".bd-example-modal-lg-add">{{trans('admin.categories.add')}}
                            </button>
                            @push('modal')
                                <div class="modal fade bd-example-modal-lg-add" id="add" tabindex="-1"
                                     role="dialog"
                                     aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form action="{{url('api/register')}}" class="add_Category" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle2">Add User</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span> </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-row">
                                                        <div class="form-group sign-input col-6">
                                                            <input type="text" name="name" class="form-control placeholder-gray"
                                                                   placeholder="{{trans('public.signup.name')}}">
                                                        </div>
                                                        <div class="form-group sign-input  col-6">
                                                            <input type="email" name="email" class="form-control placeholder-gray"
                                                                   placeholder="{{trans('public.signup.email')}}">
                                                        </div>
                                                        <div class="form-group sign-input  col-6">
                                                            <input type="number" name="mobile" class="form-control placeholder-gray"
                                                                   placeholder="{{trans('public.signup.mobile')}}">
                                                        </div>
                                                        <div class="form-group sign-input  col-6">
                                                            <select name="type" class="form-control radius">
                                                                @foreach(\App\Helper\UsersType::AllTypes as $key => $type)
                                                                    <option value="{{$key}}" >{{$type}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group sign-input  col-12">
                                                            <input type="text" name="address" class="form-control placeholder-gray"
                                                                   placeholder="{{trans('public.signup.address')}}">
                                                        </div>
                                                        <div class="form-group sign-input  col-6">
                                                            <input type="password" name="password" class="form-control placeholder-gray"
                                                                   placeholder="{{trans('public.signup.password')}}">
                                                        </div>
                                                        <div class="form-group sign-input  col-6">
                                                            <input type="password" name="password_confirmation" class="form-control placeholder-gray"
                                                                   placeholder="{{trans('public.signup.confirm_password')}}">
                                                        </div>
                                                        <div class="form-group sign-input  col-12">
                                                            <input type="file" name="image" onchange="loadFile(event)" accept="image/*" class="form-control placeholder-gray upload-image">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div id="message">
                                                                <div class="spinner-border text-danger d-none" role="status">
                                                                    <span class="sr-only">Loading...</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('admin.close')}}
                                                    </button>
                                                    <button type="submit" class="btn btn-success">{{trans('admin.categories.save')}}</button>
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
                    <table id="example" class="table table-hover codiano-datatable table-striped table-bordered"
                           style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{trans('admin.categories.name')}}</th>
                            <th>{{trans('admin.categories.email')}}</th>
                            <th>{{trans('admin.categories.phone')}}</th>
                            <th>{{trans('admin.categories.location')}}</th>
                            <th>{{trans('dashboard.beverages.branch')}}</th>
                            <th>Created at</th>
                            <th>Role</th>
                            <th>{{trans('admin.categories.action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users->reverse() as $user)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{!! $user->active == 0 ? "<strong> [Delete] </strong>" : "" !!} {{ $user->name }} </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->mobile }}</td>
                                <td>{{ $user->address }}</td>
                                <td>{{ $user->Branch->branch->name ?? 'undefined' }}</td>
                                <td>
                                    {{ $user->created_at->format('d M, Y H:m') }}

                                </td>
                                <td>{{ \App\Helper\UsersType::AllTypes[$user->type] }}</td>
                                <td>
                                    @if($user->active==\App\Helper\UsersStatus::Active)
                                        <a class="btn btn-xs btn-warning d-block text-white"
                                           href="{{url('admin/status-user/'.$user->id)}}">{{trans('admin.not_active')}}</a>
                                    @else
                                        <a class="btn btn-xs btn-success d-block text-white"
                                           href="{{url('admin/status-user/'.$user->id)}}">{{trans('admin.active')}}</a>
                                    @endif
                                    <i class="fas fa-edit text-warning px-2" data-toggle="modal"
                                       data-target="#Admin_edit{{$user->id}}"></i>
                                        @if($user->active == 1)
                                            <i class="fas fa-trash text-danger px-2" data-toggle="modal"
                                               data-target="#delete{{$user->id}}"></i>
                                        @endif
                                </td>
                            </tr>
                            @push('modal')
                                <div class="modal fade" id="Admin_edit{{$user->id}}" tabindex="-1"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <h4 class="py-3 px-2"> {{trans('admin.users')}}</h4>
                                            <div class="modal-body">
                                                <form action="{{url('api/edit-user/'. $user->id)}}" class="add_Admin"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('admin.name')}}*</label>
                                                            <input type="text" name="name" class="form-control radius"
                                                                   placeholder="{{trans('admin.name')}}" value="{{$user->name}}">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('admin.categories.email')}}*</label>
                                                            <input type="email" name="email" class="form-control radius"
                                                                   placeholder="{{trans('admin.categories.email')}}"
                                                                   value="{{$user->email}}">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('dashboard.beverages.branch')}}
                                                                *</label>
                                                            <select class="form-control radius" placeholder="branch_id"
                                                                    name="branch_id">
                                                                <option value="">{{trans('dashboard.select_branch')}}</option>
                                                                @foreach($Branches as $Branch)
                                                                    <option value="{{$Branch->id}}"
                                                                            @if($user->Branch && $Branch->id == $user->Branch->branch_id) selected @endif>{{$Branch->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Delete / Active *</label>
                                                            <select class="form-control radius" placeholder="active"
                                                                    name="active">
                                                                <option @if($user->active == 1) selected @endif value="1">Active</option>
                                                                <option @if($user->active == 0) selected @endif value="0">Delete</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('dashboard.beverages.type')}}*</label>
                                                            <select name="type" class="form-control radius">
                                                                @foreach(\App\Helper\UsersType::AllTypes as $key => $type)
                                                                    <option value="{{$key}}"
                                                                            @if($key == $user->type) selected @endif>{{$type}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('admin.phone')}}*</label>
                                                            <input type="number" name="mobile"
                                                                   class="form-control radius"
                                                                   value="{{$user->mobile}}">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('admin.password')}}*</label>
                                                            <input type="password" name="password"
                                                                   class="form-control radius" value="">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for=""
                                                                   class="d-block">{{trans('admin.portfolio.image')}}</label>
                                                            <img src="{{asset('/public/uploads/User/'.$user->image)}}"
                                                                 width="100" alt="">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="">{{trans('admin.portfolio.image')}}
                                                                    *</label>
                                                                <input name="image" type="file" accept="image/*"
                                                                       onchange="loadFile(event)"
                                                                       class="form-control upload-image"/>
                                                            </div>
                                                        </div>
                                                        @if($user->type==\App\Helper\UsersType::Delivery)
                                                            <div class="form-group col-md-6">
                                                                <label for="">{{trans('admin.city')}}</label>
                                                                <input type="text" name="city"
                                                                       class="form-control radius"
                                                                       value="{{$user->city}}">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="">{{trans('admin.country')}}*</label>
                                                                <input type="text" name="country"
                                                                       class="form-control radius" value="{{$user->country}}">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="">{{trans('admin.postal_code')}}*</label>
                                                                <input type="text" name="postal_code"
                                                                       class="form-control radius" value="{{$user->postal_code}}">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="">{{trans('admin.portfolio.address')}}</label>
                                                                <input type="text" name="address"
                                                                       class="form-control radius"
                                                                       value="{{$user->address}}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for=""
                                                                       class="d-block">{{trans('admin.front_id_image')}}</label>
                                                                <img src="{{asset('/public/uploads/Delivery/'.$user->front_id_image)}}"
                                                                     width="100" alt="">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="">{{trans('admin.front_id_image')}}
                                                                        *</label>
                                                                    <input name="front_id_image" type="file" accept="image/*"
                                                                           onchange="loadFile(event)"
                                                                           class="form-control upload-image"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for=""
                                                                       class="d-block">{{trans('admin.back_id_image')}}</label>
                                                                <img src="{{asset('/public/uploads/Delivery/'.$user->back_id_image)}}"
                                                                     width="100" alt="">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="">{{trans('admin.back_id_image')}}
                                                                        *</label>
                                                                    <input name="back_id_image" type="file" accept="image/*"
                                                                           onchange="loadFile(event)"
                                                                           class="form-control upload-image"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for=""
                                                                       class="d-block">{{trans('admin.license_image')}}</label>
                                                                <img src="{{asset('/public/uploads/Delivery/'.$user->license_image)}}"
                                                                     width="100" alt="">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="">{{trans('admin.license_image')}}
                                                                        *</label>
                                                                    <input name="license_image" type="file" accept="image/*"
                                                                           onchange="loadFile(event)"
                                                                           class="form-control upload-image"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for=""
                                                                       class="d-block">{{trans('admin.license_expire')}}</label>
                                                                <img src="{{asset('/public/uploads/Delivery/'.$user->license_expire)}}"
                                                                     width="100" alt="">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="">{{trans('admin.license_expire')}}
                                                                        *</label>
                                                                    <input name="license_expire" type="file" accept="image/*"
                                                                           onchange="loadFile(event)"
                                                                           class="form-control upload-image"/>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div id="message">
                                                        <div class="spinner-border text-danger d-none" role="status">
                                                            <span class="sr-only">Loading...</span>
                                                        </div>
                                                    </div>
                                                    <button type="submit"
                                                            class="btn btn-warning px-4 text-white">{{trans('admin.categories.save')}}</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- delete modal  -->
                                <div class="modal fade" id="delete{{$user->id}}" tabindex="-1"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <form action="{{url('api/delete-user/'. $user->id)}}" class="delete">
                                                <div class="modal-body">
                                                    <h6 class="text-dark"> {{trans('admin.categories.delete_p4')}}  {{$user->name}}</h6>
                                                </div>
                                                <div
                                                    class="modal-footer d-flex justify-content-between align-items-center">
                                                    <button type="button"
                                                            class="btn btn-secondary border-0 bg-transparent text-danger"
                                                            data-dismiss="modal">{{trans('admin.categories.close')}} </button>
                                                    <button type="submit"
                                                            class="btn btn-danger radius text-white">{{trans('admin.categories.delete')}} </button>
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

