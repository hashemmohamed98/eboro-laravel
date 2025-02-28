@extends('admin.layouts.master')
@section('title')
{{trans('admin.report')}}
@endsection
@section('icon')
    fas fa-file-export
@endsection
@section('page')
    <div class="page-title-subheading"><a href="{{url('admin')}}" class="text-primary">Dashboard</a> - <span
            class="text-success">{{trans('admin.report')}}</span></div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">{{trans('admin.report')}}
                </div>
                <div class="card-body table-responsive">
                    <table id="example"  class="table table-hover codiano-datatable table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{trans('admin.categories.name')}}</th>
                            <th>{{trans('admin.categories.weekly')}}</th>
                            <th>{{trans('admin.categories.monthly')}}</th>
                            <th>{{trans('admin.categories.yearly')}}</th>
                            <th>{{trans('admin.categories.total')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Branches as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$Order->where('updated_at', '>=', new DateTime('-1 weeks'))->where('branch_id',$item->id)->sum('total_price')}} €</td>
                                <td>{{$Order->where('updated_at', '>=', new DateTime('-1 months'))->where('branch_id',$item->id)->sum('total_price')}} €</td>
                                <td>{{$Order->where('updated_at', '>=', new DateTime('-1 years'))->where('branch_id',$item->id)->sum('total_price')}} €</td>
                                <td>{{$Order->where('branch_id',$item->id)->sum('total_price')}} €</td>
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

