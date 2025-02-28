@extends('admin.layouts.master')
@section('title')
{{trans('admin.product_type')}}
@endsection
@section('icon')
    fas fa-cubes
@endsection
@section('page')
    <div class="page-title-subheading"><a href="{{url('admin')}}" class="text-primary">{{trans('admin.dashboard')}}</a> -
        @if(request()->filled('id'))
            <span
                class="text-success">{{ $types[0]->category->{'name_'.session('lang')} }}
        </span>
        @endif
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">{{trans('admin.product_type')}}
                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                            <button class="btn btn-success" data-toggle="modal"
                                    data-target=".bd-example-modal-lg-add">{{trans('admin.filter')}}
                            </button>
                            @push('modal')
                                <div class="modal fade bd-example-modal-lg-add" id="add" tabindex="-1"
                                     role="dialog"
                                     aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form action="{{url('dashboard/add/type')}}" method="post" class="add_Category" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="row px-2">
                                                        <div class="form-group col-md-12">
                                                            <label for="">{{trans('dashboard.beverages.category')}}*</label>
                                                            <select name="category_id" class="form-control radius" required>
                                                                <option value="">{{trans('admin.categories.select_category')}}</option>
                                                                @foreach($Categories as $Category)
                                                                    <option value="{{$Category->id}}">{{$Category->name_en}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row px-2">
                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('admin.categories.english_type')}}*</label>
                                                            <input type="text" name="type_en" class="form-control radius"  placeholder="{{trans('admin.categories.english_name')}}">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('admin.categories.italy_type')}}*</label>
                                                            <input type="text" name="type_it" class="form-control radius"  placeholder="{{trans('admin.categories.italy_name')}}">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">position *</label>
                                                            <input type="text" class="form-control radius" placeholder="position" name="position" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('admin.close')}}</button>
                                                    <button type="submit" class="btn btn-success">{{trans('admin.filter')}}</button>
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
                            <th>Image</th>
                            <th>{{trans('dashboard.beverages.name')}} IT</th>
                            <th>{{trans('dashboard.beverages.name')}} EN</th>
                            <th>{{trans('dashboard.beverages.category')}} EN</th>
                            <th>updated_at</th>
                            <th>{{trans('dashboard.beverages.action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($types as $type)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td class="width-100">
                                    <img src="{{asset('/public/uploads/Types/'.$type->image)}}" width="50" alt="">
                                </td>
                                <td class="width-100">
                                    <div>{{$type->type_it}}</div>
                                </td>
                                <td class="width-100">
                                    <div>{{$type->type_en}}</div>
                                </td>
                                <td class="width-100">
                                    <div>{{ $type->category->{'name_'.session('lang')} }}</div>
                                </td>
                                <td class="width-100">
                                    <div>{{$type->updated_at}}</div>
                                    <div>{{$type->updated_at->diffForHumans()}}</div>
                                </td>
                                <td>
                                    <i class="fas fa-edit text-warning px-2" data-toggle="modal" data-target="#edit{{$type->id}}"></i>
                                    <i class="fas fa-trash text-danger px-2" data-toggle="modal" data-target="#delete{{$type->id}}"></i>
                                </td>
                            </tr>
                            @push('modal')
                                <div class="modal fade" id="edit{{$type->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <h4 class="py-3 px-2"> Order Information (Edition)</h4>
                                            <form action="{{url('dashboard/edit/type/'. $type->id)}}" method="post" class="add_Category" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="row px-2">
                                                        <div class="form-group col-md-12">
                                                            <label for="">{{trans('dashboard.beverages.category')}}*</label>
                                                            <select name="category_id" class="form-control radius" required>
                                                                <option value="">Select Category</option>
                                                                @foreach($Categories as $Category)
                                                                    <option value="{{$Category->id}}" @if($type->category_id == $Category->id) selected @endif>{{$Category->name_en}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row px-2">
                                                        <div class="form-group col-md-6">
                                                            <label for="">English Type*</label>
                                                            <input type="text" name="type_en" class="form-control radius"  placeholder="English Name" value="{{$type->type_en}}">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Italy Type*</label>
                                                            <input type="text" name="type_it" class="form-control radius"  placeholder="Italy Name" value="{{$type->type_it}}">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">position *</label>
                                                            <input type="text" class="form-control radius" placeholder="position" value="{{$type->position??0}}" name="position" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="">{{trans('admin.portfolio.image')}}*</label>
                                                                <input name="image" type="file"  accept="image/*" onchange="loadFile(event)" class="form-control upload-image" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 ">
                                                            <label for="" class="d-block">{{trans('admin.portfolio.image')}}</label>
                                                            <img src="{{asset('/public/uploads/Types/'.$type->image)}}" width="100" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="btn text-left px-2">
                                                        <button type="submit" class="btn btn-warning radius px-4 text-white ">save</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="delete{{$type->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <form action="{{url('dashboard/delete/type/'.$type->id)}}"  method="post" class="add_Category" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <h6 class="text-dark"> {{trans('admin.categories.delete_p4')}}  {{$type->id}}</h6>
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
