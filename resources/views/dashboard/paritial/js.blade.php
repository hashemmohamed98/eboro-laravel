@section('script')
    <script src="{{asset('resources/views/dashboard/assets/js/jquery.3.4.1.min.js')}}"></script>
    <script src="{{asset('resources/views/dashboard/assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('resources/views/dashboard/assets/js/popper.min.js')}}"></script>
    <script src="{{asset('resources/views/dashboard/assets/js/fontawesome-all.js')}}"></script>
    <script src="{{asset('resources/views/dashboard/assets/js/jquery.nicescroll.min.js')}}"></script>
    <script src="{{asset('resources/views/dashboard/assets/js/dropify.min.js')}}"></script>
    <script src="{{asset('resources/views/dashboard/assets/js/main.js')}}"></script>
    <script src="{{asset('resources/views/dashboard/assets/js/select2.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js"></script>
    <script src="{{asset('js/datatables.min.js')}}"></script>
    <script src="{{asset('resources/views/admin/assets/scripts/select2.min.js')}}"></script>
    <script type="text/javascript" src='{{asset('resources/views/admin/assets/scripts/jquery-ui.js')}}'></script>


    <script>

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


        $(function() {

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

            $(".cart-table").getNiceScroll().resize();
            var loadFile = function(event) {
                var output = document.getElementById('output');
                output.src = URL.createObjectURL(event.target.files[0]);
                output.onload = function() {
                    URL.revokeObjectURL(output.src) // free memory
                }
            };

            $('.select2box').select2();
            $('.upload-image').dropify()
            $('.dropify-message').find("p").text("Add Image")
            $('.upload-video').dropify();


            $(".select-header").on("click", function() {
                $("#" + $(this).data('menu')).slideToggle("fast");
            })


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

            $(".product-items").on("click", function()
            {

                let Product_ID = $(".product-items").attr("Product");
                console.log(Product_ID);
                $("#product"+Product_ID + " .product-imaged").attr('src', $(this).find('.product-img').attr('src'));
                $("#product"+Product_ID + " .product-named").text($(this).find(".product-name").text());
                $("#product"+Product_ID + " .product-named").attr('value', $(this).find('.product-name').attr('value'));
                console.log($("#product"+Product_ID + " .product-imaged").attr('src'));
                $(".product-menus").slideUp("fast");
            })


            // delete product
            $('.delete').on('submit', function(e) {

                e.preventDefault();
                //loading
                const $this = $(this).closest('form');

                axios.get($this.attr('action'), {
                    headers: {
                        'apiLang': 'en',
                        'Accept': 'application/json',
                        'Authorization': '{{$Token}}'
                    }
                }).then(response => {
                    console.log('deleted')
                    window.location.reload(3000)
                }).catch(error => {
                    //end-loading
                })
            });

            // add product
            $('.Add-Product').on('submit', function(e) {

                e.preventDefault()
                const form = new FormData($(this)[0]);
                const $this = $(this);

                if($(this).find('input[name="has_pig"]').is(":checked"))
                    form.append('has_pig', '1');
                else
                    form.append('has_pig', '0');

                if($(this).find('input[name="has_alcohol"]').is(":checked"))
                    form.append('has_alcohol', '1')
                else
                    form.append('has_alcohol', '0')

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
                        'Authorization': '{{$Token}}'
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

            $('.Add-meal').on('submit', function(e) {
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

            $(".add-modal").on("click", function() {
                let item_id = $(".select-header .product-named").attr('value');
                let Product_id = $(".select-header .product-named").attr('Product');

                $.ajax({
                    url:"{{asset('Sauces-content')}}"+ "/"+ Product_id +"/"+ item_id,
                    type:'GET',
                    success: function(data)
                    {
                        $('.sauce-boxes').append(data);

                    }
                });
            });

            $(".notify_btn").on("click", function() {
                $("#" + $(this).data("notify")).slideToggle("fast");
            })

            // add casher
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
                        'Authorization': '{{$Token}}'
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

            // add branch
            $('.add-branch').on('submit', function(e) {
                e.preventDefault()
                const form = new FormData();
                const $this = $(this);
                form.append('name', $(this).find('input[name="name"]').val())
                form.append('address', $(this).find('input[name="address"]').val())
                form.append('lat', $(this).find('input[name="lat"]').val())
                form.append('long', $(this).find('input[name="long"]').val())
                form.append('hot_line', $(this).find('input[name="hot_line"]').val())
                $(this).find('input[name^="open_time[]"]').each(function() {
                    form.append('open_time[]', $(this).val())
                })
                $(this).find('input[name^="close_time[]"]').each(function() {
                    form.append('close_time[]', $(this).val())
                })
                $(this).find('select[name^="open_days[]"]').each(function() {
                    form.append('open_days[]', $(this).val())
                })
                form.append('description', $(this).find('textarea[name="description"]').val())
                form.append('status', $(this).find('select[name="status"]').val())
                form.append('parent', $(this).find('select[name="parent"]').val())
                form.append('provider_id', $(this).find('select[name="provider_id"]').val())
                $('#message .spinner-border').removeClass('d-none')
                axios.post($this.attr('action'), form,{
                    headers: {
                        'apiLang': 'en',
                        'Accept': 'application/json',
                        'Authorization': '{{$Token}}'
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

        });
    </script>
@endsection
