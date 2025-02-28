@extends('admin.layouts.master')
@section('title')
{{trans('admin.categories.delivery')}}
@endsection
@section('icon')
    fas fa-car
@endsection
@section('page')
    <div class="page-title-subheading "><a href="Home" class="text-primary">{{trans('admin.dashboard')}}</a> - <span
            class="text-success">{{trans('admin.categories.delivery')}}
        </span></div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">{{trans('admin.user.users')}}
                    <div class="btn-actions-pane-right">
                        <a class="btn btn-success text-white" data-toggle="modal"
                           data-target="#Downloand_Report" title="Download Delivery Report">{{trans('admin.select_time')}}</a>
                        @push('modal')
                        <div class="modal fade" id="Downloand_Report" tabindex="-1"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <h4 class="py-3 px-2">{{trans('admin.donwload_delivery_report')}}</h4>
                                    <div class="modal-body">
                                        <form action="{{url('api/Admin_Delivery_Orders_Report')}}" class="Downloand_Report"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label for="">{{trans('admin.categories.user')}}*</label>
                                                    <select name="user_id" class="form-control radius">
                                                        <option value="">{{trans('admin.all')}}</option>
                                                        @foreach($users as $user)
                                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="">{{trans('admin.type')}}*</label>
                                                    <select name="type" class="form-control radius">
                                                            <option value="excel" >Excel</option>
                                                            <option value="csv" >CSV</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="">{{trans('admin.start_date')}}*</label>
                                                    <input class="form-control radius" id="start_date" type="datetime-local" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}" max="{{Carbon\Carbon::now()->format('Y-m-d')."T".Carbon\Carbon::now()->format('H:i')}}" name="start_date">

                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="">{{trans('admin.end_date')}}*</label>
                                                    <input class="form-control radius" id="end_date" type="datetime-local" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}" max="{{Carbon\Carbon::now()->format('Y-m-d')."T".Carbon\Carbon::now()->format('H:i')}}" name="end_date">
                                                </div>
                                            </div>
                                            <div id="message">
                                                <div class="spinner-border text-danger d-none" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-warning px-4 text-white">{{trans('admin.download')}}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endpush
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="example" class="table table-hover codiano-datatable table-striped table-bordered"
                           style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{trans('State')}}</th>
                            <th>{{trans('admin.categories.name')}}</th>
                            <th>{{trans('admin.categories.email')}}</th>
                            <th>{{trans('admin.categories.phone')}}</th>
                            <th>{{trans('admin.categories.location')}}</th>
                            <th>{{trans('dashboard.beverages.branch')}}</th>
                            <th>Role</th>
                            <th>{{trans('admin.categories.action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td class="width-50">
                                    <div>{!! $user->online==1?"<i class='text-success fas fa-circle '></i> Online":" <i class='text-danger fas fa-spinner fa-pulse'></i> Offline" !!}</div>
                                </td>
                                <td>{{ $user->name }} </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->mobile }}</td>
                                <td>
                                    <a href="https://maps.google.com/?q={{$user->lat}},{{$user->long}}" target="_blank">
                                        <img src="{{asset('resources/views/dashboard/assets/images/branchlocation.svg')}}" alt="">
                                    </a>
                                </td>
                                <td>{{ $user->Branch->branch->name ?? 'undefined' }}</td>
                                <td>{{ \App\Helper\UsersType::AllTypes[$user->type] }}</td>
                                <td>
                                    @if($user->active==\App\Helper\UsersStatus::Active)
                                        <a class="btn btn-xs btn-warning d-block text-white"
                                           href="{{url('admin/status-user/'.$user->id)}}">{{trans('admin.not_active')}}</a>
                                    @else
                                        <a class="btn btn-xs btn-success d-block text-white"
                                           href="{{url('admin/status-user/'.$user->id)}}">{{trans('admin.active')}}</a>
                                    @endif
                                        <i class="fas fa-edit text-warning px-2" data-toggle="modal"
                                           data-target="#Admin_edit{{$user->id}}"></i>
                                        <i class="fas fa-trash text-danger px-2" data-toggle="modal"
                                           data-target="#delete{{$user->id}}"></i>
                                </td>
                            </tr>
                            @push('modal')
                                <div class="modal fade" id="Admin_edit{{$user->id}}" tabindex="-1"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <h4 class="py-3 px-2"> {{trans('admin.users')}}</h4>
                                            <div class="modal-body">
                                                <form action="{{url('api/edit-user/'. $user->id)}}" class="add_Admin"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('admin.name')}}*</label>
                                                            <input type="text" name="name" class="form-control radius"
                                                                   placeholder="{{trans('admin.name')}}" value="{{$user->name}}">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('admin.categories.email')}}*</label>
                                                            <input type="email" name="email" class="form-control radius"
                                                                   placeholder="{{trans('admin.categories.email')}}"
                                                                   value="{{$user->email}}">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('dashboard.beverages.branch')}}
                                                                *</label>
                                                            <select class="form-control radius" placeholder="branch_id"
                                                                    name="branch_id">
                                                                <option value="">{{trans('dashboard.select_branch')}}</option>
                                                                @foreach($Branches as $Branch)
                                                                    <option value="{{$Branch->id}}"
                                                                            @if($user->Branch && $Branch->id == $user->Branch->branch_id) selected @endif>{{$Branch->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('dashboard.beverages.type')}}*</label>
                                                            <select name="type" class="form-control radius">
                                                                @foreach(\App\Helper\UsersType::AllTypes as $key => $type)
                                                                    <option value="{{$key}}"
                                                                            @if($key == $user->type) selected @endif>{{$type}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('admin.phone')}}*</label>
                                                            <input type="number" name="mobile"
                                                                   class="form-control radius"
                                                                   value="{{$user->mobile}}">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="">{{trans('admin.password')}}*</label>
                                                            <input type="password" name="password"
                                                                   class="form-control radius" value="">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for=""
                                                                   class="d-block">{{trans('admin.portfolio.image')}}</label>
                                                            <img src="{{asset('/public/uploads/User/'.$user->image)}}"
                                                                 width="100" alt="">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="">{{trans('admin.portfolio.image')}}
                                                                    *</label>
                                                                <input name="image" type="file" accept="image/*"
                                                                       onchange="loadFile(event)"
                                                                       class="form-control upload-image"/>
                                                            </div>
                                                        </div>
                                                        @if($user->type==\App\Helper\UsersType::Delivery)
                                                            <div class="form-group col-md-6">
                                                                <label for="">{{trans('admin.city')}}</label>
                                                                <input type="text" name="city"
                                                                       class="form-control radius"
                                                                       value="{{$user->city}}">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="">{{trans('admin.country')}}*</label>
                                                                <input type="text" name="country"
                                                                       class="form-control radius" value="{{$user->country}}">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="">{{trans('admin.portfolio.address')}}</label>
                                                                <input type="text" name="address"
                                                                       class="form-control radius"
                                                                       value="{{$user->address}}">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="">{{trans('admin.postal_code')}}*</label>
                                                                <input type="text" name="postal_code"
                                                                       class="form-control radius" value="{{$user->postal_code}}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for=""
                                                                       class="d-block">{{trans('admin.front_id_image')}}</label>
                                                                <img src="{{asset('/public/uploads/Delivery/'.$user->front_id_image)}}"
                                                                     width="100" alt="">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="">{{trans('admin.front_id_image')}}
                                                                        *</label>
                                                                    <input name="front_id_image" type="file" accept="image/*"
                                                                           onchange="loadFile(event)"
                                                                           class="form-control upload-image"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for=""
                                                                       class="d-block">{{trans('admin.back_id_image')}}</label>
                                                                <img src="{{asset('/public/uploads/Delivery/'.$user->back_id_image)}}"
                                                                     width="100" alt="">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="">{{trans('admin.back_id_image')}}
                                                                        *</label>
                                                                    <input name="back_id_image" type="file" accept="image/*"
                                                                           onchange="loadFile(event)"
                                                                           class="form-control upload-image"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for=""
                                                                       class="d-block">{{trans('admin.license_image')}}</label>
                                                                <img src="{{asset('/public/uploads/Delivery/'.$user->license_image)}}"
                                                                     width="100" alt="">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="">{{trans('admin.license_image')}}
                                                                        *</label>
                                                                    <input name="license_image" type="file" accept="image/*"
                                                                           onchange="loadFile(event)"
                                                                           class="form-control upload-image"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for=""
                                                                       class="d-block">{{trans('admin.license_expire')}}</label>
                                                                <img src="{{asset('/public/uploads/Delivery/'.$user->license_expire)}}"
                                                                     width="100" alt="">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="">{{trans('admin.license_expire')}}
                                                                        *</label>
                                                                    <input name="license_expire" type="file" accept="image/*"
                                                                           onchange="loadFile(event)"
                                                                           class="form-control upload-image"/>
                                                                </div>
                                                            </div>
                                                        @endif
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
                                <div class="modal fade" id="delete{{$user->id}}" tabindex="-1"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <form action="{{url('api/delete-user/'. $user->id)}}" class="delete">
                                                <div class="modal-body">
                                                    <h6 class="text-dark"> {{trans('admin.categories.delete_p4')}}  {{$user->name}}</h6>
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

@section('js')
    <script>
        $(document).on('submit', ".Downloand_Report" , function(e) {
            e.preventDefault()
            const form = new FormData($(this)[0]);
            const $this = $(this);

            axios.post($this.attr('action'), form,{
                headers: {
                    'apiLang': 'en',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Authorization': "Bearer {{auth()->user()->generateAuthToken()??''}}"
                },
                responseType: 'blob',
            }).then(response => {
                $(this).closest('div').find('#message .spinner-border').addClass('d-none')
                if (response.status == 200) {

                    var a = document.createElement('a');
                    var url = window.URL.createObjectURL(response.data);
                    a.href = url;
                    a.download = name;
                    document.body.append(a);
                    a.click();
                    a.remove();
                    window.URL.revokeObjectURL(url);

                    const message = $(this).closest('div').find('#message')
                    message.html('')
                    $('<div />').appendTo(message).addClass('alert alert-success p-2').text('The process has been completed successfully')
                    window.location.reload(3000)
                }
            }).catch(error => {
                $(this).closest('div').find('#message .spinner-border').addClass('d-none')
                const message = $(this).closest('div').find('#message')
                message.html('')
                $.each(error.response.status.errors, function(key, filedErrors) {
                    $('<div />').appendTo(message).addClass('alert alert-danger p-2').text(filedErrors[0])
                })
                console.log ('status', error.response.errors);

            })
        });

    </script>
@endsection
