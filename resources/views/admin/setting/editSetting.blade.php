@extends('admin.layouts.master')
@section('title')
    Edit Setting
@endsection
@section('icon')
    fas fa-edit
@endsection
@section('page')
    <div class="page-title-subheading"><a href="Home" class="text-primary">{{trans('admin.dashboard')}}</a> - <span
            class="text-success">Edit Setting
        </span></div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">
                    <h3>Edit Setting</h3>
                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                            <a href="{{url('admin/change-system-status/'.$setting->id)}}">
                                <i title="lock" class="fas {{$setting->state=='close'?'fa-lock text-danger':'fa-unlock text-info'}} fa-2x  px-3"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{url('admin/edit_setting/'.$setting->id)}}" enctype="multipart/form-data">
                        @csrf
                        <h4>Main Setting</h4>
                        <!-- Main Setting -->
                        <div class="form-row">
                            <div class="col-md-6 mb-3 upload-img">
                                <label>Android link</label>
                                <div class="input-group">
                                    <input name="android_link" type="text" class="form-control" value="{{$setting->android_link}}" />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 upload-img">
                                <label>IOS link</label>
                                <div class="input-group">
                                    <input name="iOS_link" type="text" class="form-control" value="{{$setting->iOS_link}}" />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 upload-img">
                                <label>Delivery Range (Km)</label>
                                <div class="input-group">
                                    <input name="range" type="number" class="form-control" value="{{$setting->range}}" />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 upload-img">
                                <label>avg prepare (mins)</label>
                                <div class="input-group">
                                    <input name="avg_prepare" type="number" class="form-control" value="{{$setting->avg_prepare}}" />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 upload-img">
                                <label>Tax</label>
                                <div class="input-group">
                                    <input name="tax" type="text" class="form-control" value="{{$setting->tax}}" />
                                </div>
                            </div>

                            <div class="col-md-6 mb-3 upload-img">
                                <label>Delivery delay time / Min</label>
                                <div class="input-group">
                                    <input name="Dli_time" type="text" class="form-control" value="{{$setting->Dli_time}}" />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 upload-img">
                                <label>Rider start cost</label>
                                <div class="input-group">
                                    <input name="de_start" type="text" class="form-control" value="{{$setting->de_start}}" />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 upload-img">
                                <label>Rider cost/km</label>
                                <div class="input-group">
                                    <input name="de_per_km" type="text" class="form-control" value="{{$setting->de_per_km}}" />
                                </div>
                            </div>
                            <div class="col-md-4 mb-3 upload-img">
                                <label>Shipping(For first 2 Kilos): kilo/euro</label>
                                <div class="input-group">
                                    <input name="shipping" type="text" class="form-control" value="{{$setting->shipping}}" />
                                </div>
                            </div>
                            <div class="col-md-4 mb-3 upload-img">
                                <label>Shipping(After the first 2 kilos): kilo/euro</label>
                                <div class="input-group">
                                    <input name="shipping2" type="text" class="form-control" value="{{$setting->shipping2}}" />
                                </div>
                            </div>
                            <div class="col-md-4 mb-3 upload-img">
                                <label>Shipping (the lowest price for total shipping): kilo/euro</label>
                                <div class="input-group">
                                    <input name="min_shipping" type="text" class="form-control" value="{{$setting->min_shipping}}" />
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12 mb-3 upload-img">
                                <label>Best in Month [Products]</label>
                                <div class="input-group">
                                    <select class="form-control select-two" multiple name="product_array[]">
                                        @foreach(explode(',', str_replace(['"','[',']',' '], '', $setting->product_array)) as $items)
                                            @if(isset($Products->where('id',$items)->first()->id))
                                                <option value="{{$Products->where('id',$items)->first()->id}}" selected>{{$Products->where('id',$items)->first()->name}}</option>
                                            @endif
                                        @endforeach
                                        @foreach($Products as $items)
                                            @if(!in_array($items->id, explode(',', str_replace(['"','[',']',' '], '', $setting->product_array))))
                                                <option value="{{$items->id}}">{{$items->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 upload-img">
                                <label>Best in Month [Seller]</label>
                                <div class="input-group">
                                    <select class="form-control select-two" multiple name="providers_array[]">
                                        @foreach(explode(',', str_replace(['"','[',']',' '], '', $setting->providers_array)) as $items)
                                            @if(isset($Providers->where('id',$items)->first()->id))
                                                <option value="{{$Providers->where('id',$items)->first()->id}}" selected>{{$Providers->where('id',$items)->first()->name}}</option>
                                            @endif
                                        @endforeach
                                        @foreach($Providers as $items)
                                            @if(!in_array($items->id, explode(',', str_replace(['"','[',']',' '], '', $setting->providers_array))))
                                                <option value="{{$items->id}}">{{$items->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 upload-img">
                                <label>Offers [Products]</label>
                                <div class="input-group">
                                    <select class="form-control select-two" multiple name="product_offer_array[]">
                                        @foreach(explode(',', str_replace(['"','[',']',' '], '', $setting->product_offer_array)) as $items)
                                            @if(isset($Products->where('id',$items)->first()->id))
                                                <option value="{{$Products->where('id',$items)->first()->id}}" selected>{{$Products->where('id',$items)->first()->name}}</option>
                                            @endif
                                        @endforeach
                                        @foreach($Products as $items)
                                            @if(!in_array($items->id, explode(',', str_replace(['"','[',']',' '], '', $setting->product_offer_array))))
                                                <option value="{{$items->id}}">{{$items->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3 upload-img">
                                <label>Facebook</label>
                                <div class="input-group">
                                    <input name="facebook" type="text" class="form-control" value="{{$setting->facebook}}" />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 upload-img">
                                <label>twitter</label>
                                <div class="input-group">
                                    <input name="twitter" type="text" class="form-control" value="{{$setting->twitter}}" />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 upload-img">
                                <label>linkedin</label>
                                <div class="input-group">
                                    <input name="linkedin" type="text" class="form-control" value="{{$setting->linkedin}}" />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 upload-img">
                                <label>youtube</label>
                                <div class="input-group">
                                    <input name="youtube" type="text" class="form-control" value="{{$setting->youtube}}" />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 upload-img">
                                <label>phone</label>
                                <div class="input-group">
                                    <input name="phone" type="text" class="form-control" value="{{$setting->phone}}" />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 upload-img">
                                <label>Email</label>
                                <div class="input-group">
                                    <input name="email" type="text" class="form-control" value="{{$setting->email}}" />
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6 mb-3 upload-img">
                                <label>Logo</label>
                                <div class="input-group">
                                    <input name="logo" type="file" accept="image/*" onchange="loadFile(event)" class="form-control upload-image" />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Feature Image (Value)</label>
                                <div class="d-flex align-items-center justify-content-center form-control" style="height: 124px;">
                                    @if($setting->logo!=null)
                                        <img width="150" height="100"
                                             src="{{url('public/uploads/setting/'.$setting->logo)}}">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3 upload-img">
                                <label>Header Image</label>
                                <div class="input-group">
                                    <input name="slider_image" type="file" accept="image/*" onchange="loadFile(event)" class="form-control upload-image" />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Header Image (Value)</label>
                                <div class="d-flex align-items-center justify-content-center form-control" style="height: 124px;">
                                    @if($setting->slider_image!=null)
                                        <img width="150" height="100"
                                             src="{{url('public/uploads/setting/'.$setting->slider_image)}}">
                                    @endif
                                </div>
                            </div>
                        </div>

                        <h4>Pages Setting</h4>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="py-1 px-2 bg-success text-white">
                                             <i class="fa fa-file-word mr-2"></i>
                                             About Us [En]
                                        </span>
                                    </div>
                                    <textarea class="tinymce-editor"
                                              name="about_en">{!! $setting->about_en !!}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="py-1 px-2 bg-success text-white">
                                             <i class="fa fa-file-word mr-2"></i>
                                             About Us [IT]
                                        </span>
                                    </div>
                                    <textarea class="tinymce-editor"
                                              name="about_it">{!! $setting->about_it !!}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="py-1 px-2 bg-success text-white">
                                             <i class="fa fa-file-word mr-2"></i>
                                             Privacy [En]
                                        </span>
                                    </div>
                                    <textarea class="tinymce-editor"
                                              name="privacy_en">{!! $setting->privacy_en !!}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="py-1 px-2 bg-success text-white">
                                             <i class="fa fa-file-word mr-2"></i>
                                             Privacy [IT]
                                        </span>
                                    </div>
                                    <textarea class="tinymce-editor"
                                              name="privacy_it">{!! $setting->privacy_it !!}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="py-1 px-2 bg-success text-white">
                                             <i class="fa fa-file-word mr-2"></i>
                                             contact emails [1]
                                        </span>
                                    </div>
                                    <textarea class="tinymce-editor"
                                              name="contact_email_1">{!! $setting->contact_email_1 !!}</textarea>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="py-1 px-2 bg-success text-white">
                                             <i class="fa fa-file-word mr-2"></i>
                                             contact emails [2]
                                        </span>
                                    </div>
                                    <textarea class="tinymce-editor"
                                              name="contact_email_2">{!! $setting->contact_email_2 !!}</textarea>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="py-1 px-2 bg-success text-white">
                                             <i class="fa fa-file-word mr-2"></i>
                                             contact emails [3]
                                        </span>
                                    </div>
                                    <textarea class="tinymce-editor"
                                              name="contact_email_3">{!! $setting->contact_email_3 !!}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="py-1 px-2 bg-success text-white">
                                             <i class="fa fa-file-word mr-2"></i>
                                             State Message [en]
                                        </span>
                                    </div>
                                    <textarea class="tinymce-editor"
                                              name="state_message_en">{!! $setting->state_message_en !!}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="py-1 px-2 bg-success text-white">
                                             <i class="fa fa-file-word mr-2"></i>
                                             State Message [it]
                                        </span>
                                    </div>
                                    <textarea class="tinymce-editor"
                                              name="state_message_it">{!! $setting->state_message_it !!}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="py-1 px-2 bg-success text-white">
                                             <i class="fa fa-file-word mr-2"></i>
                                             Description [en]
                                        </span>
                                    </div>
                                    <textarea class="form-control"
                                              name="description_en">{!! $setting->description_en !!}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="py-1 px-2 bg-success text-white">
                                             <i class="fa fa-file-word mr-2"></i>
                                             Description [it]
                                        </span>
                                    </div>
                                    <textarea class="form-control"
                                              name="description_it">{!! $setting->description_it !!}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12 mb-3 upload-img">
                                <label>Contact map</label>
                                <div class="input-group">
                                    <input name="contact_map" type="text" class="form-control" value="{{$setting->contact_map}}" />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="text-center">
                                <button class="btn btn-success"style="width:200px;font-size: 16px;">Edit</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
