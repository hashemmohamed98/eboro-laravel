@include('site.paritial.include')
<!DOCTYPE html>
<html>
<head>
    @yield('SEO')
    <!-- TITLE TAG -->
    <title>Eboro Page</title>
    <!-- LINK TAGS -->
    @yield('home')
    <!-- FONTS TAGS -->
    @yield('font')
</head>
<body>
<main id="homepage">
    <!-- Start Navbar -->
    @yield('Nav')
    <!-- End Navbar -->
<section id="forgetpassword-9" class="with-wave">
    <div class="container sp-m">
        <div class="red-color mb-5">
            <a class="navbar-brand" href="#">
                <img src="images/sitelogo.jpeg" width="150" alt="">
            </a>
        </div>
          <div class="main-forms d-flex align-items-center justify-content-center flex-column height-50-view width-60-per">
        <form action="" method="">
          <h2 class="red-color mb-3 font-weight-normal">EBORO Support</h2>
          <div class="card box-shadow border-0 border-radius">
            <div class="card-body p-5">
              <p class="font-weight-bold">A verification code was sent to website@info.com</p>
              <div class="mb-1 font-weight-normal">E-mail an account verification code to "website@info.com"</div>
              <input type="text" class="form-control box-shadow border-0 mb-4">
              <button type="submit" class="btn bg-red btn-success btn-md">Continue</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>


      <!-- Start Footer -->
      @yield('footer')
      <!-- End Footer -->
  </main>
  @yield('script')
  </body>
  </html>
