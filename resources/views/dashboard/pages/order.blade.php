@include('dashboard.paritial.include')
    <!DOCTYPE html>
<html>
<head>
@yield('SEO')
<!-- TITLE TAG -->
<title>Eboro-Dashboard</title>
<!-- LINK TAGS -->
@yield('home')
<!-- FONTS TAGS -->
@yield('font')
</head>
<body>
<main id="dashboard">
    <div class="container-fluid py-2">
        <div class="main-wrapper d-flex justify-content-between">
        <!-- Start Navbar -->
        @yield('Nav')
        <!-- End Navbar -->
            <section class="position-relative main-content sm-content">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h2 class="main-color font-bold">{{trans('dashboard.orders.title')}}</h2>
                    <div class="menu-btn">
                        <button class="hamburger hamburger--spin" type="button">
                            <span class="hamburger-box">
                              <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                    <div class="menu-btn-mob">
                        <button class="hamburger hamburger--spin" type="button">
                            <span class="hamburger-box">
                              <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="order-content">
                    <div class="row mb-3">
                        <div class="col-md-12 mb-2 d-flex justify-content-end">
                            <select class="form-control radius" onchange="request()" id="filter_state">
{{--                                    @foreach(\App\Helper\OrderStatus::arr as $item)--}}
{{--                                        <option value="{{$item}}" >{{$item}}</option>--}}
{{--                                    @endforeach--}}
                                <option value="pending">pending</option>
                                <option value="in progress">in progress</option>
                                <option value="to delivering">to delivering</option>
                                <option value="complete">complete</option>
                                <option value="cancelled">cancelled</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive scroll-ele height-300 card-box-shadow border-radius-10 ">
                                <table class="table table-borderless codiano-datatable table-middle table-hover text-center table-font font-size-14 m-0">
                                    <thead class="main-bg text-white">
                                    <tr>
                                        <th>{{trans('dashboard.beverages.id')}}</th>
{{--                                        <th>{{trans('dashboard.beverages.name')}}</th>--}}
{{--                                        <th>mobile</th>--}}
                                        <th>{{trans('dashboard.created_at')}}</th>
                                        <th>{{trans('dashboard.order_at')}}</th>
                                        <th>{{trans('dashboard.beverages.branch')}}</th>
{{--                                        <th>{{trans('admin.portfolio.address')}}</th>--}}
                                        <th>{{trans('dashboard.delivery.delivery_name')}}</th>
{{--                                        <th>{{trans('dashboard.delivery.payment')}}</th>--}}
                                        <th>{{trans('dashboard.delivery.order_status')}}</th>
{{--                                        <th>{{trans('admin.price')}}</th>--}}
                                        <th>{{trans('dashboard.beverages.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody class="content-all">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <!-- Start Footer -->
        @yield('footer')
        <!-- End Footer -->
        </div>
    </div>
    <div id="sound"></div>

</main>
@yield('script')
<script>
    let content;
    let New;
    let play_pause_status;
    function request()
    {
        axios({
            method: 'get',
            url: '{{asset('dashboard/update_orders/'.$name.'?state=')}}'+$('#filter_state').val(),
        }).then(function (response)
        {
            New = response.data;
            if(New.includes("<button class=\"btn btn-success btn-sm width-100\">pending</button>"))
            {
                $('<audio id="chatAudio">'+
                    '<source src="{{asset('resources/views/admin/assets/audio/done2.mp3?1')}}" type="audio/mpeg">'+
                    '</audio>').appendTo('#sound');
                $('#chatAudio')[0].play();
                play_pause_status = "play"
            }
            else if(play_pause_status  == "play")
            {
                $('#chatAudio')[0].pause();
                play_pause_status = "pause";
            }
            if(content != New)
            {
                $('.codiano-datatable').DataTable().destroy();
                $('.modal').modal('hide');
                $('.modal-backdrop').remove();
                $('.content-all').html(response.data);
                content = response.data;
                $('.codiano-datatable').DataTable({
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
                }).draw();


            }


        });
    }
    (async () => {
        request();
        await setInterval(function(){
            request();
        }, 5000);
    })()

    $(document).on('submit', ".request_order" , function(e) {
        e.preventDefault()
        const form = new FormData($(this)[0]);
        const $this = $(this);

        axios.post($this.attr('action'), form,{
            headers: {
                'apiLang': 'en',
                'Accept': 'application/json',
                'Authorization': "Bearer {{auth()->user()->generateAuthToken()??''}}"
            }
        }).then(response => {
            $(this).closest('div').find('#message .spinner-border').addClass('d-none')
            if (response.status == 200) {
                const message = $(this).closest('div').find('#message')
                message.html('')
                $('<div />').appendTo(message).addClass('alert alert-success p-2').text('The process has been completed successfully')
                window.location.reload(3000)
            }
        }).catch(error => {
            $(this).closest('div').find('#message .spinner-border').addClass('d-none')
            const message = $(this).closest('div').find('#message')
            message.html('')
            $.each(error.response.data.errors, function(key, filedErrors) {
                $('<div />').appendTo(message).addClass('alert alert-danger p-2').text(filedErrors[0])
            })
        })
    });

</script>
</body>
</html>
