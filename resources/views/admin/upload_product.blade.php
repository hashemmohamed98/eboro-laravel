@extends('admin.layouts.master')
@section('title')
    {{trans('admin.product')}}
@endsection
@section('icon')
    fas fa-cookie-bite
@endsection
@section('page')
    <div class="page-title-subheading"><a href="{{url('admin')}}" class="text-primary">{{trans('admin.dashboard')}}</a>
        - <span
            class="text-success">{{trans('admin.product')}}
        </span></div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">Upload {{trans('admin.product')}}
                    <div class="btn-actions-pane-right">
                        <a class="btn btn-success text-white" title="Plan Sample" onclick="downloadPlan('{{url('admin/download/product')}}','Product.xlsx')">{{trans('admin.download_product_sample')}} </a>
                        <a class="btn btn-success text-white" title="Download All Type " onclick="downloadPlan('{{url('admin/download/type')}}','Type.xlsx')">{{trans('admin.download_all_type')}} </a>
                        <a class="btn btn-success text-white" title="Download All Branches" onclick="downloadPlan('{{url('admin/download/branch')}}','Branch.xlsx')">{{trans('admin.download_all_branches')}}</a>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{url('admin/upload/product')}}" enctype="multipart/form-data"
                          method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3 upload-img">
                                <label for="name">{{trans('admin.file')}} </label>
                                <div class="input-group">
                                    <input name="file" type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"  class="form-control upload-image" />
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="input-group">
                                    <button type="submit" class="btn btn-success ">{{trans('admin.upload_photo')}} </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="d-block text-center card-footer">
                    <span>Codiano Dashboard</span>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function downloadPlan(url,name) {
            $.ajax({
                type: 'get',
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                xhrFields: {
                    responseType: 'blob'
                },
                success: function (data) {
                    var a = document.createElement('a');
                    var url = window.URL.createObjectURL(data);
                    a.href = url;
                    a.download = name;
                    document.body.append(a);
                    a.click();
                    a.remove();
                    window.URL.revokeObjectURL(url);
                },error:function(){
                    alert("error!!!!");
                }
            });
        }
    </script>
@endsection
