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
                    <h3>ON : {{$setting->assist_phones[intval(now()->format('H'))] ?? 'default'}} -- {{ now()->format('H:i') }}</h3>
                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                            <a href="{{url('admin/change-system-status/'.$setting->id)}}">
                                <i title="lock" class="fas {{$setting->state=='close'?'fa-lock text-danger':'fa-unlock text-info'}} fa-2x  px-3"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{url('admin/assist_phones/'.$setting->id)}}" enctype="multipart/form-data">
                        @csrf
                        <h4>Phones Setting</h4>
                        <div id="phoneFields">
                            @php
                                // Generate times from 00:00 to 12:59
                                $time = \Carbon\Carbon::createFromTime(0, 0);  // Starting from 00:00
                            @endphp

                            @for($i = 0; $i < 24; $i++)
                                <div>
                                    <label for="phone_{{ $i }}">
                                        Phone at : {{ $time->format('H:i') }}:
                                    </label>

                                    <input type="text" name="phones[]" id="phone_{{ $i }}"
                                           value="{{ $setting->assist_phones[$i] }}"
                                           class="form-control" >
                                    @php
                                        $time->addMinutes(60);  // Increment time by 1 hour (60 minutes)
                                    @endphp
                                </div>
                            @endfor
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
