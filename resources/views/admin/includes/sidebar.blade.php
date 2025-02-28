<div class="app-sidebar sidebar-shadow">
    {{-- <button class="toggler d-none"><i class="fas fa-chevron-right"></i></button> --}}
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button"
                    class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="app-sidebar__inner w-100">
        <a href="{{asset('/')}}">
            <img src="{{asset('resources/views/admin/assets/images/logo.svg')}}" class="mb-3 sidebar_img "
                 style="height: 100px;width: 100%">
        </a>
        <!-- <div class="sidebar__heading text-white mb-2 text-center widget-subheading">Dashboard v1</div> -->
        <ul class="vertical-nav-menu">
            <li><a href="{{url('admin/home')}}" {{(\Illuminate\Support\Facades\URL::current()==url('admin/home'))?"class=mm-active":''}}><i class="metismenu-icon fas fa-home"></i> {{trans('admin.home')}} </a></li>
            <li><a href="{{url('admin/delivery')}}" {{(\Illuminate\Support\Facades\URL::current()==url('admin/delivery'))?"class=mm-active":''}}><i class="metismenu-icon fas fa-car"></i> {{trans('admin.categories.delivery')}} </a></li>
            <li><a href="{{url('admin/category')}}" {{(\Illuminate\Support\Facades\URL::current()==url('admin/category'))?"class=mm-active":''}}><i class="metismenu-icon fas fa-suitcase"></i> {{trans('admin.categories.categories')}} </a></li>
            <li><a href="{{url('admin/order')}}" {{(\Illuminate\Support\Facades\URL::current()==url('admin/order'))?"class=mm-active":''}}><i class="metismenu-icon fas fa-digital-tachograph"></i> {{trans('admin.Order')}}  </a></li> 
            <li><a href="{{route('refund-order')}}" {{(\Illuminate\Support\Facades\URL::current()==route('refund-order'))?"class=mm-active":''}}><i class="metismenu-icon fas fa-digital-tachograph"></i> {{trans('admin.refund_orders')}}  </a></li>
            <li><a href="{{url('admin/product')}}" {{(\Illuminate\Support\Facades\URL::current()==url('admin/product'))?"class=mm-active":''}}><i class="metismenu-icon fas fa-cookie-bite"></i> {{trans('admin.product')}}  </a></li>
            <li><a href="{{url('admin/upload-product-view')}}" {{(\Illuminate\Support\Facades\URL::current()==url('admin/upload-product-view'))?"class=mm-active":''}}><i class="metismenu-icon fas fa-cookie-bite"></i> {{trans('admin.product_upload')}}  </a></li>
            <li><a href="{{url('admin/provider')}}" {{(\Illuminate\Support\Facades\URL::current()==url('admin/provider'))?"class=mm-active":''}}><i class="metismenu-icon fas fa-credit-card"></i> {{trans('admin.provider')}} </a></li>
            <li><a href="{{url('admin/setting')}}" {{(\Illuminate\Support\Facades\URL::current()==url('admin/setting'))?"class=mm-active":''}}><i class="metismenu-icon fas fa-sliders-h"></i> {{trans('admin.setting')}} </a></li>
            <li><a href="{{url('admin/test')}}" {{(\Illuminate\Support\Facades\URL::current()==url('admin/test'))?"class=mm-active":''}}><i class="metismenu-icon fas fa-user-alt"></i> {{trans('admin.categories.testimonial')}}  </a></li>
            <li><a href="{{url('admin/contact')}}" {{(\Illuminate\Support\Facades\URL::current()==url('admin/contact'))?"class=mm-active":''}}><i class="metismenu-icon fas fa-envelope"></i> {{trans('admin.contactus')}}  </a></li>
            <li><a href="{{url('admin/subscriber')}}" {{(\Illuminate\Support\Facades\URL::current()==url('admin/subscriber'))?"class=mm-active":''}}><i class="metismenu-icon fas fa-subscript"></i> {{trans('admin.subscriber')}}  </a></li>
            <li><a href="{{url('admin/report')}}" {{(\Illuminate\Support\Facades\URL::current()==url('admin/report'))?"class=mm-active":''}}><i class="metismenu-icon fas fa-file-export"></i> {{trans('admin.report')}}  </a></li>
        {{--<li><a href="{{url('admin/promo')}}" {{(\Illuminate\Support\Facades\URL::current()==url('admin/promo'))?"class=mm-active":''}}><i class="metismenu-icon fas fa-percent"></i> {{trans('admin.promo')}}  </a></li>--}}
            <li><a href="{{url('admin/type')}}" {{(\Illuminate\Support\Facades\URL::current()==url('admin/type'))?"class=mm-active":''}}><i class="metismenu-icon fas fa-cubes"></i> {{trans('admin.type')}}  </a></li>

        </ul>
    </div>
</div>
