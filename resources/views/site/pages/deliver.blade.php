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
    <?php
    $lat = !empty(old('lat')) ? old('lat') : 30.046321518566156;
    $lng = !empty(old('lng')) ? old('lng') : 31.238524436950275;
    ?>
    <main id="deliver">
        @if (Session::has('error'))
            <div class="alert alert-danger">
               <p>{{ Session::get('error') }}</p>
            </div>
        @endif
        <div class="container">
            <div class="mt-3 width-100-per">
                <h2 class="red-color bold"></h2>
                <p class="semibold">{{trans('public.deliver.title')}}</p>
                <form action="{{url('deliver')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 deliver-input">
                            <input type="text" class="form-control placeholder-gray" required name="name" value="{{old('name')}}"
                                   placeholder="{{trans('public.deliver.first_name')}}*">
                        </div>
                        <div class="col-md-6 deliver-input">
                            <select name="vehicle_type" class="form-control border-radius-5" required>
                                <option value="">Select {{trans('public.deliver.vehicle_type')}}</option>
                                <option value="car">{{trans('public.deliver.Car')}}</option>
                                <option value="motorcycle">{{trans('public.deliver.Motorcycle')}}Motorcycle</option>
                                <option value="bicycle">{{trans('public.deliver.Bicycle')}}</option>
                            </select>
                        </div>
                        <div class="col-md-6 deliver-input">
                            <input type="email" class="form-control placeholder-gray" required name="email" value="{{old('email')}}"
                                   placeholder="{{trans('public.deliver.email')}}*">
                        </div>
                        <div class="col-md-6 deliver-input">
                            <input type="number" class="form-control placeholder-gray" required name="mobile" value="{{old('mobile')}}"
                                   placeholder="{{trans('public.deliver.phone')}}*">
                        </div>
                        <div class="col-md-6 deliver-input">
                            <input type="password" class="form-control placeholder-gray" required name="password"
                                   placeholder="{{trans('public.deliver.password')}} *">
                        </div>

                        <div class="col-md-6 deliver-input">
                            <input type="password" class="form-control placeholder-gray" required
                                   name="password_confirmation" placeholder="{{trans('public.deliver.confirm_password')}} *">
                        </div>
                        <div class="col-md-6 deliver-input">
                            <input type="text" class="form-control placeholder-gray" required name="nationality" value="{{old('nationality')}}"
                                   placeholder="{{trans('public.deliver.nationality')}}*">
                        </div>
                        <div class="col-md-12 deliver-input">
                            <input type="text" class="form-control placeholder-gray" id="address" required
                                   name="address" value="{{old('address')}}" placeholder="{{trans('public.deliver.address')}}  *">
{{--                            <input type="hidden" value="{{ $lat }}" name="lat"  id="lat">--}}
{{--                            <input type="hidden" value="{{ $lng }}" name="long"  id="lng">--}}
                        </div>
{{--                        <div class="col-md-12">--}}
{{--                            <div id="us1" style="width: 100%; height: 400px;"></div>--}}
{{--                        </div>--}}
                        <div class="col-md-4 deliver-input">
                            <input type="text" class="form-control placeholder-gray" name="city" value="{{old('city')}}" required
                                   placeholder="{{trans('public.deliver.city')}}  *">
                        </div>
                        <div class="col-md-4 deliver-input">
                            <input type="text" class="form-control placeholder-gray" name="country" value="{{old('country')}}" required
                                   placeholder="{{trans('public.deliver.country')}}  *">
                        </div>
                        <div class="col-md-4 deliver-input">
                            <input type="text" class="form-control placeholder-gray" name="postal_code" value="{{old('postal_code')}}" required
                                   placeholder="{{trans('public.deliver.code')}}  *">
                        </div>
                        <div class="col-md-6 deliver-input">
                            <div class="double-card-input d-flex justify-content-between">
                                <div class="width-50-per">
                                    <input type="number" class="form-control border-0 placeholder-gray"
                                           placeholder="{{trans('public.deliver.id_number')}} *">
                                </div>
                                <div class="width-50-per">
                                    <input type="file" id="license-number-file" name="front_id_image" required
                                           class="form-control dropify"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 deliver-input">
                            <div class="double-card-input d-flex justify-content-between">
                                <div class="width-50-per">
                                    <input type="number" class="form-control border-0 placeholder-gray"
                                           placeholder="{{trans('public.deliver.id_back')}}*">
                                </div>
                                <div class="width-50-per">
                                    <input type="file" id="license-number-file" name="back_id_image" required
                                           class="form-control dropify"/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 deliver-input">
                            <div class="double-card-input d-flex justify-content-between">
                                <div class="width-50-per">
                                    <input type="number" class="form-control border-0 placeholder-gray"
                                           placeholder="{{trans('public.deliver.license')}} *">
                                </div>
                                <div class="width-50-per">
                                    <input type="file" id="license-number-file" name="license_image" required
                                           class="form-control dropify"/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 deliver-input">
                            <div class="double-card-input d-flex justify-content-between">
                                <div class="width-50-per">
                                    <input type="number" class="form-control border-0 placeholder-gray"
                                           placeholder="{{trans('public.deliver.license_expire')}}*">
                                </div>
                                <div class="width-50-per">
                                    <input type="file" id="license-number-file" name="license_expire" required
                                           class="form-control dropify"/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="custom-control custom-checkbox my-1 mr-sm-2 text-left font-size-14">
                                <input type="checkbox" required class="filter-input custom-control-input" id="accept-me"
                                       name="type" value="all">
                                <label class="custom-control-label" for="accept-me">{{trans('public.deliver.accept')}}
                                    <a href="{{asset('/privacy')}}" class="red-color text-underline">{{trans('public.deliver.terms')}}</a>
                                    &amp; <a href="{{asset('/privacy')}}" class="red-color text-underline">{{trans('public.deliver.conditions')}}</a></label>
                            </div>
                            <div class="custom-control custom-checkbox my-1 mr-sm-2 text-left font-size-14">
                                <input type="checkbox" class="filter-input custom-control-input" id="keep-me"
                                       name="type" value="all">
                                <label class="custom-control-label"
                                       for="keep-me">{{trans('public.deliver.updated')}}</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit"
                                    class="btn red-bg text-white btn-lg ">{{trans('public.deliver.submit')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </main>

    <!-- Start Footer -->
@yield('footer')
<!-- End Footer -->
</main>
@yield('script')
<script type="text/javascript"
        src='https://maps.google.com/maps/api/js?sensor=false&libraries=places&key={{config('app.google_key')}}'></script>
<script type="text/javascript" src='{{ url('public/locationpicker.jquery.js')}}'></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>

{{--<script>--}}
{{--    $('#us1').locationpicker({--}}
{{--        location: {--}}
{{--            latitude: '{{ $lat }}',--}}
{{--            longitude: '{{ $lng }}',--}}
{{--        },--}}
{{--        radius: 300,--}}
{{--        markerIcon: '{{ url('public/map-marker-2-xl.png')}}',--}}
{{--        inputBinding: {--}}
{{--            latitudeInput: $('#lat'),--}}
{{--            longitudeInput: $('#lng'),--}}
{{--            locationNameInput: $('#address')--}}
{{--        },--}}
{{--        enableAutocomplete: true,--}}
{{--    });--}}
{{--</script>--}}
</body>
</html>
