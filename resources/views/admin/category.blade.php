@extends('admin.layouts.master')
@section('title')
{{trans('admin.categories.categories')}}
@endsection
@section('icon')
    fas fa-suitcase
@endsection
@section('page')
    <div class="page-title-subheading"><a href="{{url('admin')}}" class="text-primary">{{trans('admin.dashboard')}}</a> - <span
            class="text-success">{{trans('admin.categories.categories')}}
        </span></div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">{{trans('admin.categories.categories')}}
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
                                            <form action="{{url('api/create/category')}}" class="add_Category" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle2">{{trans('admin.add_categories')}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">  <span aria-hidden="true">×</span> </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('admin.name_en')}}*</label>
                                                            <input type="text" name="name_en" class="form-control radius" placeholder="{{trans('admin.name_en')}}">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('admin.name_it')}}*</label>
                                                            <input type="text" name="name_it" class="form-control radius" placeholder="{{trans('admin.name_en')}}">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label for="">{{trans('admin.portfolio.image')}}*</label>
                                                                <input name="image" type="file"  accept="image/*" onchange="loadFile(event)" class="form-control upload-image" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <div id="message_add">
                                                                    <div class="spinner-border text-danger d-none" role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> {{trans('admin.close')}} </button>
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
                <div class="card-body">
                    <table id="example" class="table table-hover codiano-datatable table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{trans('admin.name_en')}}</th>
                            <th>{{trans('admin.name_it')}}</th>
                            <th>{{trans('admin.categories.action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Categories as $Category)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $Category->name_en }}</td>
                                <td>{{ $Category->name_it }}</td>
                                <td>
                                    <a class="fas fa-cubes text-primary px-2" href="{{asset('/admin/type?id='.$Category->id)}}"></a>
                                    <i class="fas fa-edit text-warning px-2" data-toggle="modal" data-target="#Admin_edit{{$Category->id}}"></i>
                                    <i class="fas fa-trash text-danger px-2" data-toggle="modal" data-target="#delete{{$Category->id}}"></i>
                                </td>
                            </tr>
                            @push('modal')
                                <div class="modal fade" id="Admin_edit{{$Category->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <h4 class="py-3 px-2"> {{trans('admin.users')}} </h4>
                                            <div class="modal-body">
                                                <form action="{{url('api/edit/category/'. $Category->id)}}"  class="add_Category" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('admin.name_en')}}*</label>
                                                            <input type="text" name="name_en" class="form-control radius" placeholder="{{trans('admin.name_en')}}" value="{{$Category->name_en}}">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('admin.name_it')}}*</label>
                                                            <input type="text" name="name_it" class="form-control radius" placeholder="{{trans('admin.name_it')}}" value="{{$Category->name_it}}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="">{{trans('admin.portfolio.image')}}*</label>
                                                                <input name="image" type="file"  accept="image/*" onchange="loadFile(event)" class="form-control upload-image" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 ">
                                                            <label for="" class="d-block">{{trans('admin.portfolio.image')}}</label>
                                                            <img src="{{asset('/public/uploads/Category/'.$Category->image)}}" width="100" alt="">
                                                        </div>

                                                    </div>
                                                    <div id="message">
                                                        <div class="spinner-border text-danger d-none" role="status">
                                                            <span class="sr-only">Loading...</span>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-warning px-4 text-white">{{trans('admin.categories.save')}}</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- delete modal  -->
                                <div class="modal fade" id="delete{{$Category->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <form action="{{url('api/delete/category/'. $Category->id)}}" class="delete">
                                                <div class="modal-body">
                                                    <h6 class="text-dark"> {{trans('admin.categories.delete_p4')}}  {{$Category->name_en}}</h6>
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

