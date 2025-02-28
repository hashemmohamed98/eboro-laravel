@extends('admin.layouts.master')
@section('title')
{{trans('admin.setting')}}
@endsection
@section('icon')
    fas fa-edit
@endsection
@section('page')
    <div class="page-title-subheading"><a href="{{url('admin')}}" class="text-primary">{{trans('admin.dashboard')}}</a> - <span
            class="text-success">{{trans('admin.edit_setting')}}
        </span></div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">{{trans('admin.user.client')}}</div>
                <div class="table-responsive">
                    <table id="example" class="table table-hover table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>logo</th>
                            <th>android_link</th>
                            <th>iOS_link</th>
                            <th>{{trans('admin.tax')}}</th>
                            <th>{{trans('admin.shipping')}}</th>
                            <th>{{trans('admin.categories.action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>#</td>
                            <td><img src="{{asset('images/'.$setting->logo)}}" width="100" alt=""></td>
                            <td><a href="{{$setting->android_link}}" target="_blank">Android</a></td>
                            <td><a href="{{$setting->iOS_link}}" target="_blank">IOS</a></td>
                            <td>{{$setting->tax}}</td>
                            <td>{{$setting->shipping}}</td>
                            <td><a href="{{asset('admin/setting/edit')}}"><i class="fas fa-edit text-success"></i></a></td>
                        </tr>
                        <tr>
                            <td>Phones</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><a href="{{asset('admin/setting/edit_phones')}}"><i class="fas fa-edit text-success"></i></a></td>
                        </tr>
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

