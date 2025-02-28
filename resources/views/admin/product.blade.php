@extends('admin.layouts.master')
@section('title')
{{trans('admin.product')}}
@endsection
@section('icon')
    fas fa-cookie-bite
@endsection
@section('page')
    <div class="page-title-subheading"><a href="{{url('admin')}}" class="text-primary">{{trans('admin.dashboard')}}</a> - <span
            class="text-success">{{trans('admin.product')}}
        </span></div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">{{trans('admin.product')}}</div>
                <div class="table-responsive">
                    <table id="example" class="table table-hover codiano-datatable table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{trans('dashboard.beverages.name')}}</th>
                            <th>{{trans('dashboard.beverages.branch')}}</th>
                            <th>{{trans('dashboard.beverages.price')}}</th>
                            <th>{{trans('dashboard.beverages.type')}}</th>
                            <th>Position</th>
{{--                            <th>{{trans('admin.additions')}}</th>--}}
{{--                            <th>{{trans('admin.calories')}}</th>--}}
                            <th>{{trans('admin.size')}}</th>
                            <th>{{trans('admin.product_type')}}</th>
                            <th>{{trans('admin.has_alcohol')}}</th>
                            <th>{{trans('admin.has_pig')}}</th>
                            <th>{{trans('admin.has_outofstock')}}</th>
                            <th>{{trans('dashboard.beverages.action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Products as $Product)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td class="width-50">
                                    <div>{{$Product->name}}</div>
                                </td>
                                <td class="width-50">
                                    <div>{{$Product->branch->name ?? 'undefined'}}</div>
                                </td>
                                <td class="width-100">
                                    <div>{{$Product->price}} €</div>
                                </td>
                                <td class="width-100">
                                    <div>{{$Product->type}}</div>
                                </td>
                                <td class="width-100">
                                    <div>{{$Product->position}}</div>
                                </td>
<!--                                <td class="width-100">
                                    <div>{{$Product->additions}}</div>
                                </td>
                                <td class="width-100">
                                    <div>{{$Product->calories}}</div>
                                </td>-->
                                <td class="width-100">
                                    <div>{{$Product->size}}</div>
                                </td>
                                <td class="width-100">
                                    <div>{{$Product->product_type}}</div>
                                </td>
                                <td class="width-100">
                                    <div>{{$Product->has_alcohol == 1 ? "Yes" : "NO"}}</div>
                                </td>
                                <td class="width-100">
                                    <div>{{$Product->has_pig == 1 ? "Yes" : "NO"}}</div>
                                </td>
                                <td class="width-100">
                                    <div>{{$Product->has_outofstock == 1 ? "Yes" : "NO"}}</div>
                                </td>
                                <td>
                                    @if($Product->product_type != "Sauce")
                                        <a href="{{asset('product-details/'.$Product->id.'/'.$Product->name)}}"> <i class="fas fa-eye text-primary px-2" ></i></a>
                                    @endif
                                    <i class="fas fa-edit text-warning px-2" data-toggle="modal" data-target="#edit{{$Product->id}}"></i>
                                    <i class="fas fa-trash text-danger px-2" data-toggle="modal" data-target="#delete{{$Product->id}}"></i>
                                </td>
                            </tr>
                            @push('modal')
                                <div class="modal fade" id="edit{{$Product->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <h4 class="py-3 px-2"> {{trans('dashboard.beverages.add_product')}} {{$Product->name}}</h4>
                                            <div class="modal-body">
                                                <form action="{{url('api/edit/branch-product/'.$Product->id)}}" class="Add-Product" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('dashboard.beverages.category')}}*</label>
                                                            <select name="product_type" class="form-control radius" required>
                                                                <option value="Food">Prouduct</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('dashboard.beverages.branch')}}</label>
                                                            <select class="form-control radius" placeholder="branch_id" name="branch_id" required>
                                                                @foreach($Branches as $Branch)
                                                                    <option value="{{$Branch->id}}">{{$Branch->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="">{{trans('dashboard.beverages.product_type')}}*</label>
                                                            <select name="product_type" class="form-control radius" required>
                                                                <option value="{{$Product->product_type}}">{{$Product->product_type}}</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('dashboard.beverages.product_name')}}*</label>
                                                            <input type="text" class="form-control radius" placeholder="{{trans('dashboard.beverages.product_name')}}" value="{{$Product->name}}" name="name" required>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('dashboard.beverages.price')}}*</label>
                                                            <input type="text" class="form-control radius" placeholder="{{trans('dashboard.beverages.price')}}" value="{{$Product->price}}" name="price" required>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">position *</label>
                                                            <input type="text" class="form-control radius" placeholder="position" value="{{$Product->position??0}}" name="position" required>
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('dashboard.beverages.type')}}*</label>
                                                            <select class="form-control radius" placeholder="type" name="type" required>
                                                                @foreach($types as $type)
                                                                    @if($type->provider_id == $Product->branch->provider_id)
                                                                        <option value="{{$type->id}}" @if($type->id == $Product->type) selected @endif>{{ $type->{'type_'.session('lang')} }}</option>

                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('dashboard.beverages.size')}}*</label>
                                                            <input type="text" class="form-control radius" placeholder="{{trans('dashboard.beverages.size')}}" value="{{$Product->size}}" name="size" required>
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('dashboard.beverages.calories')}}*</label>
                                                            <input type="text" class="form-control radius" placeholder="{{trans('dashboard.beverages.calories')}}" value="{{$Product->calories}}" name="calories" >
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('dashboard.beverages.addition')}}*</label>
                                                            <input type="text" class="form-control radius" placeholder="{{trans('dashboard.beverages.addition')}}" value="{{$Product->additions}}" name="additions" >
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="">{{trans('admin.portfolio.image')}}*</label>
                                                                <input type="file" id="" name="image"  accept="image/*" onchange="loadFile(event)" class="form-control upload-image" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="">{{trans('admin.portfolio.image')}}*</label>
                                                            <div class="input-group-append">
                                                                <img src="{{asset('/public/uploads/Product/'.$Product->image())}}" class="d-block mx-auto" width="100" height="80" style="object-fit:cover" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="has_pig" id="defaultCheck1" @if($Product->has_pig == 1) checked @endif>
                                                                    <label class="form-check-label" for="defaultCheck1">
                                                                        {{trans('dashboard.beverages.lard')}}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="has_alcohol" id="defaultCheck2" @if($Product->has_alcohol == 1) checked @endif>
                                                                    <label class="form-check-label" for="defaultCheck2">
                                                                        {{trans('dashboard.beverages.alcohol')}}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <div class="form-check">
                                                                    <input class="form-check-input out_of_stock" type="checkbox" @if($Product->has_outofstock == 1) checked @endif id="out_of_stock-{{$Product->id}}">
                                                                    <label class="form-check-label" for="out_of_stock-{{$Product->id}}">
                                                                        {{trans('admin.has_outofstock')}}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="w-100 has_outofstock_box" @if($Product->has_outofstock != 1) style="display: none; @endif">
                                                            <div class="col-md-12">
                                                                <div class="form-group row">
                                                                    <label for="example-datetime-local-input" class="col-2 col-form-label">{{trans('admin.start_outofstock')}}</label>
                                                                    <div class="col-10">
                                                                        <input class="form-control start_outofstock_input" type="hidden"  value="{{Carbon\Carbon::parse($Product->start_outofstock)->format('Y-m-d')."T".Carbon\Carbon::parse($Product->start_outofstock)->format('H:i')}}"  name="start_outofstock" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group row">
                                                                    <label for="example-datetime-local-input" class="col-2 col-form-label">{{trans('admin.end_outofstock')}}</label>
                                                                    <div class="col-10">
                                                                        <input class="form-control end_outofstock_input" type="hidden" min="{{Carbon\Carbon::now()->format('Y-m-d')."T".Carbon\Carbon::now()->format('H:i')}}" value="{{Carbon\Carbon::parse($Product->end_outofstock)->format('Y-m-d')."T".Carbon\Carbon::parse($Product->end_outofstock)->format('H:i')}}" name="end_outofstock">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="col-md-12">
                                                            <div class="form-group row">
                                                                <label for="example-datetime-local-input" class="col-2 col-form-label">{{trans('admin.offer_value')}}</label>
                                                                <div class="col-10">
                                                                    <input type="number" class="form-control radius" placeholder="{{trans('admin.offer_value')}}" max="100" value="{{$Product->offer->value??''}}" name="value" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group row">
                                                                <label for="example-datetime-local-input" class="col-2 col-form-label">{{trans('admin.offer_start')}}</label>
                                                                <div class="col-10">
                                                                    <input class="form-control radius" type="datetime-local"
                                                                           value="{{Carbon\Carbon::parse($Product->offer->start_at??'')->format('Y-m-d')."T".Carbon\Carbon::parse($Product->offer->start_at??'')->format('H:i')}}"  name="start_at">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group row">
                                                                <label for="example-datetime-local-input" class="col-2 col-form-label">{{trans('admin.offer_end')}}</label>
                                                                <div class="col-10">
                                                                    <input class="form-control radius" type="datetime-local" min="{{Carbon\Carbon::now()->format('Y-m-d')."T".Carbon\Carbon::now()->format('H:i')}}"
                                                                           value="{{Carbon\Carbon::parse($Product->offer->end_at??'')->format('Y-m-d')."T".Carbon\Carbon::parse($Product->offer->end_at??'')->format('H:i')}}" name="end_at">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <label for="">{{trans('admin.portfolio.description')}}*</label>
                                                            <textarea name="description" class="form-control radius" placeholder="{{trans('admin.portfolio.description')}}" cols="30" rows="5">{{$Product->description}}</textarea>
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
                                <div class="modal fade" id="delete{{$Product->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <form action="{{url('api/delete/branch-product/'. $Product->id)}}" class="delete">
                                                <div class="modal-body">
                                                    <h6 class="text-dark"> {{trans('admin.categories.delete_p4')}}  {{$Product->name}}</h6>
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
