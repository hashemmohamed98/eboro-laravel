@extends('admin.layouts.master')
@section('title')
{{trans('admin.Order')}}
@endsection
@section('icon')
    fas fa-digital-tachograph
@endsection
@section('page')
    <div class="page-title-subheading"><a href="{{url('admin')}}" class="text-primary">{{trans('admin.dashboard')}}</a> - <span
            class="text-success">{{trans('admin.Order')}}
        </span></div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">{{trans('admin.Order')}}
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
                                            <form action="{{asset('admin/update_orders')}}"  enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle2">{{trans('admin.filter_order')}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span> </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-row">
                                                        <div class="form-group sign-input col-12">
                                                            <label for="">{{trans('admin.provider')}}*</label>
                                                            <select class="form-control radius" id="filter_name" name="name">
                                                                <option value="">Select Provider</option>
                                                                @foreach($Providers as $Provider)
                                                                    <option value="{{$Provider->id}}">{{$Provider->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group sign-input col-6">
                                                            <label for="">{{trans('admin.start_at')}}*</label>
                                                            <input class="form-control radius" type="datetime-local" id="filter_start" name="start">
                                                        </div>
                                                        <div class="form-group sign-input col-6">
                                                            <label for="">{{trans('admin.end_at')}}*</label>
                                                            <input class="form-control radius" type="datetime-local" id="filter_end" name="end">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="d-flex justify-content-center align-items-center register-errors">
                                                                <div class="spinner-border text-danger d-none" role="status">
                                                                    <span class="sr-only">Loading...</span>
                                                                </div>
                                                            </div>
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
                            <th>{{trans('dashboard.beverages.id')}}</th>
                            <th>{{trans('dashboard.beverages.name')}}</th>
                            <th>{{trans('dashboard.beverages.branch')}}</th>
                            <th>{{trans('admin.portfolio.address')}}</th>
                            <th>{{trans('dashboard.delivery.delivery_name')}}</th>
                            <th>{{trans('dashboard.cashers.casher_name')}}</th>
                            <th>{{trans('dashboard.delivery.payment')}}</th>
                            <th>{{trans('admin.price')}}</th>
                            <th>updated_at</th>
                            <th>ordar_at</th>
                            <th>{{trans('dashboard.delivery.order_status')}}</th>
                            <th>{{trans('dashboard.beverages.action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Orders as $Order)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td class="width-50">
                                    <div>{{$Order->id}}</div>
                                </td>
                                <td class="width-100">
                                    <div>{{$Order->user->id}} - {{$Order->user->name}}</div>
                                    <div>{{$Order->user->mobile}}</div>
                                </td>
                                <td class="width-100">
                                    <div>{{$Order->branch->name??'Eboro'}}</div>
                                </td>
                                <td class="width-100">
                                    <a href="https://maps.google.com/?q={{$Order->drop_lat}},{{$Order->drop_long}}">
                                        <img src="{{asset('resources/views/dashboard/assets/images/branchlocation.svg')}}" alt="">
                                    </a>
                                </td>
                                <td class="width-100">
                                    <div>{{$Order->delivery->name ?? 'not assign'}}</div>
                                </td>
                                <td class="width-100">
                                    <div>{{$Order->cashier->user->name ?? 'not assign'}}</div>
                                </td>
                                <td class="width-100">
                                    <div>{{$Order->payment == 0 ? 'Cash':''}}</div>
                                    <div>{{$Order->payment == 1 ? 'debit card':''}}</div>
                                    <div>{{$Order->payment == 2 ? 'Paypal':''}}</div>
                                </td>
                                <td class="width-100">
                                    <div>{{$Order->total_price}} €</div>
                                </td>
                                <td class="width-100">
                                    <div>{{$Order->updated_at->format('Y-m-d')}}</div>
                                    <div>{{$Order->updated_at->format('h:i A')}}</div>
                                </td>
                                <td class="width-100">
                                    <div>{{$Order->ordar_at->format('Y-m-d')}}</div>
                                    <div>{{$Order->ordar_at->format('h:i A')}}</div>
                                </td>
                                <td class="width-100" data-toggle="modal" data-target="#editstate{{$Order->id}}">
                                    <button class="btn btn-success btn-sm width-100">{{$Order->status}}</button>
                                </td>
                                <td>
                                    <i title="view" class="fas fa-eye text-primary px-2" data-toggle="modal" data-target="#view{{$Order->id}}"></i>
                                    <i title="Client Chat" class="open_chat fas fa-comment-alt @if($Chatonlines->where(["order_id"=>$Order->id,'type'=>'user'])->where("view",'0')->first() == null) text-primary @else text-danger @endif px-2" data-id="{{$Order->id}}" data-toggle="modal" data-target="#chat{{$Order->id}}"></i>
                                    <i title="Delivery Chat" class="open_chat_delivery fas fa-comment-slash @if($Chatonlines->where(["order_id"=>$Order->id,'type'=>'delivery'])->where("view",'0')->first() == null) text-primary @else text-danger @endif px-2" data-id="{{$Order->id}}" data-toggle="modal" data-target="#chat_delivery{{$Order->id}}"></i>
                                    <i title="Edit" class="fas fa-edit text-warning px-2" data-toggle="modal" data-target="#edit{{$Order->id}}"></i>
                                    <i title="Delete" class="fas fa-trash text-danger px-2" data-toggle="modal" data-target="#delete{{$Order->id}}"></i>
                                </td>
                            </tr>
                            @push('modal')
                                <div class="modal fade" id="chat{{$Order->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <h4 class="py-3 px-2"> {{trans('admin.order_chat')}} </h4>
                                            <div class="col-sm-12 col-sm-offset-4 frame chat-{{$Order->id}}">
                                                <ul class="vals_eboro">
                                                    @foreach($Chatonlines as $Chatonline)
                                                        @if($Chatonline->order_id == $Order->id && $Chatonline->type == 'user')
                                                            @if($Chatonline->Order->user_id == $Chatonline->user_id)
                                                                <li style="width:100%"  class="p-2">
                                                                    <div class="bubble text text-l a"> <p>{{$Chatonline->text}}</p><p><small>{{$Chatonline->created_at->diffForHumans()}}</small></p></div>
                                                                </li>
                                                            @else
                                                                <li style="width:100%;" class="p-2">
                                                                    <div class="bubble text text-r "> <p>{{$Chatonline->text}}</p><p><small>{{$Chatonline->created_at->diffForHumans()}}</small></p></div>
                                                                </li>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>

                                            <form action="{{url('api/add/chat')}}" method="post" class="add_chat" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="order_id" value="{{$Order->id}}">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-10">
                                                            <div class="msj-rta macro">
                                                                <div class="text text-r" style="background:whitesmoke !important">
                                                                    <input class="mytext" name="text" placeholder="Type a message"/>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-2">
                                                            <div class="btn text-left px-2">
                                                                <button type="submit" class="btn btn-warning radius px-4 text-white "> {{trans('admin.save')}} </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="chat_delivery{{$Order->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <h4 class="py-3 px-2"> {{trans('admin.order_chat')}} </h4>
                                            <div class="col-sm-12 col-sm-offset-4 frame chat_delivery-{{$Order->id}}">
                                                <ul class="vals_eboro">
                                                    @foreach($Chatonlines as $Chatonline)
                                                        @if($Chatonline->order_id == $Order->id && $Chatonline->type == 'delivery')
                                                            @if($Chatonline->Order->user_id == $Chatonline->user_id)
                                                                <li style="width:100%"  class="p-2">
                                                                    <div class="bubble text text-l a"> <p>{{$Chatonline->text}}</p><p><small>{{$Chatonline->created_at->diffForHumans()}}</small></p></div>
                                                                </li>
                                                            @else
                                                                <li style="width:100%;" class="p-2">
                                                                    <div class="bubble text text-r "> <p>{{$Chatonline->text}}</p><p><small>{{$Chatonline->created_at->diffForHumans()}}</small></p></div>
                                                                </li>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>

                                            <form action="{{url('api/add/chat/delivery')}}" method="post" class="add_chat_delivery" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="order_id" value="{{$Order->id}}">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-10">
                                                            <div class="msj-rta macro">
                                                                <div class="text text-r" style="background:whitesmoke !important">
                                                                    <input class="mytext" name="text" placeholder="Type a message"/>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-2">
                                                            <div class="btn text-left px-2">
                                                                <button type="submit" class="btn btn-warning radius px-4 text-white ">{{trans('admin.save')}}</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="edit{{$Order->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <h4 class="py-3 px-2">{{trans('admin.edit_order_info')}} </h4>
                                            <form action="{{url('api/edit-order')}}" method="post" class="add_Category" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="order_id" value="{{$Order->id}}">
                                                <div class="modal-body">
                                                    <div class="row px-2">
                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('admin.status')}}*</label>
                                                            <select class="form-control radius" name="status" required>
                                                                @foreach(\App\Helper\OrderStatus::arr as $key => $type)
                                                                    <option value="{{$type}}" @if($Order->status == $type) selected @endif>{{$type}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Time*</label>
                                                            <input class="form-control radius" id="ordar_at" type="datetime-local" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}" min="{{Carbon\Carbon::now()->format('Y-m-d')."T".Carbon\Carbon::now()->format('H:i')}}" value="{{Carbon\Carbon::now()->format('Y-m-d')."T".Carbon\Carbon::now()->format('H:i')}}" name="ordar_at">
                                                        </div>
                                                    </div>
                                                    <div class="row px-2">
                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('admin.categories.delivery')}} ID*</label>
                                                            <select class="form-control radius" name="delivery_id" >
                                                                <option value="">{{trans('admin.select_delivery')}}</option>
                                                                @foreach($Deliveries as $Delivery)
                                                                    <option value="{{$Delivery->id}}" @if($Delivery->id == $Order->delivery_id)  selected @endif>[{{$Delivery->id}}] - {{$Delivery->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('admin.casher')}} ID*</label>
                                                            <select class="form-control radius" name="cashier_id" >
                                                                <option value="">Select Casher</option>
                                                                @foreach($Cashiers as $Cashier)
                                                                    <option value="{{$Cashier->id}}" @if($Cashier->user->id == $Order->cashier_id)  selected @endif>[{{$Cashier->user->id}}] - {{$Cashier->user->name}}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="">{{trans('admin.refuse_reason')}} *</label>
                                                            <textarea name="refuse_reason" class="form-control radius" placeholder="{{trans('admin.categories.message')}}" cols="30" rows="5">{{$Order->refuse_reason}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div id="message">
                                                        <div class="spinner-border text-danger d-none" role="status">
                                                            <span class="sr-only">Loading...</span>
                                                        </div>
                                                    </div>
                                                    <div class="btn text-left px-2">
                                                        <button type="submit" class="btn btn-warning radius px-4 text-white ">{{trans('admin.save')}}</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="editstate{{$Order->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <h4 class="py-3 px-2"> {{trans('admin.edit_order_info')}}</h4>
                                            <form action="{{url('api/edit-order')}}" method="post" class="add_Category" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="order_id" value="{{$Order->id}}">
                                                <div class="modal-body">
                                                    <div class="row px-2">
                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('admin.status')}}*</label>
                                                            <select class="form-control radius" name="status" required>
                                                                @foreach(\App\Helper\OrderStatus::arr as $key => $type)
                                                                    <option value="{{$type}}" @if($Order->status == $type) selected @endif>{{$type}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row px-2">
                                                        <div class="form-group col-md-12">
                                                            <label for="">Refuse_reason*</label>
                                                            <textarea name="refuse_reason" class="form-control radius" placeholder="{{trans('admin.categories.message')}}" cols="30" rows="5">{{$Order->refuse_reason}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div id="message">
                                                        <div class="spinner-border text-danger d-none" role="status">
                                                            <span class="sr-only">Loading...</span>
                                                        </div>
                                                    </div>
                                                    <div class="btn text-left px-2">
                                                        <button type="submit" class="btn btn-warning radius px-4 text-white ">{{trans('admin.save')}}</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="view{{$Order->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <h4 class="py-3 px-2"> Order Information (View)</h4>
                                            <div class="modal-body">
                                                <h5 class="py-3 px-2"> Order Address <span>: {{$Order->drop_address}}</span></h5>
                                                @if($Order->transaction_ID)
                                                    <h5 class="py-3 px-2"> Order Transaction ID <span>: {{$Order->transaction_ID}}</span></h5>
                                                @endif
                                                @if($Order->refuse_reason)
                                                    <h5 class="py-3 px-2"> Order Refuse reason <span>: {{$Order->refuse_reason}}</span></h5>
                                                @endif
                                                @if($Order->paypal_EMAIL)
                                                    <h5 class="py-3 px-2"> Order Paypal email <span>: {{$Order->paypal_EMAIL}}</span></h5>
                                                @endif
                                                @if($Order->paypal_PAYERID)
                                                    <h5 class="py-3 px-2"> Order Paypal PAYERID <span>: {{$Order->paypal_PAYERID}}</span></h5>
                                                @endif
                                                @if($Order->paypal_BUILD)
                                                    <h5 class="py-3 px-2"> Order Paypal BUILD <span>: {{$Order->paypal_BUILD}}</span></h5>
                                                @endif
                                                <hr />
                                                @foreach($Order->content as $item)
                                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                                        <div class="semibold">{{$item->product->name }} - [{{$item->qty}}] </div>
                                                        @if(isset($item->sauce->price))
                                                            <div class="semibold">{{$item->sauce->name ?? ''}} - {{$item->sauce->price ?? ''}} &euro;</div>
                                                        @endif
                                                        <div class="red-color semibold">{{$item->product->price}} &euro;</div>
                                                    </div>
                                                    <hr />
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="delete{{$Order->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <form action="{{url('api/delete-order/')}}"  method="post" class="add_Category" enctype="multipart/form-data">
                                                <input type="hidden" name="order_id" value="{{$Order->id}}">
                                                <div class="modal-body">
                                                    <h6 class="text-dark"> {{trans('admin.categories.delete_p4')}}  {{$Order->id}}</h6>
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
