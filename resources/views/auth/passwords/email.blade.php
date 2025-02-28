@extends('front.layouts.app')
@section('title')
    {{trans('front.forget_password')}}
@endsection
@section('content')
    <section id="forgetpassword-6" class="with-wave">
        <div class="container sp-m">
            <div class="main-color mb-5">{{config('app.name')}}</div>
            <div
                class="main-forms d-flex align-items-center justify-content-center flex-column height-50-view width-60-per">
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <h2 class="main-color mb-3 font-weight-normal">{{config('app.name')}} {{trans('front.support')}}</h2>
                    @if (session('status'))
                        <p class="font-weight-bold main-color"> {{ session('status') }}</p>
                    @endif
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <input type="email" name="email"
                                   class="form-control @error('email') is-invalid @enderror border-0 w-100-mob"
                                   placeholder="{{trans('front.email_address')}}" value="{{old('email')}}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col-md-12 mt-4">
                            <button type="submit" class="btn btn-success btn-md">{{trans('front.send_password')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
