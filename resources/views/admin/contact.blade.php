@extends('admin.layouts.master')
@section('title')
{{trans('admin.categories.contact_us')}}
@endsection
@section('icon')
    fas fa-envelope
@endsection
@section('page')
    <div class="page-title-subheading"><a href="{{url('admin')}}" class="text-primary">{{trans('admin.dashboard')}}</a>
        - <span
            class="text-success">{{trans('admin.categories.contact_us')}}
        </span></div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">{{trans('admin.categories.contact_us')}}
                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
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
                            <th>{{trans('admin.categories.subject')}}</th>
                            <th>{{trans('admin.categories.file')}}</th>
                            <th>{{trans('admin.categories.message')}}</th>
                            <th>{{trans('admin.action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($contact as $item)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->subject }}</td>
                                <td><img src="{{url('public/uploads/Contact/'.$item->file)}}" width="50" height="45">
                                </td>
                                <td>{{ \Illuminate\Support\Str::limit($item->message,50) }}</td>
                                <td>
                                    <a href="{{url('admin/change-contact-status/'.$item->id)}}"><i
                                            class="fas {{$item->state=='open'?'fa-lock':'fa-unlock'}} text-info px-2"></i></a>
                                    <i class="fas {{$item->re_message?'fa-eye':'fa-reply'}} text-warning px-2"
                                       data-toggle="modal" data-target="#Admin_edit{{$item->id}}"></i>
                                    <i class="fas fa-trash text-danger px-2" data-toggle="modal"
                                       data-target="#delete{{$item->id}}"></i>
                                </td>
                            </tr>
                            @push('modal')
                                <div class="modal fade" id="Admin_edit{{$item->id}}" tabindex="-1"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <h4 class="py-3 px-2"> {{trans('admin.categories.message')}} </h4>
                                            <div class="modal-body">
                                                <form action="{{url('admin/reply-contact/'. $item->id)}}"
                                                      class="add_Category" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('admin.categories.name')}}</label>
                                                            <input type="text" name="name_en"
                                                                   class="form-control radius"
                                                                   placeholder="English Name"
                                                                   value="{{$item->name}}" disabled="disabled">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('admin.categories.email')}}</label>
                                                            <input type="text" name="name_it"
                                                                   class="form-control radius" placeholder="Italy Name"
                                                                   value="{{$item->email}}" disabled="disabled">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('admin.categories.phone')}}</label>
                                                            <input type="text" name="name_it"
                                                                   class="form-control radius" placeholder="Italy Name"
                                                                   value="{{$item->phone}}" disabled="disabled">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('admin.categories.subject')}}</label>
                                                            <input type="text" name="name_it"
                                                                   class="form-control radius" placeholder="Italy Name"
                                                                   value="{{$item->subject}}" disabled="disabled">
                                                        </div>
                                                            <div class="col-md-12 ">
                                                                <label for=""
                                                                       class="d-block">{{trans('api.image')}}</label>
                                                                <img
                                                                    src="{{asset('/public/uploads/Contact/'.$item->file)}}"
                                                                    width="100" alt="">
                                                            </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="">{{trans('admin.categories.message')}}</label>
                                                            <textarea disabled="disabled" class="form-control radius">{!! $item->message !!}</textarea>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="">{{trans('admin.categories.reply')}}</label>
                                                            <textarea name="re_message" class="form-control radius" required placeholder="Your Reply...">{!! $item->re_message !!}</textarea>
                                                        </div>
                                                        <div id="message">
                                                            <div class="spinner-border text-danger d-none"
                                                                 role="status">
                                                                <span class="sr-only">Loading...</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <button type="submit" class="btn btn-warning px-4 text-white">{{trans('admin.categories.reply')}}</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- delete modal  -->
                                <div class="modal fade" id="delete{{$item->id}}" tabindex="-1"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <form action="{{url('admin/delete/contact/'. $item->id)}}"
                                                  class="delete">
                                                <div class="modal-body">
                                                    <h6 class="text-dark">{{trans('admin.categories.notice')}}</h6>
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

