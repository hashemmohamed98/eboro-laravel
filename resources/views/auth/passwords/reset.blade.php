@extends('front.layouts.app')
@section('title')
    {{trans('front.reset_password')}}
@endsection
@section('content')
<section id="forgetpassword-8">
    <div class="container sp-m">
      <div class="red-color mb-5">
        <a class="navbar-brand" href="#">
            <img src="images/sitelogo.jpeg" width="150" alt="">
        </a>
    </div>
      <div class="main-forms mb-5 d-flex align-items-center justify-content-center flex-column width-60-per">
        <form action="" method="">
          <h2 class="red-color mb-3 font-weight-normal">EBORO Support</h2>
          <div class="card box-shadow border-0 border-radius">
            <div class="card-body p-5">
              <p class="font-weight-bold red-color">A verification code was sent to website@info.com</p>
              <div class="mb-1 font-weight-normal">E-mail an account verification code to "website@info.com"</div>
              <input type="text" class="form-control box-shadow border-0 mb-4">
              <button type="submit" class="btn btn-success btn-md mr-5">Continue</button>
            </div>
          </div>
        </form>
      </div>
      <div class="font-weight-bold font-size-18">Having trouble receiving an account verification code?</div>
      <p class="mb-4 text-muted font-size-13">It could take up to 5 minutes for an account verification code to be delivered</p>
      <button class="btn btn-success btn-md bg-red">Resend account verification code</button>
    </div>
  </section>
@endsection

