$(document).ready(function() {
    // Fixed Header
    $(window).on("scroll", function() {
        if ($(window).scrollTop() > $(".navbar").innerHeight()) {
            $(".navbar").addClass('fixed-top');
        } else {
            $(".navbar").removeClass('fixed-top');
        }
    });

    $(".btn-scroll-top").on("click", function() {
        $("html, body").animate({
            scrollTop: 0
        }, 1500)
    })

    // Collapse And Expand
    $(".btn-collapse").on("click", function() {
        let arrCollapse = $(this).find('.arrow-collapse');
        if (arrCollapse.hasClass('fa-minus') && $(this).hasClass('collapsed')) {
            $('.arrow-collapse').not(arrCollapse).removeClass('fa-plus').addClass('fa-minus');
            arrCollapse.removeClass('fa-minus').addClass('fa-plus');
            console.log('up');
        } else if (arrCollapse.hasClass('fa-plus') && $(this).hasClass('collapsed')) {
            $('.arrow-collapse').not(arrCollapse).removeClass('fa-minus').addClass('fa-plus');
            arrCollapse.removeClass('fa-plus').addClass('fa-minus');
            console.log('Down');
        } else {
            if (arrCollapse.hasClass('fa-minus')) {
                arrCollapse.removeClass('fa-minus').addClass('fa-plus');
            }
        }
    });

    // Tabs Of The Profile
    $(".profile-tabs .tab-items").on('click', function() {
        $("#myorder_content,#favoritelist_content,#editaccount_content").hide();
        $(this).addClass('active').siblings().removeClass('active');
        $("#" + $(this).data('tabing')).fadeIn('fast');
    });

    $(".btn-list").on('click', function() {
        if ($(".grid-layout").find('.col-md-4')) {
            $('.grid-layout').find('.col-md-4').removeClass('col-md-4').addClass('col-md-12');
            $(".grid-content").addClass('d-flex');
            $(".grid-content").find('.c-ele').removeClass('text-center');
        }
    });

    $(".btn-grid").on('click', function() {
        if ($(".grid-layout").find('.col-md-12')) {
            $('.grid-layout').find('.col-md-12').removeClass('col-md-12').addClass('col-md-4');
            $(".grid-content").removeClass('d-flex');
            $(".grid-content").find('.c-ele').addClass('text-center');
        }
    });


    let hasCheckedInput = true;
    let Checkd_there = [];
    $(".filter-input").on("input", function()
    {
        if ($(this).data('inputfilter') === 'all')
        {
            if ($(this).is(":checked"))
            {
                $(".filter-result").show();
                hasCheckedInput = true;
                $(".filter-input").prop('checked', false);
                $(".all-input").prop('checked', true);
            }
            else
            {
                $(".filter-result").hide();
                hasCheckedInput = false;
            }

        }
        else
        {
            if (hasCheckedInput)
            {
                $(".filter-result").hide();
                hasCheckedInput = false;
                $(".all-input").prop('checked', false);
            }

            if ($(this).is(":checked"))
            {
                Checkd_there.push($(this).data('inputfilter'));
                $("." + $(this).data('inputfilter')).show();

            }
            else
            {
                Checkd_there.splice( $.inArray($(this).data('inputfilter'), Checkd_there), 1 );
                $("." + $(this).data('inputfilter')).hide();

                $.each(Checkd_there, function(index, value) {
                    console.log(value);
                    $("." + value).show();
                });

            }
        }
    });




    // Show Pop And Hide
    $(window).on('load', function() {
        setTimeout(function() {
            if ($('body').hasClass('body-hidden-scroll')) {
                $('.pop-wrapper').fadeIn();
            } else {
                $('.pop-wrapper').fadeOut();
            }
        }, 1000)
    })

    $(document).on("mouseup", function(event) {
        let myPopAdv   = $('.pop-wrapper');
        let myCartDrop = $(".dropdown-cart");
        let signingPop = $(".sign-login");
        let successmsg = $(".alert-successfuly-message");
        let mainInput  = $(".main-input");
        if (signingPop.is(event.target) && signingPop.has(event.target).length === 0) {
            signingPop.hide();
            $("body").removeClass('body-hidden-scroll');
        }
        if (successmsg.is(event.target) && successmsg.has(event.target).length === 0) {
            successmsg.hide();
            $("body").removeClass('body-hidden-scroll');
        }
        if (myPopAdv.is(event.target) && myPopAdv.has(event.target).length === 0) {
            myPopAdv.hide();
            $("body").removeClass('body-hidden-scroll');
        } else if (!myCartDrop.is(event.target) && myCartDrop.has(event.target).length === 0) {
            myCartDrop.hide();
        } else if (!mainInput.is(event.target) && mainInput.has(event.target).length === 0) {
            mainInput.slideUp("fast");
        }
    })

    $(".pop-close").on('click', function() {
        $('.pop-wrapper').hide();
        $("body").removeClass('body-hidden-scroll');
    });

    $(".nosee-again").on("input", function() {


    })

    $(document).on("keydown", function(e) {
        if (e.keyCode === 27) {
            $('.pop-wrapper').hide();
            $(".pop-wrapper-sign").hide();
            $("body").removeClass('body-hidden-scroll');
        }
    })

    $(".dropdown-value").on("click", function(e) {
        e.preventDefault();
        let meValue   = $(this).text();
        let intoValue = $("." + $(this).data("v"));
        intoValue.text(meValue);
    })


    $(".edit-BTN").on('click', function() {
        $("." + $(this).data("edit")).fadeIn("fast");
        $("body").addClass('body-hidden-scroll');
    });

    $(".btn-sign").on('click', function() {
        $('.pop-wrapper-sign').fadeIn();
        $("body").addClass('body-hidden-scroll');
        $("#sign-in-box").hide();
        $("#sign-up-box").show();
        $(".sign-up-box-btn").last().addClass("active").siblings().removeClass("active");
    });

    $(".btn-login").on('click', function() {
        $('.pop-wrapper-sign').fadeIn();
        $("body").addClass('body-hidden-scroll');
        $("#sign-in-box").show();
        $("#sign-up-box").hide();
        $(".sign-in-box-btn").first().addClass("active").siblings().removeClass("active");
    });

    $(".forget_pass").on('click', function() {
        $('.pop-wrapper-sign').fadeIn();
        $("body").addClass('body-hidden-scroll');
        $("#sign-in-box").hide();
        $("#sign-up-box").hide();
        $("#forget_password-box").show();
    });

    $(".sign-btn").on("click", function() {
        $(".sign-form").hide();
        $(this).addClass('active').siblings().removeClass('active');
        $("#" + $(this).data('signing')).fadeIn("fast");
    })

    // Show And Hide Password
    $(".showpsw").on('click', function() {
        $(this).toggleClass('showed');
        if ($(this).hasClass('showed')) {
            $(this).find('.fa-eye-slash').removeClass('fa-eye-slash').addClass('fa-eye');
            $("." + $(this).data('chpsw')).attr('type', 'text');
        } else {
            $(this).find('.fa-eye').removeClass('fa-eye').addClass('fa-eye-slash');
            $("." + $(this).data('chpsw')).attr('type', 'password');
        }
    });

    $(".btn-successmsg").on("click", function() {
        $("." + $(this).data('open')).fadeIn();
        $("." + $(this).data('close')).hide();
        $('body').addClass("body-hidden-scroll");
        $("input").val('');
    })


    $(".rate-box").on("click", function() {
        $(this).toggleClass('filled');
        if ($(this).hasClass("filled")) {
            $(this).find(".fa-star").removeClass("far").addClass("fas");
        } else {
            $(this).find(".fa-star").removeClass("fas").addClass("far");
        }
    });

    $(".like-box").on("click", function() {
        let likeCount = $("." + $(this).data('liking')).text();

        $(this).toggleClass("filled");
        if ($(this).hasClass('filled'))
        {
            $(this).find('.fa-thumbs-up').removeClass("far").addClass("fas");
            likeCount = "" + (parseInt(likeCount) + 1);
            $("." + $(this).data('liking')).text(likeCount);
        }
        else
        {
            $(this).find('.fa-thumbs-up').removeClass("fas").addClass("far");
            likeCount = "" + (parseInt(likeCount) - 1);
            $("." + $(this).data('liking')).text(likeCount);
        }

        axios.get($(this).attr('action'))
            .then(function (response) {
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            })
            .then(function () {
                console.log('last method')
            });
    });


    // Add To Cart
    // Add To Cart And Save In the array
    var myProducts = [];
    var cartAdded = 0;
    var cardValue = $(".cart-result");
    var addCartBtn = $(".btn-added-cart");
    addCartBtn.each(function() {
        $(this).on("click", function() {
            cartAdded++;
            myProducts.push(cartAdded);
            cardValue.text(cartAdded);
            console.log(myProducts);

            $.ajax({
                url:'cart-content',
                type:'GET',
                success: function(data){
                    $('.dropdown-cart .cart-added-in').html(data);
                    console.log($(data).find(".cart-content").val());
                    console.log(data);
                }
            });
        });
    });

    $(".add-modal").on("click", function() {
        $.ajax({
            url:'dropdown-content',
            type:'GET',
            success: function(data){
                $('.sauce-boxes').append(data);
            }
        });
    });

    $(".delete-cart").on("click", function() {
        console.log("Welcome");
        $(this).parent().parent().fadeOut('fast');
    })


    $(".link-cart").on("click", function() {
        $(this).toggleClass("cart-opened");
        if ($(this).hasClass("cart-opened")) {
            $("." + $(this).data("cart")).show();
        } else {
            $("." + $(this).data("cart")).hide();
        }
    });


    var quntyAdded = 0;
    var addCartBtn = $(".btn-plus");
    var minusCartBtn = $(".btn-minus");
    var deleteProduct = $(".delete-product");
    addCartBtn.each(function() {
        $(this).on("click", function() {
            quntyAdded++;
            $("." + $(this).data("plus")).text(quntyAdded);
        });
    });

    minusCartBtn.each(function() {
        $(this).on("click", function() {
            if(quntyAdded > 1)
            {
                quntyAdded--;
                $("." + $(this).data("minus")).text(parseInt(quntyAdded));

            }
        });
    });

    deleteProduct.each(function() {
        $(this).on("click", function() {
            let trEle = $(this).parent().parent('tr');
            trEle.remove();
        });
    });

    $(".search-area .main-input").on("input", function() {
        let inVal = $(this).val();
        let searchValue = $(".search_wrapper .the-result-input");
        searchValue.text(inVal);
        $(".result-input-banner").slideDown("fast");
        searchValue.text(inVal);
    });
    $(".search-area .main-input").on("blur", function() {
        $(".result-input-banner").slideUp("fast");
    });

    $(".input-search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".eboro-box").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    })


    $("#input-range").on("change", function() {
        let value  = parseFloat($(this).val());
        $(".eboro-box").filter(function() {
            if (value < parseFloat($(this).find(".result-searching").text()) && value > 1)
            {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            }
            else
            {
                $(this).show($(this).text().toLowerCase().indexOf(value) > -1);
            }
        });
    });


});


// Icon Navigation
var forEach = function (t, o, r) { if ("[object Object]" === Object.prototype.toString.call(t)) for (var c in t) Object.prototype.hasOwnProperty.call(t, c) && o.call(r, t[c], c, t); else for (var e = 0, l = t.length; l > e; e++)o.call(r, t[e], e, t) };

var hamburgers = document.querySelectorAll(".hamburger");
if (hamburgers.length > 0) {
    forEach(hamburgers, function (hamburger) {
        hamburger.addEventListener("click", function () {
            this.classList.toggle("is-active");
        }, false);
    });
}
