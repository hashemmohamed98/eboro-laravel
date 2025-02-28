@foreach($Orders as $Order)
    @if(request()->has('state') && (($Order->status == request()['state']) || ((request()['state'] == "pending" || request()['state'] == "in progress") && ($Order->status == "pending" || $Order->status == "in progress")) ) )
        <tr class="border-bottom">
            <td class="width-50">
                <div>{{$Order->id}}</div>
            </td>

            <td class="width-100">
                <div>{{$Order->created_at}}</div>
            </td>
            <td class="width-100">
                <div>{{$Order->ordar_at}}</div>
            </td>
            <td class="width-100">
                <div>{{$Order->branch->name??"Many"}}</div>
            </td>

            <td class="width-100">
                <div>{{$Order->delivery->name ?? 'not assign'}}</div>
            </td>

            <td class="width-100" data-toggle="modal" data-target="#editstate{{$Order->id}}">
                <button class="btn btn-success btn-sm width-100">{{$Order->branches->whereIn('branch_id',$Branches->pluck('id')->toArray())->first()->status??$Order->status}}</button>
            </td>
            <td class="width-100">
                <div class="d-flex align-items-center justify-content-center">
                    @if($Providers->delivery == "1")
                        <div class="mr-2 cursor-pointer">
                            <i class="fas fa-user text-primary" alt="" data-toggle="modal" data-target="#Order_user{{$Order->id}}"></i>
                        </div>
                    @endif
                    <div class="mr-2 cursor-pointer">
                        <img src="{{asset('resources/views/dashboard/assets/images/view.svg')}}" alt="" data-toggle="modal" data-target="#Order_infos{{$Order->id}}">
                    </div>
                    <div class="mr-2 cursor-pointer">
                        <img src="{{asset('resources/views/dashboard/assets/images/edit.svg')}}" alt="" data-toggle="modal" data-target="#Order_info{{$Order->id}}">
                    </div>
                </div>
                @if($Providers->delivery == "1")
                    <div class="modal fade" id="Order_user{{$Order->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <h4 class="py-3 px-2"> Order Information (Edition)</h4>
                                <div class="modal-body text-left">
                                    <div class="row px-2">
                                        <div class="form-group col-md-12">
                                            <div>{{trans('dashboard.beverages.name')}} : {{$Order->user->name}}</div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <div>mobile : {{$Order->user->mobile}}</div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            {{trans('admin.portfolio.address')}} :
                                            <a href="https://maps.google.com/?q={{$Order->drop_lat}},{{$Order->drop_long}}" target="_blank">
                                                <img src="{{asset('resources/views/dashboard/assets/images/branchlocation.svg')}}" alt="">
                                            </a>
                                        </div>
                                        <div class="form-group col-md-12">
                                            {{trans('admin.portfolio.address')}} :
                                            {{$Order->drop_address}}
                                        </div>
                                        <div class="form-group col-md-12">
                                            <div>{{trans('dashboard.delivery.payment')}} : {{$Order->payment== 1 ? "Online":"Cash"}}</div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <div>{{trans('admin.price')}} : {{$Order->total_price}} €</div>
                                        </div>

                                        <div class="btn text-left px-2">
                                            <button type="submit" class="btn dashboard-main-bg radius px-4 text-white ">save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="modal fade" id="editstate{{$Order->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content text-left">
                            <h4 class="py-3 px-2"> Order Information (Edition)</h4>
                            <form action="{{url('dashboard/edit/order')}}" method="post" class="add_Category" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="order_id" value="{{$Order->id}}">
                                <div class="modal-body">
                                    <div class="row px-2">
                                        <div class="form-group col-md-6">
                                            <label for="">Status*</label>
                                            <select class="form-control radius" name="status" required>
                                                <option value="pending" @if($Order->status == "pending") selected @endif>pending</option>
                                                <option value="in progress" @if($Order->status == "in progress") selected @endif>in progress</option>
                                                <option value="to delivering" @if($Order->status == "to delivering") selected @endif>to delivering</option>
                                                <option value="complete" @if($Order->status == "complete") selected @endif>complete</option>
                                                <option value="cancelled" @if($Order->status == "cancelled") selected @endif>cancelled</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row px-2">
                                        <div class="form-group col-md-12">
                                            <label for="">Refuse_reason*</label>
                                            <textarea name="refuse_reason" class="form-control radius" placeholder="{{trans('admin.categories.message')}}" cols="30" rows="5">{{$Order->refuse_reason}}</textarea>
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
                <div class="modal fade" id="Order_info{{$Order->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <h4 class="py-3 px-2"> Order Information (Edition)</h4>
                            <form action="{{url('dashboard/edit/order')}}" class="request_order" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="order_id" value="{{$Order->id}}">
                                <input type="hidden" name="branch_id" value="{{$Order->id}}">
                                <div class="modal-body text-left">
                                    <div class="row px-2">
                                        <div class="form-group col-md-6">
                                            <label for="">Status*</label>
                                            <select class="form-control radius" name="status" required>
{{--                                                @foreach(\App\Helper\OrderStatus::arr as $item)--}}
{{--                                                    <option value="{{$item}}" @if($Order->status == $item) selected @endif>{{$item}}</option>--}}
{{--                                                @endforeach--}}
                                                <option value="pending" @if($Order->status == "pending") selected @endif>pending</option>
                                                <option value="in progress" @if($Order->status == "in progress") selected @endif>in progress</option>
                                                <option value="to delivering" @if($Order->status == "to delivering") selected @endif>to delivering</option>
                                                <option value="complete" @if($Order->status == "complete") selected @endif>complete</option>
                                                <option value="cancelled" @if($Order->status == "cancelled") selected @endif>cancelled</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="">Casher ID*</label>
                                            <select class="form-control radius" name="cashier_id" >
                                                <option value="">Select Casher</option>
                                                @foreach($Cashiers as $Cashier)
                                                    <option value="{{$Cashier->id}}" @if($Cashier->user->id == $Order->cashier_id)  selected @endif>[{{$Cashier->user->id}}] - {{$Cashier->user->name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="row px-2">
                                        <div class="form-group col-md-12">
                                            <label for="">refuse_reason*</label>
                                            <textarea name="refuse_reason" class="form-control radius" placeholder="{{trans('admin.categories.message')}}" cols="30" rows="5">{{$Order->refuse_reason}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <div id="message">
                                                <div class="spinner-border text-danger d-none" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btn text-left px-2">
                                        <button type="submit" class="btn dashboard-main-bg radius px-4 text-white ">save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="Order_infos{{$Order->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <h4 class="py-3 px-2"> Order Information (View)</h4>
                            <div class="modal-body">
                                @foreach($Order->content as $item)
                                    @if($item->product->branch->provider->id == $Providers->id)
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <div class="semibold">{{$item->product->name }} - [{{$item->qty}}] </div>
                                            @if(isset($item->sauce->price))
                                                <div class="semibold">{{$item->sauce->name ?? ''}} - {{$item->sauce->price ?? ''}} &euro;</div>
                                            @endif
                                            @if(isset($item->comment))
                                                <div class="semibold">{{$item->comment ?? ''}}</div>
                                            @endif
                                            <div class="red-color semibold">{{$item->product->price}} &euro;</div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    @endif
@endforeach


