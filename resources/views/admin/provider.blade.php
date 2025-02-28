@extends('admin.layouts.master')
@section('title')
{{trans('admin.provider')}}
@endsection
@section('icon')
    fas fa-credit-card
@endsection
@section('page')
    <div class="page-title-subheading"><a href="{{url('admin')}}" class="text-primary">{{trans('admin.dashboard')}}</a> - <span
            class="text-success">{{trans('admin.provider')}}
        </span></div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">{{trans('admin.provider')}}
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
                                            <form action="{{url('api/create/provider')}}" class="add_Category" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle2">{{trans('admin.add_provider')}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">  <span aria-hidden="true">×</span> </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-12">
                                                            <label for="">{{trans('dashboard.beverages.product_name')}}*</label>
                                                            <input type="text" class="form-control radius" placeholder="{{trans('dashboard.beverages.product_name')}}"  name="name" required>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('dashboard.home.prepare')}}</label>
                                                            <select class="form-control radius" name="duration">
                                                                @foreach(\App\Helper\durations::arr as $item)
                                                                    <option value="{{$item}}" >{{$item}} Min</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">VIP*</label>
                                                            <select name="vip" class="form-control radius" required>
                                                                <option value="">{{trans('admin.select_vip')}}</option>
                                                                <option value="1" >VIP</option>
                                                                <option value="0" >{{trans('admin.not_vip')}}</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('admin.lock')}}*</label>
                                                            <select name="lock" class="form-control radius" required>
                                                                <option value="">{{trans('admin.select_lock')}}</option>
                                                                <option value="lock" >{{trans('admin.lock')}}</option>
                                                                <option value="unlock" >{{trans('admin.unlock')}}</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('admin.users')}}*</label>
                                                            <select name="user_id" class="form-control radius" required>
                                                                <option value="">{{trans('admin.select_admin')}}</option>
                                                                @foreach($users as $user)
                                                                    <option value="{{$user->id}}" >{{$user->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('dashboard.beverages.category')}}*</label>
                                                            <select name="category_id" class="form-control radius" required>
                                                                <option value="">{{trans('admin.categories.select_category')}} </option>
                                                                @foreach($Categories as $Category)
                                                                    <option value="{{$Category->id}}" >{{$Category->name_en}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label for="">{{trans('admin.portfolio.image')}}*</label>
                                                                <input name="logo" type="file"  accept="image/*" onchange="loadFile(event)" class="form-control upload-image" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="">{{trans('admin.type')}} *</label>
                                                            <select name="types[]" class="form-control radius select-two" multiple >
                                                                @foreach($types as $type)
                                                                    <option value="{{$type->id}}" >{{$type->{'type_'.session('lang')} }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="">{{trans('admin.type')}} Inner*</label>
                                                            <select name="typeInners[]" class="form-control radius select-two" multiple >
                                                                @foreach($types as $type)
                                                                    <option value="{{$type->id}}" >{{$type->{'type_'.session('lang')} }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="delivery" id="defaultCheck2">
                                                                    <label class="form-check-label" for="defaultCheck2">
                                                                    {{trans('admin.has_delivery')}}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('admin.delivery_range')}}</label>
                                                            <input type="number" min="0" step="1" class="form-control radius" placeholder="{{trans('admin.delivery_range')}} in Km"  name="range_delivery" >
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('admin.delivery_fees')}} / KM</label>
                                                            <input type="number" min="0" step="1"  class="form-control radius" placeholder="{{trans('admin.delivery_fees')}} / Km"  name="delivery_fee" >
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <label for="">{{trans('admin.portfolio.description')}}*</label>
                                                            <textarea name="description" class="form-control radius" placeholder="{{trans('admin.portfolio.description')}}" cols="30" rows="5"></textarea>
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <div id="message">
                                                                <div class="spinner-border text-danger d-none" role="status">
                                                                    <span class="sr-only">Loading...</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('admin.close')}} </button>
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
                <div class="table-responsive">
                    <table id="example" class="table table-hover codiano-datatable table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{trans('dashboard.beverages.name')}}</th>
                            <th>{{trans('admin.categories.user')}}</th>
                            <th>{{trans('admin.categories.categories')}}</th>
                            <th>{{trans('admin.type')}}</th>
                            <th>{{trans('admin.categories.delivery')}}</th>
                            <th>Lock</th>
                            <th>vip</th>
                            <th>{{trans('dashboard.beverages.action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Providers as $Provider)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td class="width-100">
                                    <div>{{$Provider->name}}</div>
                                </td>
                                <td class="width-100">
                                    <div>{{$Provider->user->name}}</div>
                                </td>
                                <td class="width-100">
                                    <div>{{$Provider->category->name_en}}</div>
                                </td>
                                <td class="width-100">
                                    <div>
                                        @foreach($Provider->typed as $it)
                                            {{ $it->type->{'type_'.session('lang')} }}
                                        @endforeach
                                    </div>
                                </td>

                                <td class="width-100">
                                    <div>{{$Provider->vip==1?"VIP":"Not vip"}}</div>
                                </td>
                                <td class="width-50">
                                    <div>{!! $Provider->lock=="unlock"?"<i class='text-success fas fa-circle '></i> Active":" <i class='text-danger fas fa-spinner fa-pulse'></i> locked" !!}</div>
                                </td>
                                <td class="width-100">
                                    <div>{{$Provider->delivery ==0 ? "No":"Yes"}}</div>
                                </td>

                                <td>
                                    <a href="{{asset('admin/provider/branches/'.$Provider->id)}}"><i  class="fas fa-h-square text-primary px-2"></i></a>
                                    <a href="{{asset('/Provider/'.$Provider->id.'/'.$Provider->name)}}"><i  class="fas fa-eye text-primary px-2"></i></a>
                                    <i class="fas fa-edit text-warning px-2" data-toggle="modal" data-target="#edit{{$Provider->id}}"></i>
                                    <i class="fas fa-trash text-danger px-2" data-toggle="modal" data-target="#delete{{$Provider->id}}"></i>
                                </td>
                            </tr>
                            @push('modal')
                                <div class="modal fade" id="edit{{$Provider->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <h4 class="py-3 px-2"> {{trans('admin.provider')}} {{$Provider->name}}</h4>
                                            <div class="modal-body">
                                                <form action="{{url('api/edit/provider/'.$Provider->id)}}" class="add_Category" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <label for="">{{trans('dashboard.beverages.product_name')}}*</label>
                                                            <input type="text" class="form-control radius" placeholder="{{trans('dashboard.beverages.product_name')}}" value="{{$Provider->name}}"  name="name" required>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Position*</label>
                                                            <input type="text" class="form-control radius" placeholder="Position" value="{{$Provider->position}}"  name="position" required>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('admin.users')}}*</label>
                                                            <select name="user_id" class="form-control radius" required>
                                                                <option value="">Select Admin</option>
                                                                @foreach($users as $user)
                                                                    <option value="{{$user->id}}" @if($Provider->user_id == $user->id) selected @endif>{{$user->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Prepare</label>
                                                            <select class="form-control radius" name="duration">
                                                                @foreach(\App\Helper\durations::arr as $item)
                                                                    <option value="{{$item}}" @if($Provider->duration == $item) selected @endif>{{$item}} Min</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('dashboard.beverages.category')}}*</label>
                                                            <select name="category_id" class="form-control radius" required>
                                                                <option value="">Select Category</option>
                                                                @foreach($Categories as $Category)
                                                                    <option value="{{$Category->id}}" @if($Provider->category_id == $Category->id) selected @endif>{{$Category->name_en}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">VIP*</label>
                                                            <select name="vip" class="form-control radius" required>
                                                                <option value="">Select VIP</option>
                                                                <option value="1" @if($Provider->vip == 1) selected @endif>VIP</option>
                                                                <option value="0" @if($Provider->vip == 0) selected @endif>NOT VIP</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">lock*</label>
                                                            <select name="lock" class="form-control radius" required>
                                                                <option value="">Select lock</option>
                                                                <option value="lock" @if($Provider->lock == "lock") selected @endif>Lock</option>
                                                                <option value="unlock" @if($Provider->lock == "unlock") selected @endif>Unlock</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="">Types *</label>
                                                            <select name="types[]" class="form-control radius select-two" multiple required>
                                                                @foreach($types as $type)
                                                                    <option value="{{$type->id}}" @if(count($Provider->typed) > 0  && in_array($type->id,$Provider->typed->pluck('type_id')->toArray())) selected @endif>{{$type->{'type_'.session('lang')} }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="">Types Inner *</label>
                                                            <select name="typeInners[]" class="form-control radius select-two" multiple required>
                                                                @foreach($InnerTypes as $type)
                                                                    @if($type->provider_id == $Provider->id)
                                                                        <option value="{{$type->id}}" @if(count($Provider->typeInner) > 0  && in_array($type->id,$Provider->typeInner->pluck('type_id')->toArray())) selected @endif>{{$type->{'type_'.session('lang')} }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="">{{trans('admin.portfolio.image')}}*</label>
                                                                <input type="file" name="logo"  accept="image/*" onchange="loadFile(event)" class="form-control upload-image" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="">{{trans('admin.portfolio.image')}}*</label>
                                                            <div class="input-group-append">
                                                                <img src="{{asset('/public/uploads/Provider/'.$Provider->logo)}}" class="d-block mx-auto" width="100" height="80" style="object-fit:cover" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="delivery" id="defaultCheck2" @if($Provider->delivery == 1) checked @endif>
                                                                    <label class="form-check-label" for="defaultCheck2">
                                                                        Has delivery
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Delivery Range</label>
                                                            <input type="number" min="0" step="1" class="form-control radius" placeholder="Range in Km" value="{{$Provider->range_delivery}}"  name="range_delivery" >
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Delivery Fees / KM</label>
                                                            <input type="number" min="0" step="1"  class="form-control radius" placeholder="Delivery Fees / Km"  value="{{$Provider->delivery_fee}}" name="delivery_fee" >
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <label for="">{{trans('admin.portfolio.description')}}*</label>
                                                            <textarea name="description" class="form-control radius" placeholder="{{trans('admin.portfolio.description')}}" cols="30" rows="5">{{$Provider->description}}</textarea>
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
                                <div class="modal fade" id="delete{{$Provider->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <form action="{{url('api/delete/provider/'. $Provider->id)}}" class="delete">
                                                <div class="modal-body">
                                                    <h6 class="text-dark"> {{trans('admin.categories.delete_p4')}}  {{$Provider->name}}</h6>
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

