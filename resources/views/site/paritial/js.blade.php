@section('script')
    <script src="{{asset('js/jquery.3.4.1.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js"></script>

    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/fontawesome-all.js')}}"></script>
    <script src="{{asset('js/stackedCards.min.js')}}"></script>
    <script src="{{asset('js/jquery.nicescroll.min.js')}}"></script>
    <script src="{{asset('js/rangeslider-js.min.js')}}"></script>
    <script src="{{asset('js/dropify.min.js')}}"></script>
    <script src="{{asset('js/pagination.js')}}"></script>
    <script src="{{asset('js/main-s.js')}}"></script>
    <script src="{{asset('js/datatables.min.js')}}"></script>
    <script src="{{asset('js/lazyload.min.js')}}"></script>
    <script>

        $(window).on("load", function() {
            // will first fade out the loading animation
            $("#preloader").fadeOut();
            // will fade out the whole DIV that covers the website.
            $("#status").fadeOut(9000);
        })

        let lazyContent = new LazyLoad({
        });




        $('.map-btn').click(function () {
            // if ($('#txtIP').val() == '') {
            //     alert('IP address is reqired');
            //     return false;
            // }
            $.getJSON("https://ip-api.io/json/" + $('.loc-drop .dropdown-item').val(),
                function (result) {
                    alert('City Name: ' + result.city)
                 //   console.log(result);
                });
        });

        $(function() {
            $(".cart-Added-content").niceScroll({
                cursorcolor: "#BE1A25",
                background: "#EEE",
                cursorborderradius: 10,
                cursorminheight: 5,
                cursoropacitymin: 0,
                cursorwidth: "8px",
                cursorborder: "0px",
                autohidemode: 'leave'
            });
            $(".cart-Added-content").getNiceScroll().resize();
        });

        $(document).ready(function() {
            $("#tab").pagination({
                items: 9,
                contents: 'contents',
                previous: '<i class="fas fa-chevron-left"></i>',
                next: '<i class="fas fa-chevron-right"></i>',
                position: 'bottom',
            });
            $(".codiano-datatable").dataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excelHtml5',
                    'pdfHtml5',
                    'print'
                ],
                "ordering": false,
                "bPaginate": true,
                "bLengthChange": false,
                "bFilter": true,
                "bInfo": true,
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
        });
    </script>

    <script>
        $(function() {
            $(".cart-table").niceScroll({
                cursorcolor: "#05203D",
                background: "#EEE",
                cursorborderradius: 10,
                cursorminheight: 5,
                cursoropacitymin: 0,
                cursorwidth: "8px",
                cursorborder: "0px",
                autohidemode: 'leave'
            });
            $(".cart-table").getNiceScroll().resize();
        });
    </script>

{{--    <script type="text/javascript">--}}
{{--        $(document).ready(function() {--}}
{{--            let sliderEl3 = document.querySelector('.third [data-rangeslider]')--}}
{{--            sliderEl3.addEventListener('input', (ev) => {--}}
{{--                document.querySelector('.third .output').innerHTML = ev.target.value--}}
{{--            })--}}
{{--            rangesliderJs.create(sliderEl3, {--}}
{{--                min: 0,--}}
{{--                max: 500--}}
{{--            }, {--}}
{{--                onSlide: function() {--}}
{{--                    console.log(this)--}}
{{--                }--}}
{{--            })--}}
{{--        });--}}
{{--    </script>--}}

    <script>
        $(document).ready(function() {

            $('.RLogin').on('submit', function(e) {
                e.preventDefault()
                const form = new FormData($(this)[0]);
                const $this = $(this);
                if($(this).find('input[name="image"]').val() != null)
                {
                    if($(this).find('input[name="image"]')[0].files[0] != null)
                    {
                        form.append('image', $(this).find('input[name="image"]')[0].files[0])
                    }
                }
                axios.post($this.attr('action'), form, {
                    headers: {
                        'apiLang': 'en',
                        'Accept': 'application/json',
                        @auth
                        "Authorization":"Bearer {{auth()->user()->generateAuthToken()??''}}"
                        @endauth
                    }
                }).then(response => {
                    if (response.status == 200){
                        $(this).find('.register-errors').addClass('d-none')
                        $(this).find('.register-errors').html('');
                        const errorHolder = $(this).find('.register-errors');
                        //$('<div />').appendTo(errorHolder).addClass('alert alert-danger p-2').text("Check your email for verify link")
                        window.location.href = '{{asset('/')}}'
                    }

                }).catch(error => {
                    $(this).find('.register-errors').addClass('d-none')
                    $(this).find('.register-errors').html('');
                    const errorHolder = $(this).find('.register-errors');
                    $.each(error.response.data.errors, function(key, filedErrors) {
                        $('<div />').appendTo(errorHolder).addClass('alert alert-danger p-2').text(filedErrors[0])
                    })
                    $('<div />').appendTo(errorHolder).addClass('alert alert-danger p-2').text(error.response.data.message)
                })

            });

            $('.RSend').click(function(e) {
                e.preventDefault()
                const $this = $(this);
                $.ajax({
                    url: $this.attr('action'),
                    type: "get",
                    headers: {
                        'apiLang': 'en',
                        'Accept': 'application/json',
                        'Authorization': '{{$Token}}'
                    },
                    success: function(data) {
                        $('.RLogin').find('.register-errors').addClass('d-none')
                        $('.RLogin').find('.register-errors').html(data.message);
                    }
                });
            });

            $('.Filter').change(function(e) {
                e.preventDefault()
                const $this = $(this);
                $.ajax({
                    url: $this.attr('action'),
                    type: "get",
                    headers: {
                        'apiLang': 'en',
                        'Accept': 'application/json',
                        'Authorization': '{{$Token}}'
                    },
                    data: $('.custom-control-input:checked').serialize(),
                    success: function(data) {
                        $('.ajax_content').html(data);
                    }
                });
            });


        {{--// register form--}}
            {{--$('#sign-up').on('submit', function(e) {--}}
            {{--    e.preventDefault()--}}
            {{--    const form = new FormData();--}}
            {{--    const $this = $(this)--}}

            {{--    console.log('register')--}}

            {{--    form.append('name', $this.find('input[name="name"]').val())--}}
            {{--    form.append('email', $this.find('input[name="email"]').val())--}}
            {{--    form.append('mobile', $this.find('input[name="mobile"]').val())--}}
            {{--    form.append('address', $this.find('input[name="address"]').val())--}}
            {{--    form.append('password', $this.find('input[name="password"]').val())--}}
            {{--    form.append('type', "0")--}}
            {{--    form.append('password_confirmation', $this.find('input[name="password_confirmation"]').val())--}}
            {{--    form.append('photo', $this.find('input[name="image"]')[0].files[0]);--}}

            {{--    $('#register-errors .spinner-border').removeClass('d-none')--}}

            {{--    axios.post('{{asset('api/register')}}', form, {--}}
            {{--        headers: {--}}
            {{--            'apiLang': 'en',--}}
            {{--            'Accept': 'application/json',--}}
            {{--        }--}}
            {{--    })--}}
            {{--        .then(response => {--}}
            {{--            $('#register-errors .spinner-border').addClass('d-none')--}}
            {{--            const errorHolder = $('#register-errors');--}}
            {{--            errorHolder.html('');--}}
            {{--            window.location.href = '{{asset('/')}}'--}}
            {{--        })--}}
            {{--        .catch(error => {--}}
            {{--            $('#register-errors .spinner-border').addClass('d-none')--}}
            {{--            const errorHolder = $('#register-errors');--}}
            {{--            errorHolder.html('')--}}
            {{--            $.each(error.response.data.errors, function(key, filedErrors) {--}}
            {{--                $('<div />').appendTo(errorHolder).addClass('alert alert-danger p-2').text(filedErrors[0])--}}
            {{--            })--}}
            {{--        })--}}
            {{--});--}}

            {{--// forget password--}}
            {{--$('#forget-password').on('submit', function(e) {--}}

            {{--    e.preventDefault()--}}
            {{--    const form = new FormData();--}}
            {{--    const $this = $(this)--}}
            {{--    form.append('email', $this.find('input[name="email"]').val())--}}
            {{--    $('#register-errors .spinner-border').removeClass('d-none')--}}
            {{--    axios.post('{{asset('api/forgetPassword')}}', form, {--}}
            {{--        headers: {--}}
            {{--            'apiLang': 'en',--}}
            {{--            'Accept': 'application/json',--}}
            {{--            'Authorization': '{{$Token}}'--}}
            {{--        }--}}
            {{--    })--}}
            {{--        .then(response => {--}}
            {{--            $('#register-errors .spinner-border').addClass('d-none')--}}
            {{--            console.log(response);--}}
            {{--            const errorHolder = $('#register-errors');--}}
            {{--            errorHolder.html('');--}}
            {{--            $('<div />').appendTo(errorHolder).addClass('alert alert-success p-2').text('Verification code has been sent succesfully')--}}
            {{--        })--}}
            {{--        .catch(error => {--}}
            {{--            $('#register-errors .spinner-border').addClass('d-none')--}}
            {{--            const errorHolder = $('#register-errors');--}}
            {{--            errorHolder.html('')--}}
            {{--            $.each(error.response.data.errors, function(key, filedErrors) {--}}
            {{--                $('<div />').appendTo(errorHolder).addClass('alert alert-danger p-2').text(filedErrors[0])--}}
            {{--            })--}}
            {{--        })--}}

            {{--});--}}

            // reset password
            $('#reset-password').on('submit', function(e) {

                e.preventDefault()

                const form = new FormData();
                const $this = $(this)

                form.append('email', $this.find('input[name="email"]').val())
                form.append('verify_code', $this.find('input[name="verify_code"]').val())
                form.append('password', $this.find('input[name="password"]').val())
                form.append('password_confirmation', $this.find('input[name="password_confirmation"]').val())

                axios.post('{{asset('api/resetPassword')}}', form, {
                    headers: {
                        'apiLang': 'en',
                        'Accept': 'application/json',
                        'Authorization': '{{$Token}}'
                    }
                })
                    .then(response => {
                        // console.log(response);
                        const errorHolder = $('#register-errors');
                        errorHolder.html('');
                        $('<div />').appendTo(errorHolder).addClass('alert alert-success p-2').text('your password has been reset succesfully')
                        location.replace("{{asset('/name-profile')}}");

                    })
                    .catch(error => {
                        const errorHolder = $('#register-errors');
                        errorHolder.html('')
                        $.each(error.response.data.errors, function(key, filedErrors) {
                            $('<div />').appendTo(errorHolder).addClass('alert alert-danger p-2').text(filedErrors[0])
                        })
                    })
            });

            // edit profile
            $('.edit-BTN').on('click', function () {

                if (typeof $('.edit-profile-input').attr('disabled') !== typeof undefined
                    && $('.edit-profile-input').attr('disabled') !== false) {

                    // chnage edit input icon
                    $('.edit-BTN').find('svg').removeClass('fa-pencil-alt').addClass('fa-times-circle')

                    $('.edit-profile-input').removeAttr('disabled').removeClass('border-0')
                        .css({'border': '1px solid var(--red-color)', 'border-radius': "5px",'padding': '3px 5px'});
                    $('#edit-profile button[type="submit"]').removeClass('d-none')

                } else{
                    // chnage edit input icon
                    $('.edit-BTN').find('svg').removeClass('fa-times-circle').addClass('fa-pencil-alt')
                    $('.edit-profile-input').attr('disabled', 'disabled').addClass('border-0')
                }

            });


            $('.edit-profile').on('submit', function (e) {

                e.preventDefault()
                const form = new FormData();
                const $this = $(this)
                form.append('name', $this.find('input[name="name"]').val())
                form.append('email', $this.find('input[name="email"]').val())
                form.append('mobile', $this.find('input[name="mobile"]').val())
                form.append('address', $this.find('input[name="address"]').val())
                form.append('password', $(this).find('input[name="password"]').val())
                form.append('password_confirmation', $(this).find('input[name="password_confirmation"]').val())
               // console.log('test')
                axios.post($this.attr('action'), form, {
                    headers: {
                        'apiLang': 'en',
                        'Accept': 'application/json',
                        'Authorization': '{{$Token}}'
                    }
                })
                    .then(response => {
                       // console.log(response);
                        const errorHolder = $('#register-errors');
                        errorHolder.html('');
                        $('<div />').appendTo(errorHolder).addClass('alert alert-success p-2').text('your new data saved succesfully')
                        window.location.reload();

                    })
                    .catch(error => {
                        const errorHolder = $('#register-errors');
                        errorHolder.html('')
                        $.each(error.response.data.errors, function(key, filedErrors) {
                            $('<div />').appendTo(errorHolder).addClass('alert alert-danger p-2').text(filedErrors[0])
                        })
                    })
            });

           // console.log($('.profile-pic'))
            $('.profile-pic').on('submit', function(e){

                e.preventDefault()
                const form = new FormData();
                const $this = $(this)

                if($(this).find('input[name="image"]')[0].files[0] != null)
                {form.append('image', $(this).find('input[name="image"]')[0].files[0])}

                axios.post('{{asset('api/edit-profile')}}', form, {
                    headers: {
                        'apiLang': 'en',
                        'Accept': 'application/json',
                        'Authorization': '{{$Token}}'
                    }
                })
                    .then(response => {
                      //  console.log(response);
                        window.location.reload();

                    })
                    .catch(error => {
                  //      console.log(error);

                    })


            })
            $('#profile-pic').on('change', function () {

                $('.profile-pic').submit();

            })
            // rating
            $('input[name="rating"]').each(function () {
                $(this).on('change', function () {
                    let id = $(this).attr('id')
                    id = id.replace("rating-","")
                    axios.get($('#rating').attr('action') +"/"+ id)
                        .then(function (response) {
                         //   console.log(response);
                        })
                        .catch(function (error) {
                       //     console.log(error);
                        })
                        .then(function () {
                        //    console.log('last method')
                        });

                })
            })
            //  comment
            $('#comment').on('submit', function (e) {
                $(this).find('button').attr('disabled', 'disabled')
            });
        // change search category
            $('.dropdown-value').on('click',  function(e){
                e.preventDefault()
                $('#dropdownMenuLink2').find('span').text($(this).text())
            })
        // reset filters
            $('#reset-filters').on('click', function(e){

                e.preventDefault()
                $('#accordion input[type=checkbox]').each(function() {
                    var checkboxes = $('#accordion input[type=checkbox]');
                    checkboxes.checked = false;
                    $(":checkbox").prop('checked', false).parent().removeClass('active');
                    $('#accordion input[type=checkbox].all-input').prop('checked', true).parent().addClass('active');
                });

            })
        });
    </script>

@endsection
@yield('js')
