<script src="http://code.jquery.com/jquery-3.1.1.slim.min.js"></script>

<script src="{{asset('resources/views/admin/assets/scripts/jquery-3.5.1.min.js')}}"> </script>
<script src="{{asset('resources/views/admin/assets/scripts/popper.min.js')}}"></script>
<script src="{{asset('resources/views/admin/assets/scripts/bootstrap.min.js')}}"></script>
<script src="{{asset('resources/views/dashboard/assets/js/dropify.min.js')}}"></script>
<script src="{{asset('resources/views/admin/assets/scripts/jquery.nicescroll.min.js')}}"></script>
<script src="{{asset('resources/views/admin/assets/scripts/main.js')}}"></script>
<script src="{{asset('resources/views/admin/assets/scripts/plugins/tinymce/tinymce.min.js')}}"></script>
<script src="{{asset('resources/views/site/assets/js/datatables.min.js')}}"></script>
<script src="{{asset('resources/views/admin/assets/scripts/jquery.chatbubble.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js"></script>
<script src="{{asset('resources/views/admin/assets/scripts/select2.min.js')}}"></script>

<script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=false&libraries=places&key={{config('app.google_key')}}'></script>
<script type="text/javascript" src='{{ url('public/locationpicker.jquery.js')}}'></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script type="text/javascript" src='{{asset('resources/views/admin/assets/scripts/jquery-ui.js')}}'></script>

<script>

    //menu button
    if ($(window).width() < 960) {
        $('.app-sidebar').addClass('hide-sidebar')
        $('.mobile-toggle-nav').on('click', function () {
            $('.app-sidebar').toggleClass('hide-sidebar');
        })
    }

    // hints
    $(document).ready(function(){
        $('.fa-edit').attr('title', '{{trans('admin.categories.edit')}}')
        $('.fa-eye').attr('title', '{{trans('admin.categories.view')}}')
        $('.fa-cart-plus').attr('title', '{{trans('admin.categories.addToCart')}}')
        $('.fa-trash-alt').attr('title', '{{trans('admin.categories.delete')}}')
        $('.fa-trash').attr('title', '{{trans('admin.categories.delete')}}')
        $('.fa-reply').attr('title', '{{trans('admin.reply')}}')
        $('.fa-unlock').attr('title', '{{trans('admin.lock')}}')
        $('.fa-lock').attr('title', '{{trans('admin.unlock')}}')
        $('.fa-h-square').attr('title', '{{trans('admin.branches')}}')
        $('.fa-comment-alt').attr('title', '{{trans('admin.client_chat')}}')
        $('.fa-comment-slash').attr('title', '{{trans('admin.delivery_chat')}}')
        $('.remove_time').attr('title', '{{trans('admin.remove_time')}}')
        $('.plus_time').attr('title', '{{trans('admin.plus_time')}}')
        // export buttons  plus_time
        $('.fa-file-excel').attr('title', '{{trans('admin.categories.excel')}}')
        $('.fa-file-pdf').attr('title', '{{trans('admin.categories.pdf')}}')
        $('.fa-print').attr('title', '{{trans('admin.categories.print')}}')

    });

    setTimeout(function () {
        $('.removeFast').hide()},5000);

    $(document).ready(function() {
        $('.upload-image').dropify();
    });

    $(document).ready(function() {
        $('.select-two').select2().on("select2:select", function (evt) {
            var id = evt.params.data.id;

            var element = $(this).children("option[value="+id+"]");

            moveElementToEndOfParent(element);

            $(this).trigger("change");
        });
        var ele=$(".select-two").parent().find("ul.select2-selection__rendered");
        ele.sortable({
            containment: 'parent',
            update: function() {
                orderSortedValues();
                // console.log(""+$(".select-two").val())
            }
        });

        orderSortedValues = function() {
            var value = ''
            $(".select-two").parent().find("ul.select2-selection__rendered").children("li[title]").each(function(i, obj){

                var element = $(".select-two").children('option').filter(function () { return $(this).html() == obj.title });
                moveElementToEndOfParent(element)
            });
        };

        moveElementToEndOfParent = function(element) {
            var parent = element.parent();

            element.detach();

            parent.append(element);
        };

        // $('.select-two').select2();
    });

    $(".app-sidebar").niceScroll({
        cursorcolor: "rgba(255, 255, 255, 0.45)",
        background:"rgb(13, 187, 90)",
        cursorborderradius:10,
        cursorminheight: 5,
        cursoropacitymin: 0,
        cursorwidth: "8px",
        cursorborder: "0px",
        autohidemode:'leave',
        zindex: "10"
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




    // delete product
    $('.delete').on('submit', function(e) {

        e.preventDefault();
        //loading
        const $this = $(this).closest('form');

        axios.get($this.attr('action'), {
            headers: {
                'apiLang': 'en',
                'Accept': 'application/json',
                'Authorization': "Bearer {{auth()->user()->generateAuthToken()??''}}"
            }
        }).then(response => {
            console.log('deleted')
            window.location.reload(3000)
        }).catch(error => {
            //end-loading
        })
    });

    $('#us2').locationpicker({
        location: {
            latitude: '{{ 45.491606226544 }}',
            longitude: '{{ 9.191102575671376 }}',
        },
        radius: 300,
        markerIcon: '{{ url('public/map-marker-2-xl.png')}}',
        inputBinding: {
            latitudeInput: $('#lat2'),
            longitudeInput: $('#lng2'),
            locationNameInput: $('#address2')
        },
        enableAutocomplete: true,
    });

    $(".plus_time").on("click", function() {
        let e =  "<div class='row Times_content'>" +
            "                                <div class='form-group col-md-3'>" +
            "                                    <label for=''>{{trans('dashboard.beverages.open_days')}} *</label>" +
            "                                    <select name='open_days[]' class='form-control border-radius-5' required>" +
            "                                        <option value=''>Select Day</option>" +
            "                                        <option value='Monday'>{{trans('admin.Monday')}}</option>" +
            "                                        <option value='Tuesday'>{{trans('admin.Tuesday')}}</option>" +
            "                                        <option value='Wednesday'>{{trans('admin.Wednesday')}}</option>" +
            "                                        <option value='Thursday'>{{trans('admin.Thursday')}}</option>" +
            "                                        <option value='Friday'>{{trans('admin.Friday')}}</option>" +
            "                                        <option value='Saturday'>{{trans('admin.Saturday')}}</option>" +
            "                                        <option value='Sunday'>{{trans('admin.Sunday')}}</option>" +
            "                                    </select>" +
            "                                </div>" +
            "                                <div class='form-group col-md-4'>" +
            "                                    <label for=''>{{trans('dashboard.branch.open_time')}} *</label>" +
            "                                    <div class='input-group'>" +
            "                                        <input type='time' name='open_time[]' class='form-control border-radius-5' placeholder='4:30' required>" +
            "                                    </div>" +
            "                                </div>" +
            "                                <div class='form-group col-md-4'>" +
            "                                    <label for=''>{{trans('dashboard.branch.close_time')}}*</label>" +
            "                                    <div class='input-group'>" +
            "                                        <input type='time' name='close_time[]' class='form-control border-radius-5' placeholder='4:30' required>" +
            "                                    </div>" +
            "                                </div>" +
            "                                <div class='form-group col-md-1'>" +
            "                                    <label for=''>Remove*</label>" +
            "                                    <div class='input-group'>" +
            "                                        <button type='button' class='btn btn-danger remove_time'><i class='fas fa-minus-circle text-white'></i></button>" +
            "                                    </div>" +
            "                                </div>" +
            "                            </div>";
        $(this).parent().parent().parent().parent().append(e);

    })
    $("body").delegate(".remove_time", "click", function(){
        $(this).parent().parent().parent().fadeOut(300);
        $(this).parent().parent().parent().remove();
    });

    // add product
    $('.Add-Product').on('submit', function(e) {

        e.preventDefault()
        const form = new FormData($(this)[0]);
        const $this = $(this);

        if($(this).find('input[name="has_pig"]').val() != null)
        {
            if($(this).find('input[name="has_pig"]').is(":checked"))
            {
                form.append('has_pig', '1')
            }
            else
            {
                form.append('has_pig', '0')
            }
        }

        if($(this).find('input[name="has_alcohol"]').val() != null)
        {
            if($(this).find('input[name="has_alcohol"]').is(":checked"))
            {
                form.append('has_alcohol', '1')
            }
            else
            {
                form.append('has_alcohol', '0')
            }
        }

        if($(this).find('input[name="image"]').val() != null)
        {
            if($(this).find('input[name="image"]')[0].files[0] != null)
            {
                form.append('image', $(this).find('input[name="image"]')[0].files[0])
            }
        }
        if($(this).find('input[name="front_id_image"]').val() != null)
        {
            if($(this).find('input[name="front_id_image"]')[0].files[0] != null)
            {
                form.append('front_id_image', $(this).find('input[name="front_id_image"]')[0].files[0])
            }
        }
        if($(this).find('input[name="back_id_image"]').val() != null)
        {
            if($(this).find('input[name="back_id_image"]')[0].files[0] != null)
            {
                form.append('back_id_image', $(this).find('input[name="back_id_image"]')[0].files[0])
            }
        }
        if($(this).find('input[name="license_image"]').val() != null)
        {
            if($(this).find('input[name="license_image"]')[0].files[0] != null)
            {
                form.append('license_image', $(this).find('input[name="license_image"]')[0].files[0])
            }
        }
        if($(this).find('input[name="license_expire"]').val() != null)
        {
            if($(this).find('input[name="license_expire"]')[0].files[0] != null)
            {
                form.append('license_expire', $(this).find('input[name="license_expire"]')[0].files[0])
            }
        }
        axios.post($this.attr('action'), form,{
            headers: {
                'apiLang': 'en',
                'Accept': 'application/json',
                'Authorization': 'Bearer {{auth()->user()->generateAuthToken()??''}}'
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

    $('.add_Admin').on('submit', function(e) {
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
        axios.post($this.attr('action'), form,{
            headers: {
                'apiLang': 'en',
                'Accept': 'application/json',
                'Authorization': 'Bearer {{auth()->user()->generateAuthToken()??''}}'
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

    $('.add_Category').on('submit', function(e) {
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
        if($(this).find('input[name="logo"]').val() != null)
        {
            if($(this).find('input[name="logo"]')[0].files[0] != null)
            {
                form.append('logo', $(this).find('input[name="logo"]')[0].files[0])
            }
        }

        if($(this).find('input[name="delivery"]').val() != null)
        {
            if($(this).find('input[name="delivery"]').is(":checked"))
            {
                form.append('delivery', '1')
            }
            else
            {
                form.append('delivery', '0')
            }
        }


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

    $('.add_chat').on('submit', function(e) {
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

        axios.post($this.attr('action'), form,{
            headers: {
                'apiLang': 'en',
                'Accept': 'application/json',
                'Authorization': "Bearer {{auth()->user()->generateAuthToken()??''}}"
            }
        }).then(response => {
            $(this).find('input[name="text"]').val('');
            (async () => {
                request($(this).find('input[name="order_id"]').val());
                await setInterval(function(){
                    request($(this).find('input[name="order_id"]').val());
                }, 5000);
            })()
        }).catch(error => {

        })
    });

    $('.add_chat_delivery').on('submit', function(e) {
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

        axios.post($this.attr('action'), form,{
            headers: {
                'apiLang': 'en',
                'Accept': 'application/json',
                'Authorization': "Bearer {{auth()->user()->generateAuthToken()??''}}"
            }
        }).then(response => {
            $(this).find('input[name="text"]').val('');
            (async () => {
                request_delivery($(this).find('input[name="order_id"]').val());
                await setInterval(function(){
                    request_delivery($(this).find('input[name="order_id"]').val());
                }, 5000);
            })()
        }).catch(error => {

        })
    });

    let content;
    let New;
    let current_id;

    $('.open_chat').on('click', function(e)
    {
        $('.chat-'+current_id +' .vals_eboro').animate({scrollTop: 1000000});
        $(this).removeClass("text-danger").addClass('text-primary');
        current_id = $(this).data("id");
        (async () => {
            request($(this).data("id"));
            await setInterval(function(){
                request($(this).data("id"));
            }, 5000);
        })();
    });

    function request(id)
    {
        axios({
            method: 'get',
            url: '{{asset('admin/update_orders_chat/')}}'+'/'+current_id,
        }).then(function (response)
        {
            New = Object.keys(response.data.data).length;
            if(content != New)
            {
                let myArray = [];
                let myArrayID = [];
                let myArraytime = [];
                response.data.data.filter(item=>item.hasOwnProperty('id'))
                    .map((item, i) => myArray.push(item.text));

                response.data.data.filter(item=>item.hasOwnProperty('id'))
                    .map((item, i) => myArrayID.push(item.user_id));

                response.data.data.filter(item=>item.hasOwnProperty('id'))
                    .map((item, i) => myArraytime.push(item.updated_at));

                {{--$('.chat-'+current_id +' .vals_eboro').chatBubble({--}}
                {{--    messages: myArray,--}}
                {{--    ID: myArrayID,--}}
                {{--    time: myArraytime,--}}
                {{--    Master: {{auth()->user()->id}},--}}
                {{--    typingSpeed: 10000--}}
                {{--});--}}

                let $listItem = $('<li></li>');
                let $bubble = $('<div class="bubble typing">...</div>');
                $('.chat-'+current_id +' .vals_eboro').addClass('cb__list');
                for(let i = 0 ; i <myArray.length;i++)
                {
                    if(myArrayID[i] == {{auth()->user()->id}})
                        $bubble = $('<div class="bubble text text-l typing a">...</div>');
                    else
                        $bubble = $('<div class="bubble text text-r typing b">...</div>');

                    $listItem.html($bubble);
                    $('.chat-'+current_id +' .vals_eboro').animate({scrollTop: 1000000});
                    $('.chat-'+current_id +' .vals_eboro').append($listItem);
                    $bubble.html(' <p>'+myArray[i]+'</p><p><small>'+myArraytime[i]+'</small></p>').removeClass('typing');
                }

                content = Object.keys(response.data.data).length;
            }
            if(id != undefined)
                current_id = id;
        });
    }

    let content_delivery;
    let New_delivery;
    let current_id_delivery;

    $('.open_chat_delivery').on('click', function(e)
    {
        $('.chat_delivery-'+current_id_delivery +' .vals_eboro').animate({scrollTop: 1000000});
        $(this).removeClass("text-danger").addClass('text-primary');
        current_id_delivery = $(this).data("id");
        (async () => {
            request_delivery($(this).data("id"));
            await setInterval(function(){
                request_delivery($(this).data("id"));
            }, 5000);
        })();
    });

    function request_delivery(id)
    {
        axios({
            method: 'get',
            url: '{{asset('admin/update_orders_chat/delivery')}}'+'/'+current_id_delivery,
        }).then(function (response)
        {
            New_delivery = Object.keys(response.data.data).length;
            if(content_delivery != New_delivery)
            {
                let myArray_delivery = [];
                let myArrayID_delivery = [];
                let myArraytime_delivery = [];
                response.data.data.filter(item=>item.hasOwnProperty('id'))
                    .map((item, i) => myArray_delivery.push(item.text));

                response.data.data.filter(item=>item.hasOwnProperty('id'))
                    .map((item, i) => myArrayID_delivery.push(item.user_id));

                response.data.data.filter(item=>item.hasOwnProperty('id'))
                    .map((item, i) => myArraytime_delivery.push(item.updated_at));

                {{--$('.chat-'+current_id +' .vals_eboro').chatBubble({--}}
                {{--    messages: myArray,--}}
                {{--    ID: myArrayID,--}}
                {{--    time: myArraytime,--}}
                {{--    Master: {{auth()->user()->id}},--}}
                {{--    typingSpeed: 10000--}}
                {{--});--}}

                let $listItem_delivery = $('<li></li>');
                let $bubble_delivery = $('<div class="bubble typing">...</div>');
                $('.chat_delivery-'+current_id_delivery +' .vals_eboro').addClass('cb__list');
                for(let i = 0 ; i <myArray_delivery.length;i++)
                {
                    if(myArrayID_delivery[i] == {{auth()->user()->id}})
                        $bubble_delivery  = $('<div class="bubble text text-l typing a">...</div>');
                    else
                        $bubble_delivery  = $('<div class="bubble text text-r typing b">...</div>');

                    $listItem_delivery.html($bubble_delivery);
                    $('.chat_delivery-'+current_id_delivery +' .vals_eboro').animate({scrollTop: 1000000});
                    $('.chat_delivery-'+current_id_delivery +' .vals_eboro').append($listItem_delivery);
                    $bubble_delivery.html(' <p>'+myArray_delivery[i]+'</p><p><small>'+myArraytime_delivery[i]+'</small></p>').removeClass('typing');
                }

                content_delivery = Object.keys(response.data.data).length;
            }
            if(id != undefined)
                current_id_delivery = id;
        });
    }



    $(".out_of_stock").change(function() {
        $(this).closest("form").find('.has_outofstock_box').toggle();

        if ($(this).closest("form").find('.out_of_stock').is(":checked"))
        {
            $(this).closest("form").find('.start_outofstock_input').attr('type', 'datetime-local');
            $(this).closest("form").find('.end_outofstock_input').attr('type', 'datetime-local');
        }
        else
        {
            $(this).closest("form").find('.start_outofstock_input').attr('type', 'hidden').val("0000-00-00T00:00");
            $(this).closest("form").find('.end_outofstock_input').attr('type', 'hidden').val("0000-00-00T00:00");
        }
    });

    $('#edit_product').on('submit', function (e) {

        e.preventDefault();

        const form = new FormData();
        const $this = $(this);

        form.append('name', $(this).find('input[name="name"]').val())
        form.append('price', $(this).find('input[name="price"]').val())
        form.append('type', $(this).find('input[name="type"]').val())
        form.append('way', $(this).find('input[name="way"]').val())
        form.append('steps', $(this).find('input[name="steps"]').val())
        form.append('size', $(this).find('input[name="size"]').val())
        form.append('calories', $(this).find('input[name="calories"]').val())
        form.append('additions', $(this).find('input[name="additions"]').val())
        form.append('description', $(this).find('input[name="description"]').val())
        form.append('product_type', $(this).find('select[name="product_type"]').val())
        form.append('branch_id', $(this).find('select[name="branch_id"]').val())
        form.append('image', $(this).find('input[name="image"]')[0].files[0])

        $('#message .spinner-border').removeClass('d-none')

        axios.post($this.attr('action'), form,{
            headers: {
                'apiLang': 'en',
                'Accept': 'application/json',
                'Authorization': "Bearer {{auth()->user()->generateAuthToken()??''}}"
            }
        }).then(response => {
            $('#message .spinner-border').addClass('d-none')
            if (response.status == 200) {
                const message = $('#message')
                message.html('')
                $('<div />').appendTo(message).addClass('alert alert-success p-2').text('Your data has been added succefully')
            }
            setTimeout(window.location.reload(), 5000)
        }).catch(error => {
            $('#message .spinner-border').addClass('d-none')
            const message = $('#message .modal-body')
            message.html('')
            $.each(error.response.data.errors, function(key, filedErrors) {
                $('<div />').appendTo(message).addClass('alert alert-danger p-2').text(filedErrors[0])
            })
        })
    });

    $('.add-branch').on('submit', function(e) {
        e.preventDefault()
        const form = new FormData();
        const $this = $(this);
        form.append('name', $(this).find('input[name="name"]').val())
        form.append('address', $(this).find('input[name="address"]').val())
        form.append('lat', $(this).find('input[name="lat"]').val())
        form.append('long', $(this).find('input[name="long"]').val())
        form.append('hot_line', $(this).find('input[name="hot_line"]').val())
        form.append('open_time', $(this).find('input[name="open_time"]').val())
        form.append('close_time', $(this).find('input[name="close_time"]').val())
        form.append('open_days', $(this).find('input[name="open_days"]').val())
        form.append('description', $(this).find('textarea[name="description"]').val())
        form.append('status', $(this).find('select[name="status"]').val())
        form.append('provider_id', $(this).find('select[name="provider_id"]').val())

        $('#message .spinner-border').removeClass('d-none')
        axios.post($this.attr('action'), form,{
            headers: {
                'apiLang': 'en',
                'Accept': 'application/json',
                'Authorization': "Bearer {{auth()->user()->generateAuthToken()??''}}"
            }
        }).then(response => {
            $('#message .spinner-border').addClass('d-none')
            if (response.status == 200) {
                const message = $('#message')
                message.html('')
                $('<div />').appendTo(message).addClass('alert alert-success p-2').text('Your data has been added succefully')
            }
            setTimeout(window.location.reload(), 5000)
        }).catch(error => {

            const message = $(this).find('#message')
            message.html('')
            $.each(error.response.data.errors, function(key, filedErrors) {
                $('<div />').appendTo(message).addClass('alert alert-danger p-2').text(filedErrors)
            })
        })
    });

    $('.edit-provider').on('submit', function(e) {
        e.preventDefault()
        const form = new FormData();
        const $this = $(this);
        form.append('name', $(this).find('input[name="name"]').val())
        form.append('description', $(this).find('textarea[name="description"]').val())
        form.append('category_id', $(this).find('select[name="category_id"]').val())
        if($(this).find('input[name="logo"]')[0].files[0] != null)
        {form.append('logo', $(this).find('input[name="logo"]')[0].files[0])}

        axios.post($this.attr('action'), form,{
            headers: {
                'apiLang': 'en',
                'Accept': 'application/json',
                'Authorization': "Bearer {{auth()->user()->generateAuthToken()??''}}"
            }
        }).then(response => {
            $('#message .spinner-border').addClass('d-none')
            if (response.status == 200) {
                const message = $('#message')
                message.html('')
                $('<div />').appendTo(message).addClass('alert alert-success p-2').text('Your product has been added succefully')
                window.location.reload(3000)
            }
        }).catch(error => {
            $('#message .spinner-border').addClass('d-none')
            const message = $('#message')
            message.html('')
            $.each(error.response.data.errors, function(key, filedErrors) {
                $('<div />').appendTo(message).addClass('alert alert-danger p-2').text(filedErrors[0])
            })
        }).then(function () {
            $('#message').addClass('d-none')
            window.location.reload()
        })
    });

    $('#OrderEditForm').on('submit', function(e) {
        e.preventDefault()
        const form = new FormData();
        const $this = $(this);
        form.append('order_id', $(this).find('input[name="order_id"]').val())
        form.append('status', $(this).find('select[name="status"]').val())
        form.append('delivery_id', $(this).find('select[name="delivery_id"]').val())
        form.append('cashier_id', $(this).find('select[name="cashier_id"]').val())

        axios.post($this.attr('action'), form,{
            headers: {
                'apiLang': 'en',
                'Accept': 'application/json',
                'Authorization': "Bearer {{auth()->user()->generateAuthToken()??''}}"
            }
        }).then(response => {
            $('#message .spinner-border').addClass('d-none')
            if (response.status == 200) {
                const message = $('#message')
                message.html('')
                $('<div />').appendTo(message).addClass('alert alert-success p-2').text('Your product has been added succefully')
                window.location.reload(3000)
            }
        }).catch(error => {
            $('#message .spinner-border').addClass('d-none')
            const message = $('#message')
            message.html('')
            $.each(error.response.data.errors, function(key, filedErrors) {
                $('<div />').appendTo(message).addClass('alert alert-danger p-2').text(filedErrors[0])
            })
        })
    });

    // tinymce editor
    $(window).on('load', function () {
        tinymce.init({
            selector: '.tinymce-editor',
            height: 200,
            theme: 'modern',
            statusbar: false,
            menubar: true,
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
            ],
            toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
            image_advtab: true,
            paste_data_images: true,
            images_upload_handler: function (blobInfo, success, failure) {
                success("data:" + blobInfo.blob().type + ";base64," + blobInfo.base64());
            },
        });
    });

    // Prevent bootstrap dialog from blocking focusin
    $(document).on('show.bs.modal', '.modal', function (e) {
        if ($(e.target).closest(".mce-window").length || $(e.target).closest(".moxman-window").length) {
            alert('hi');
            e.stopImmediatePropagation();
        }

    });
</script>



