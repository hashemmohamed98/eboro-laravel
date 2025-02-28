@extends('admin.layouts.master')
@section('title')
    {{trans('admin.categories.testimonial')}}
@endsection
@section('icon')
    fas fa-user-alt
@endsection
@section('page')
    <div class="page-title-subheading"><a href="{{url('admin')}}" class="text-primary">Dashboard</a> - <span
            class="text-success">{{trans('admin.categories.testimonial')}}</span></div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">{{trans('admin.categories.testimonial')}}
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
                                            <form action="{{url('admin/create/test')}}" method="post"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle2">{{trans('admin.categories.add_testimonial')}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-row">
                                                        <div class="col-md-12 mb-3">
                                                            <label>{{trans('admin.categories.name')}}</label>
                                                            <div class="input-group">
                                                                <input name="name" type="text" class="form-control"
                                                                       placeholder="Name" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label>{{trans('admin.portfolio.comment')}}</label>

                                                            <div class="input-group">
                                                            <textarea name="comment" rows="3" placeholder="{{trans('admin.portfolio.comment')}}" class="form-control" required></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 mb-3 upload-img">
                                                            <label>{{trans('admin.portfolio.image')}}</label>
                                                            <div class="input-group">
                                                                <input name="image" type="file" accept="image/*" onchange="loadFile(event)" class="form-control upload-image" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">
                                                            {{trans('admin.close')}}
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
                            <th>{{trans('admin.categories.name')}}</th>
                            <th>{{trans('admin.portfolio.image')}}</th>
                            <th>{{trans('admin.portfolio.comment')}}</th>
                            <th>{{trans('admin.categories.action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tests as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->name}}</td>
                                <td><img src="{{url('public/uploads/Testmonial/'.$item->image)}}" width="50"
                                         height="50"></td>
                                <td>{{$item->comment}}</td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target=".editCat{{$item->id}}">
                                        <i class="fa fa-edit p-2 text-success"></i></a>
                                    <a href="#" data-toggle="modal" data-target=".deleteCat{{$item->id}}">
                                        <i class="fa fa-trash p-2 text-danger"></i></a>
                                </td>
                            </tr>
                            @push('modal')
                                <div class="modal fade bd-example-modal-lg-edit editCat{{$item->id}}" tabindex="-1"
                                     role="dialog"
                                     aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form action="{{url('admin/edit/test/'.$item->id)}}" method="post"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle1">{{trans('admin.categories.edit_testimonial')}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-row">
                                                        <div class="col-md-12 mb-3">
                                                            <label>                            <th>{{trans('admin.categories.name')}}</th>
                                                            </label>
                                                            <div class="input-group">
                                                                <input name="name" type="text" class="form-control"
                                                                       placeholder="{{trans('admin.categories.name')}}"
                                                                       value="{{$item->name}}"
                                                                       required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label>{{trans('admin.portfolio.comment')}}</label>
                                                            <div class="input-group">
                                                                <textarea name="comment" rows="3" placeholder="{{trans('admin.categories.comment')}}" class="form-control" required>{{$item->comment}}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-3 upload-img">
                                                            <label>{{trans('admin.portfolio.image')}}</label>
                                                            <div class="input-group">
                                                                <input name="image" type="file" class="form-control dropify_one"
                                                                       placeholder="Image">
                                                            </div>
                                                        </div>
                                                        @if($item->image)
                                                            <div class="col-md-6 mb-3">
                                                                <label>{{trans('admin.portfolio.image')}}</label>
                                                                <div class="d-flex align-items-center justify-content-center form-control" style="height: 124px;">
                                                                    <img
                                                                        src="{{url('public/uploads/Testmonial/'.$item->image)}}"
                                                                        width="150" height="100">
                                                                </div>

                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">
                                                            {{trans('admin.close')}}
                                                    </button>
                                                    <button type="submit" class="btn btn-success">{{trans('admin.categories.save')}}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade bd-example-modal-lg-delete deleteCat{{$item->id}}" tabindex="-1"
                                     role="dialog"
                                     aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form action="{{url('admin/delete/test/'.$item->id)}}" method="post">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">{{trans('admin.categories.delete_testimonial')}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center">
                                                <span
                                                    class="text-danger fa-2x">{{trans('admin.categories.delete_p3')}}</span>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">
                                                            {{trans('admin.close')}}
                                                    </button>
                                                    <button type="submit" class="btn btn-danger ">{{trans('admin.categories.delete')}}</button>
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

