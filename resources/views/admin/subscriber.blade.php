@extends('admin.layouts.master')
@section('title')
{{trans('admin.categories.subscribers')}}
@endsection
@section('icon')
    fas fa-subscript
@endsection
@section('page')
    <div class="page-title-subheading"><a href="{{url('admin')}}" class="text-primary">{{trans('admin.dashboard')}}</a> - <span
            class="text-success">{{trans('admin.categories.subscribers')}}
        </span></div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">{{trans('admin.categories.subscribers')}}</div>
                <div class="table-responsive">
                    <table id="example" class="table table-hover table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{trans('admin.categories.email')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subscriber as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->email}}</td>
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

