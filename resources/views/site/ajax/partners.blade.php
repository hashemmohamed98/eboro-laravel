@foreach($Providers as $Provider)
    <div class="filter-result col-md-4 {{$Provider->category->{'name_'.session('lang')} }}">
        <div class="card card-box-shadow border-0 border-radius-20 p-4 h-100">
            <div class="grid-content">
                <div class="mr-3">
                    <img src="{{asset('/public/uploads/Provider/'.$Provider->logo)}}" class="card-img" alt="">
                </div>
                <div>
                    <h4 class="c-ele red-color text-center font-size-18 bold mt-2">{{$Provider->description}}</h4>
                    {{--                                            <div class="c-ele text-muted text-center mb-2">{{$Provider->category->{'name_'.session('lang')} }}</div>--}}
                    <div class="c-ele text-muted text-center mb-2">{{$Provider->{'type_'.session('lang')} }}</div>
                    <p class="m-0 font-size-15">{{$Provider->description}}</p>
                </div>
            </div>
            <div class="card-line text-center my-3 mt-auto">
                <div class="card-poly">
                    <img src="{{asset('public/uploads/Provider/'.$Provider->logo)}}" alt="">
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <div>{{$Provider->branch()->count()}} {{trans('public.branch')}}</div>
                <a href="{{asset('/Provider/'.$Provider->id.'/'.$Provider->name)}}" class="btn red-bg text-white btn-sm btn-added-cart">{{trans('public.view')}}</a>
            </div>
        </div>
    </div>
@endforeach
