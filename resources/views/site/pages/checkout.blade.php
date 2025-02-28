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
    <main id="checkout">
        <div class="container">
            <form action="{{url('api/add-order/')}}" id="addOrderForm"
                  enctype="multipart/form-data">
                <div class="mt-3 width-100-per">
                    <div class="row">

                        <div class="col-md-8">
                            <div class="card card-box-shadow border-0 border-radius-20 p-5 mb-4">
                                <h2 class="blue-color bold">{{trans('public.checkout.title')}}</h2>
                                <div class="row">
                                    <input type="hidden" name="lat" id="lat">
                                    <input type="hidden" name="lng" id="lng">
                                    <div class="col-md-6">
                                        <label class="semibold">{{trans('public.checkout.payment_title')}}</label>
                                        <select  id="payment" name="payment" class="form-control">
                                            {{--  <option value="0"  data-toggle="#cash_content">Cash</option>--}}
                                                <option value="1"  data-toggle="#creadit_content" selected>{{trans('public.checkout.credit')}}</option>
                                            <option value="2"  data-toggle="#paypal_content" >{{trans('public.checkout.paypal')}}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="semibold">{{trans('public.checkout.time')}}</label>
                                        <input class="form-control radius" id="ordar_at" type="datetime-local" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}" min="{{Carbon\Carbon::now()->format('Y-m-d')."T".Carbon\Carbon::now()->format('H:i')}}" value="{{Carbon\Carbon::now()->format('Y-m-d')."T".Carbon\Carbon::now()->format('H:i')}}" name="ordar_at">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="semibold">{{trans('public.checkout.address')}}</label>
                                        <input type="text" value="test" id="address" name="drop_address" class="form-control address">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="semibold">{{trans('public.checkout.house_number')}}</label>
                                        <input type="text" value="" id="drop_house" name="drop_house" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="semibold">{{trans('public.checkout.city')}}</label>
                                        <input type="text" value="" id="drop_city" name="drop_city" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="semibold">{{trans('public.checkout.postal_code')}}</label>
                                        <input type="text" value="" id="drop_postal" name="drop_postal" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="semibold">{{trans('public.checkout.intercom')}}</label>
                                        <input type="text" value="" id="drop_intercom" name="drop_intercom" class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <div id="us1" style="width: 100%; height: 400px;"></div>
                                    </div>
                                    <div class="col-md-12">

                                        <div class="tab-content " id="pilling_content">
                                            <div class="tab-pane payment-tabs active in" id="creadit_content" role="tabpanel"
                                                 aria-labelledby="pills-home-tab">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="semibold">{{trans('public.checkout.card_name')}} <sup>*</sup></label>
                                                            <input type="text" class="form-control" onkeyup="$cc.name(event)" name="card_name" id="card_name" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="semibold">{{trans('public.checkout.card_number ')}} <sup>*</sup></label>
                                                            <input type="text" class="form-control" onkeyup="$cc.validate(event)" name="card_number" id="card_number" maxlength="24" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="semibold">{{trans('public.checkout.expiration_date ')}} <sup>*</sup></label>
                                                            <input type="text" class="form-control" onkeyup="$cc.expiry.call(this,event)" name="card_date" id="card_date" placeholder="mm/yy" pattern="[0-9]{2}/[0-9]{2}" maxlength="5" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="semibold">CVV <sup>*</sup></label>
                                                            <input type="password" class="form-control" name="card_cvv" id="card_cvv" maxlength="5" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane payment-tabs" id="cash_content" role="tabpanel" aria-labelledby="pills-home-tab">
                                            </div>
                                            <div class="tab-pane payment-tabs" id="paypal_content" role="tabpanel">
{{--                                                <a href="{{ route('make.payment') }}" class="btn btn-primary mt-3">Pay via Paypal</a>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card card-box-shadow border-0 border-radius-20 p-4 mb-5">
                                <div class="border-bottom">
                                    <h2 class="blue-color bold">{{trans('public.checkout.order_summary')}}</h2>
                                    <p>{{trans('public.checkout.order_caption')}}</p>
                                </div>
                                <div class="border-bottom py-3">
                                    @foreach(auth()->user()->carts as $item)
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <div class="semibold">{{$item->product->name }} - [{{$item->qty}}]
                                                @if(isset($item->sauce->price))
                                                    <div class="semibold small"> - {{$item->sauce->name ?? ''}} - {{$item->sauce->price ?? ''}} &euro;</div>
                                                @endif</div>

                                            <div class="red-color semibold">{{$item->product->offer ? ($item->product->price - (($item->product->offer->value / 100) * $item->product->price)) : $item->product->price}} &euro;</div>
                                            <div class="semibold" data-toggle="modal" data-target="#add-comment{{$item->product->id}}"><i class="text-warning fas fa-comment-alt"></i></div>
                                            <div class="modal fade" id="add-comment{{$item->product->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <h4 class="py-3 px-2"> (Add comment)</h4>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="form-group col-12">
                                                                    <label for="">{{trans('admin.portfolio.description')}}*</label>
                                                                    <textarea name="comment[]" class="form-control radius comment" placeholder="{{trans('admin.categories.message')}}" cols="30" rows="5"></textarea>
                                                                </div>
                                                            </div>
                                                            <button class="btn btn-warning px-4 text-white" data-dismiss="modal" aria-label="Close">{{trans('admin.categories.save')}}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="border-bottom py-3">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div class="semibold">{{trans('public.checkout.tax')}}</div>
                                        <div class="red-color semibold" id="tax">0 &euro;</div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div class="semibold">{{trans('public.checkout.shipping')}}</div>
                                        <div class="red-color semibold" id="shipping">0 &euro;</div>
                                    </div>
                                    <div class="d-flex  justify-content-between mb-3">
                                        <div class="semibold">{{trans('public.checkout.duration')}}</div>
                                        <div class="red-color semibold" id="Duration"></div>
                                    </div>
                                </div>
                                <div class="py-3">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div class="semibold">{{trans('public.navbar.cart.subtotal')}}</div>
                                        <div class="red-color semibold">{{auth()->user()->carts->sum('price')}} &euro;</div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div class="semibold">{{trans('public.cart.total')}}</div>
                                        <div class="red-color semibold" id="total">{{auth()->user()->carts->sum('price') + (auth()->user()->carts->sum('price') * $share_setting->tax   )}} &euro;</div>
                                    </div>
                                </div>
                                <div class="py-3">
                                    <div class="message text-danger text-center">
                                        <div class="spinner-border text-danger d-none" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="input-group cust-input mb-4">
{{--                                <input type="text" class="form-control placeholder-gray" placeholder="Enter coupon code">--}}
{{--                                <div class="input-group-prepend">--}}
{{--                                    <button type="submit" class="btn red-bg text-white btn-successmsg" data-open="alert-successfuly-message">{{trans('public.checkout.apply')}}</button>--}}
{{--                                </div>--}}
                            </div>
                            <div class="loader">
                                <div class="loading">
                                </div>
                            </div>

                            <a href="test" rel="external" target="_blank" class="paypal"></a>
                            <button type="submit" class="btn btn-block red-bg text-white btn-lg">{{trans('public.checkout.place_order')}}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <!-- Start Footer -->
@yield('footer')
<!-- End Footer -->
</main>
@yield('script')
<script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=false&libraries=places&key={{config('app.google_key')}}'></script>
<script type="text/javascript" src='{{ url('public/locationpicker.jquery.js')}}'></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>

<script>
    $( document ).ready(function() {
        navigator.geolocation.getCurrentPosition(showPosition);
        @if(auth()->user()->lat && auth()->user()->long)
        function showPosition(position) {
            let lat = {{auth()->user()->lat}};
            let lng = {{auth()->user()->long}};
            $('#lat').val(lat);
            $('#lng').val(lng);
            buildMap(lat, lng);
        }
        @else
        function showPosition(position) {
            let lat = position.coords.latitude;
            let lng = position.coords.longitude;
            $('#lat').val(lat);
            $('#lng').val(lng);
            buildMap(lat, lng);
        }
        @endif

    });

    let total= "{{auth()->user()->carts->sum('price') + (auth()->user()->carts->sum('price') * $share_setting->tax)}}";
    let amount = "{{(auth()->user()->carts->sum('price'))}}";
    function buildMap(lat, lng) {
        $('#us1').locationpicker({
            location: {
                latitude: +lat ,
                longitude: +lng,
            },
            radius: 300,
            markerIcon: '{{ url('public/map-marker-2-xl.png')}}',
            inputBinding: {
                latitudeInput: $('#lat'),
                longitudeInput: $('#lng'),
                locationNameInput: $('#address')
            },
            setCurrentPosition: true,
            enableAutocomplete: true,
            oninitialized: function (component) {
                axios({
                    method: 'get',
                    url: '{{url('/distance2/')}}/' + lat + '/' + lng,
                }).then(function (response) {
                    $('#shipping').html(response.data.shipping + " &euro;");
                    $('#tax').html((parseFloat(amount)*parseFloat(response.data.Tax)).toFixed(2) + " &euro;");
                    $('#Duration').html(parseFloat(response.data.Duration).toFixed(0) + ' min');
                    $('#total').html((parseFloat(total)+parseFloat(response.data.shipping)).toFixed(2)+ " &euro;");
                });
            },
            onchanged: function(currentLocation, radius, isMarkerDropped)
            {
                axios({
                    method: 'get',
                    url: '{{url('/distance2/')}}/'+currentLocation.latitude+'/'+currentLocation.longitude,
                }).then(function (response) {
                    $('#shipping').html(response.data.shipping + " &euro;");
                    $('#tax').html((parseFloat(amount)*parseFloat(response.data.Tax)).toFixed(2) + " &euro;");
                    $('#Duration').html(response.data.Duration.toFixed(0)+ " Min");
                    $('#total').html((parseFloat(total)+parseFloat(response.data.shipping)).toFixed(2) + " &euro;");
                });
            }
        });
    }
</script>
<script>
    // toggle display for pilling info
    $('.pill-tab').on('click', function () {
        $('#pilling_content').removeClass('d-none')
    });

    $('#payment').on('change', function() {
        let tabID = $(this).find(":selected").data('toggle');
        $('.tab-pane').removeClass('active in');
        $(tabID).addClass("active in");
        if(tabID == "#cash_content" || tabID == "#paypal_content")
        {
            $('#card_number').prop('required',false);
            $('#card_date').prop('required',false);
            $('#card_cvv').prop('required',false);
            $('#card_name').prop('required',false);
        }
        else
        {
            $('#card_number').prop('required',true);
            $('#card_date').prop('required',true);
            $('#card_cvv').prop('required',true);
            $('#card_name').prop('required',true);
        }
    });

    // add order
    $('#addOrderForm').on('submit', function (e) {
        e.preventDefault();
        $('.loader').addClass('d-block').removeClass('d-none');
        $('button[type=submit], input[type=submit]').prop('disabled',true);

        const $this = $(this);
        axios.post($this.attr('action'), {
            drop_lat: $('#lat').val(),
            drop_long: $('#lng').val(),
            drop_address: $('#address').val()
                + ',House: ' + $('#drop_house').val()
                + ',City: ' + $('#drop_city').val()
                + ',Postal: ' + $('#drop_postal').val()
                + ',Intercom: ' + $('#drop_intercom').val(),
            payment: $('#payment').val(),
            card_number: $('#card_number').val(),
            card_name: $('#card_name').val(),
            card_date: $('#card_date').val(),
            card_cvv: $('#card_cvv').val(),
            ordar_at: $('#ordar_at').val(),
            comment: $('.comment').map(function(){
                return $(this).val()
            }).get(),
        }, {
            headers: {
                'apiLang': 'en',
                'Accept': 'application/json',
                'Authorization': '{{$Token}}'
            }
        }).then(response => {
            $('.loader').addClass('d-none').removeClass('d-block');
            $('.message').addClass('d-none');
            if(response.data.link != null && response.data.link.toString().indexOf('paypal') >= 0){
                // window.open(response.data.link, '_blank').focus();

                if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
                    window.location.assign(response.data.link);
                }
                else
                {
                    $('.paypal').attr('href', response.data.link);
                    $('.paypal')[0].click();
                }
            }
            if(response.data.link != null && response.data.link.original.message != null){
                const message = $('.message');
                $('.message').addClass('d-block').removeClass('d-none');
                message.html(response.data.link.original.message);
                if(response.data.link.original.message == '{{trans('admin.done')}}')
                {
                    $('.paypal').attr('href', '{{asset('/Profile/'.Auth::user()->name)}}');
                    $('.paypal')[0].click();
                }
            }else if (response.data.code == 200) {
                $('.message').removeClass('d-block').addClass('d-none');
                $('<div />').appendTo(message).addClass('alert alert-success p-2').text('Your product has been added succefully')
                window.location.reload(3000)
            }
            $('button[type=submit], input[type=submit]').prop('disabled',false);
        }).catch(error => {
            console.log(error);
            const message = $('.message');
            message.html(error);
            {{--message.html('{{trans('admin.error_out_of_range')}}');--}}
            $('button[type=submit], input[type=submit]').prop('disabled',false);
        })
    });

    let $cc = {}
    $cc.expiry = function(e){
        if (e.key != 'Backspace'){
            let number = String(this.value);

            //remove all non-number character from the value
            let cleanNumber = '';
            for (let i = 0; i<number.length; i++){
                if (i == 1 && number.charAt(i) == '/'){
                    cleanNumber = 0 + number.charAt(0);
                }
                if (/^[0-9]+$/.test(number.charAt(i))){
                    cleanNumber += number.charAt(i);
                }
            }

            let formattedMonth = ''
            for (let i = 0; i<cleanNumber.length; i++){
                if (/^[0-9]+$/.test(cleanNumber.charAt(i))){
                    //if the number is greater than 1 append a zero to force a 2 digit month
                    if (i == 0 && cleanNumber.charAt(i) > 1){
                        formattedMonth += 0;
                        formattedMonth += cleanNumber.charAt(i);
                        formattedMonth += '/';
                    }
                    //add a '/' after the second number
                    else if (i == 1){
                        formattedMonth += cleanNumber.charAt(i);
                        formattedMonth += '/';
                    }
                    //force a 2 digit year
                    else if (i == 2 && cleanNumber.charAt(i) <=1){
                        formattedMonth += '';
                    }else{
                        formattedMonth += cleanNumber.charAt(i);
                    }

                }
            }
            this.value = formattedMonth;
        }
    }

    $cc.validate = function(e){

        let number = String(e.target.value);
        let cleanNumber = '';
        for (let i = 0; i<number.length; i++){
            if (/^[0-9]+$/.test(number.charAt(i))){
                cleanNumber += number.charAt(i);
            }
        }

        //Only parse and correct the input value if the key pressed isn't backspace.
        if (e.key != 'Backspace'){
            //Format the value to include spaces in the correct locations
            let formatNumber = '';
            for (let i = 0; i<cleanNumber.length; i++){
                if (i == 3 || i == 7 || i == 11 || i == 15){
                    formatNumber = formatNumber + cleanNumber.charAt(i) + ' '
                }else{
                    formatNumber += cleanNumber.charAt(i)
                }
            }
            e.target.value = formatNumber;
        }

    }

    $cc.name = function(e){
        let name = String(e.target.value);
        let cleanNumber = '';
        for (let i = 0; i < name.length; i++){
            if (/^[A-Za-z\s]+$/.test(name.charAt(i))){
                cleanNumber += name.charAt(i);
            }
        }
        e.target.value = cleanNumber;
    }

</script>
</body>
</html>
