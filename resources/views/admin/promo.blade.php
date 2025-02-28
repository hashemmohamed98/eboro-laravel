@extends('admin.layouts.master')
@section('title')
    Promo
@endsection
@section('icon')
    fas fa-percent
@endsection
@section('page')
    <div class="page-title-subheading"><a href="{{url('admin')}}" class="text-primary">Dashboard</a> - <span
            class="text-success">{{trans('admin.promo')}}</span></div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">{{trans('admin.promo')}}
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
                                            <form action="{{url('api/create/promo')}}" class="add_Category" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle2">Add Promo</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span> </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-12">
                                                            <label for="">{{trans('admin.promos.user_id')}}</label>
                                                            <select name="user_id" class="form-control radius">
                                                                <option value="">Select User</option>
                                                                @foreach($users as $user)
                                                                    <option value="{{$user->id}}">[{{$user->id}}] - {{$user->name}} E-mail ({{$user->email}}) </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('admin.promos.type')}}*</label>
                                                            <select name="type" class="form-control radius" required>
                                                                <option value="Total">Total</option>
                                                                <option value="Delivery">Delivery</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('admin.promos.current_min_deposit')}}</label>
                                                            <input type="text" class="form-control radius" name="current_min_deposit" placeholder="{{trans('admin.promos.current_min_deposit')}}" >
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('admin.promos.old_min_deposit')}}</label>
                                                            <input type="text" class="form-control radius" name="old_min_deposit" placeholder="{{trans('admin.promos.old_min_deposit')}}" >
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('admin.promos.max_offer')}}*</label>
                                                            <input type="text" class="form-control radius" name="max_offer" placeholder="{{trans('admin.promos.max_offer')}}" required>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('admin.promos.HMUser')}}*</label>
                                                            <input type="number" class="form-control radius" name="HMUser" placeholder="{{trans('admin.promos.HMUser')}}" required>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('admin.promos.HMTime_used')}}*</label>
                                                            <input type="number" class="form-control radius" name="HMTime_used" placeholder="{{trans('admin.promos.HMTime_used')}}" required>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('admin.promos.user_create_at')}}</label>
                                                            <input type="datetime-local" class="form-control radius" name="user_create_at" placeholder="{{trans('admin.promos.user_create_at')}}" >
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('admin.promos.user_create_to')}}</label>
                                                            <input type="datetime-local" class="form-control radius" name="user_create_to" placeholder="{{trans('admin.promos.user_create_to')}}" >
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('admin.promos.start_at')}}*</label>
                                                            <input type="datetime-local" class="form-control radius" name="start_at" placeholder="{{trans('admin.promos.start_at')}}" required>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('admin.promos.end_at')}}*</label>
                                                            <input type="datetime-local" class="form-control radius" name="end_at" placeholder="{{trans('admin.promos.end_at')}}" required>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="d-flex justify-content-center align-items-center register-errors">
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
                <div class="card-body table-responsive">
                    <table id="example"  class="table table-hover codiano-datatable table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{trans('admin.promos.current_min_deposit')}}</th>
                            <th>{{trans('admin.promos.max_offer')}}</th>
                            <th>{{trans('admin.promos.type')}}</th>
                            <th>{{trans('admin.promos.end_at')}}</th>
                            <th>{{trans('admin.promos.HMUser')}}</th>
                            <th>{{trans('admin.promos.HMTime_used')}}</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($PromoCodes as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->current_min_deposit}} € </td>
                                <td>{{$item->max_offer}} € </td>
                                <td>{{$item->type}}</td>
                                <td>{{$item->end_at}}</td>
                                <td>{{$item->HMUser}}</td>
                                <td>{{$item->HMTime_used}}</td>
                                <td>
                                    <i class="fas fa-eye text-primary px-2" data-toggle="modal" data-target="#view{{$item->id}}"></i>
                                    <i class="fas fa-edit text-warning px-2" data-toggle="modal" data-target="#edit{{$item->id}}"></i>
                                    <i class="fas fa-trash text-danger px-2" data-toggle="modal" data-target="#delete{{$item->id}}"></i>
                                </td>
                            </tr>
                            @push('modal')
                                    <div class="modal fade bd-example-modal-lg-edit" id="edit{{$item->id}}" tabindex="-1"
                                         role="dialog"
                                         aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <form action="{{url('api/edit/promo/'. $item->id)}}" class="add_Category" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle2">Edit Promo</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span> </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-row">
                                                            <div class="form-group col-md-12">
                                                                <label for="">{{trans('admin.promos.user_id')}}</label>
                                                                <select name="user_id" class="form-control radius">
                                                                    <option value="">Select User</option>
                                                                    @foreach($users as $user)
                                                                        <option value="{{$user->id}}" @if(isset($item->user_id) && $item->user_id == $user->id) selected @endif>[{{$user->id}}] - {{$user->name}} E-mail ({{$user->email}}) </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="">{{trans('admin.promos.type')}}*</label>
                                                                <select name="type" class="form-control radius" required>
                                                                    <option value="Total" @if(isset($item->type) && $item->type == 'Total') selected @endif>Total</option>
                                                                    <option value="Delivery" @if(isset($item->type) && $item->type == 'Delivery') selected @endif>Delivery</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="">{{trans('admin.promos.current_min_deposit')}}</label>
                                                                <input type="text" class="form-control radius" value="{{$item->current_min_deposit}}" name="current_min_deposit" placeholder="{{trans('admin.promos.current_min_deposit')}}" >
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="">{{trans('admin.promos.old_min_deposit')}}</label>
                                                                <input type="text" class="form-control radius" value="{{$item->old_min_deposit}}" name="old_min_deposit" placeholder="{{trans('admin.promos.old_min_deposit')}}" >
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="">{{trans('admin.promos.max_offer')}}*</label>
                                                                <input type="text" class="form-control radius" value="{{$item->max_offer}}" name="max_offer" placeholder="{{trans('admin.promos.max_offer')}}" required>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="">{{trans('admin.promos.HMUser')}}*</label>
                                                                <input type="number" class="form-control radius" value="{{$item->HMUser}}" name="HMUser" placeholder="{{trans('admin.promos.HMUser')}}" required>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="">{{trans('admin.promos.HMTime_used')}}*</label>
                                                                <input type="number" class="form-control radius"  value="{{$item->HMTime_used}}" name="HMTime_used" placeholder="{{trans('admin.promos.HMTime_used')}}" required>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="">{{trans('admin.promos.user_create_at')}}</label>
                                                                <input type="datetime-local" class="form-control radius" @if(isset($item->user_create_at))value="{{Carbon\Carbon::parse($item->user_create_at)->format('Y-m-d')."T".Carbon\Carbon::parse($item->user_create_at)->format('H:i')}}"@endif name="user_create_at" placeholder="{{trans('admin.promos.user_create_at')}}" >
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="">{{trans('admin.promos.user_create_to')}}</label>
                                                                <input type="datetime-local" class="form-control radius" @if(isset($item->user_create_to))value="{{Carbon\Carbon::parse($item->user_create_to)->format('Y-m-d')."T".Carbon\Carbon::parse($item->user_create_to)->format('H:i')}}"@endif name="user_create_to" placeholder="{{trans('admin.promos.user_create_to')}}" >
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="">{{trans('admin.promos.start_at')}}*</label>
                                                                <input type="datetime-local" class="form-control radius" value="{{Carbon\Carbon::parse($item->start_at)->format('Y-m-d')."T".Carbon\Carbon::parse($item->start_at)->format('H:i')}}" name="start_at" placeholder="{{trans('admin.promos.start_at')}}" required>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="">{{trans('admin.promos.end_at')}}*</label>
                                                                <input type="datetime-local" class="form-control radius" value="{{Carbon\Carbon::parse($item->end_at)->format('Y-m-d')."T".Carbon\Carbon::parse($item->end_at)->format('H:i')}}" name="end_at" placeholder="{{trans('admin.promos.end_at')}}" required>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="d-flex justify-content-center align-items-center register-errors">
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

                                <!-- delete modal  -->
                                <div class="modal fade" id="delete{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <form action="{{url('api/delete/promo/'. $item->id)}}" class="delete">
                                                <div class="modal-body">
                                                    <h6 class="text-dark"> {{trans('admin.categories.delete_p4')}}  {{$item->name}}</h6>
                                                </div>
                                                <div class="modal-footer d-flex justify-content-between align-items-center">
                                                    <button type="button" class="btn btn-secondary border-0 bg-transparent text-danger" data-dismiss="modal">{{trans('admin.categories.close')}} </button>
                                                    <button type="submit" class="btn btn-danger radius text-white">{{trans('admin.categories.delete')}} </button>
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

