@extends('admin.layouts.master')
@section('title')
    {{trans('admin.Order')}}
@endsection
@section('icon')
    fas fa-digital-tachograph
@endsection
@section('page')
    <div class="page-title-subheading"><a href="{{url('admin')}}" class="text-primary">{{trans('admin.dashboard')}}</a> - <span
            class="text-success">{{trans('admin.Order')}}
        </span></div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">{{trans('admin.Order')}}
                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                            <button class="btn btn-success" data-toggle="modal"
                                    data-target=".bd-example-modal-lg-add">Filter
                            </button>
                            @push('modal')
                                <div class="modal fade bd-example-modal-lg-add" id="add" tabindex="-1"
                                     role="dialog"
                                     aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form action="{{asset('admin/update_orders')}}"  enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle2">Filter Order</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span> </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-row">
                                                        <div class="form-group sign-input col-12">
                                                            <label for="">Provider*</label>
                                                            <select class="form-control radius" id="filter_name" name="name">
                                                                <option value="">Select Provider</option>
                                                                @foreach($Providers as $Provider)
                                                                    <option value="{{$Provider->id}}">{{$Provider->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group sign-input col-6">
                                                            <label for="">start_at*</label>
                                                            <input class="form-control radius" type="datetime-local" id="filter_start" name="start">
                                                        </div>
                                                        <div class="form-group sign-input col-6">
                                                            <label for="">end_at*</label>
                                                            <input class="form-control radius" type="datetime-local" id="filter_end" name="end">
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
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('admin.close')}}</button>
                                                    <button type="submit" class="btn btn-success">Filter</button>
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
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{trans('dashboard.beverages.name')}}</th>
                            <th>{{trans('dashboard.beverages.branch')}}</th>
                            <th>{{trans('dashboard.delivery.delivery_name')}}</th>
                            <th>{{trans('dashboard.cashers.casher_name')}}</th>
                            <th>{{trans('dashboard.delivery.payment')}}</th>
                            <th>{{trans('admin.price')}}</th>
                            <th>Date</th>
                            <th>{{trans('dashboard.delivery.order_status')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Orders as $Order)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td class="width-100">
                                    <div>{{$Order->user->name}}</div>
                                </td>
                                <td class="width-100">
                                    <div>{{$Order->branch->name??'Eboro'}}</div>
                                </td>
                                <td class="width-100">
                                    <div>{{$Order->delivery->name ?? 'not assign'}}</div>
                                </td>
                                <td class="width-100">
                                    <div>{{$Order->cashier->name ?? 'not assign'}}</div>
                                </td>
                                <td class="width-100">
                                    <div>{{$Order->payment == 0 ? 'Cash':'Online'}}</div>
                                </td>
                                <td class="width-100">
                                    <div>{{$Order->total_price}} €</div>
                                </td>
                                <td class="width-100">
                                    <div>{{$Order->updated_at}}</div>
                                </td>
                                <td class="width-100" data-toggle="modal" data-target="#editstate{{$Order->id}}">
                                    <button class="btn btn-success btn-sm width-100">{{$Order->status}}</button>
                                </td>
                            </tr>
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
