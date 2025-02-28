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

    <main id="categorygrid">

        <div class="container">
            <div class="mt-5 width-100-per">
                <div class="menu-banner">
                    <div class="menu-box d-flex" style="margin-top: 0;">
                        <div class="dropdown d-flex align-items-center justify-content-center height-60 px-3">
                            <a class="btn btn-white d-flex align-items-center border-radius-0" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="text-menu">{{trans('public.view')}}</span> <img src="svg-icons/grid-menu.svg" class="btn-grid mx-2" style="width:17px" alt=""> <i class="fas fa-list-ul red-color btn-list" style="font-size:20px"></i>
                            </a>
                        </div>
                        <div class="search-area height-60">
                            <i class="fas fa-search search-icon light-grey"></i>
                            <input type="text" class="main-input form-control border-radius-0 height-60 placeholder-gray input-search border-0" autocomplete="off" placeholder="{{trans('public.search.placeholder')}}" name="">
                            <div class="result-input-banner card-box-shadow cart-Added-content" style="display:none;">
                                <a href="#" class="search_wrapper d-flex align-items-center grey-circle-color px-3 py-2">
                                    <div class="imgsearch-wrapper card-box-shadow">
                                        <img src="svg-icons/search-icon.svg" alt="">
                                    </div>
                                    <div class="bold font-size-18">Pizza</div>
                                </a>
                                <a href="#" class="search_wrapper d-flex align-items-center grey-circle-color px-3 py-2">
                                    <div class="imgsearch-wrapper card-box-shadow">
                                        <img src="svg-icons/search-icon.svg" alt="">
                                    </div>
                                    <div class="bold font-size-18">Pizza</div>
                                </a>
                                <a href="#" class="search_wrapper d-flex align-items-center grey-circle-color px-3 py-2">
                                    <div class="imgsearch-wrapper card-box-shadow">
                                        <img src="svg-icons/search-icon.svg" alt="">
                                    </div>
                                    <div class="bold font-size-18">Pizza</div>
                                </a>
                                <a href="#" class="search_wrapper d-flex align-items-center grey-circle-color px-3 py-2">
                                    <div class="imgsearch-wrapper card-box-shadow">
                                        <img src="svg-icons/search-icon.svg" alt="">
                                    </div>
                                    <div class="bold font-size-18">Pizza</div>
                                </a>
                                <a href="#" class="search_wrapper d-flex align-items-center grey-circle-color px-3 py-2">
                                    <div class="imgsearch-wrapper card-box-shadow">
                                        <img src="svg-icons/search-icon.svg" alt="">
                                    </div>
                                    <div class="bold font-size-18">Pizza</div>
                                </a>
                                <a href="#" class="search_wrapper d-flex align-items-center grey-circle-color px-3 py-2">
                                    <div class="d-flex align-items-center">
                                        <div class="imgsearch-wrapper blue-bg">
                                            <img src="svg-icons/search-icon.svg" alt="">
                                        </div>
                                        <div class="the-result-input bold"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="dropdown feat-menu d-flex align-items-center justify-content-center height-60 px-3" data-v="v-value2">
                            <a class="btn btn-white d-flex align-items-center border-radius-0" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="svg-icons/res-search.svg" class="img-menu" style="width:20px;" alt=""> <span class="text-menu mx-2 v-value2">Italian</span> <img src="svg-icons/down-arrow.svg" class="img-menu" style="width:12px" alt="">
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item dropdown-value" data-v="v-value2" href="#">Roma</a>
                                <a class="dropdown-item dropdown-value" data-v="v-value2" href="#">Paris</a>
                                <a class="dropdown-item dropdown-value" data-v="v-value2" href="#">England</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bestinmonth-banner py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card border box-shadow border-radius overflow-hidden mx-auto mb-4">
                            <div class="card-header red-bg">
                                <div class="d-flex align-items-center justify-content-between text-white">
                                    <div>{{trans('public.filter.title')}}</div>
                                    <a href="#" class="text-white text-underline-none">{{trans('public.filter.reset')}}</a>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="card-body p-0">
                                    <div id="accordion">
                                        <div class="border-bottom">
                                            <div class="bg-white p-0" id="headingOne">
                                                <h5 class="mb-0">
                                                    <button
                                                        class="btn px-4 btn-collapse btn-block d-flex align-items-center justify-content-between box-shadow-0"
                                                        data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                                        aria-controls="collapseOne">
                                                        <span>{{trans('public.filter.cuisine')}}</span>
                                                        <i class="fas fa-minus arrow-collapse"></i>
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                                <div class="card-body pt-0 px-4">
                                                    <ul class="list-unstyled p-0 m-0 chceks-wrapper">
                                                        <li>
                                                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                                                <input type="checkbox" class="filter-input custom-control-input" id="none" name='type'
                                                                       value='all'>
                                                                <label class="custom-control-label" for="none">Italian</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                                                <input type="checkbox" class="filter-input custom-control-input spicies" id="spicies"
                                                                       name='type' value='spicies'>
                                                                <label class="custom-control-label" for="spicies">French</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                                                <input type="checkbox" class="filter-input custom-control-input market" id="market" name='type'
                                                                       value='market'>
                                                                <label class="custom-control-label" for="market">Spanish</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                                                <input type="checkbox" class="filter-input custom-control-input feed" id="feed" name="type"
                                                                       value="feed">
                                                                <label class="custom-control-label" for="feed">Greek</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                                                <input type="checkbox" class="filter-input custom-control-input vegetables" id="vegetables"
                                                                       name="type" value="vegetables">
                                                                <label class="custom-control-label" for="vegetables">Egyptian</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                                                <input type="checkbox" class="filter-input custom-control-input" id="meat" name="type" value="meat">
                                                                <label class="custom-control-label" for="meat">Japanese</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-bottom">
                                            <div class="bg-white p-0" id="headingTwo">
                                                <h5 class="mb-0">
                                                    <button
                                                        class="btn px-4 btn-collapse btn-block d-flex align-items-center justify-content-between box-shadow-0 collapsed"
                                                        data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                                        aria-controls="collapseTwo">
                                                        <span>Shopping by Group</span>
                                                        <i class="fas fa-plus arrow-collapse"></i>
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                                <div class="card-body pt-0 px-4">
                                                    <ul class="list-unstyled p-0 m-0 chceks-wrapper">
                                                        <li>
                                                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                                                <input type="checkbox" class="filter-input custom-control-input" id="vegitables" name='type'
                                                                       value='all'>
                                                                <label class="custom-control-label" for="vegitables">Vegetables</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                                                <input type="checkbox" class="filter-input custom-control-input spicies" id="chicken"
                                                                       name='type' value='spicies'>
                                                                <label class="custom-control-label" for="chicken">Chicken</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                                                <input type="checkbox" class="filter-input custom-control-input market" id="meats" name='type'
                                                                       value='market'>
                                                                <label class="custom-control-label" for="meats">Meat</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                                                <input type="checkbox" class="filter-input custom-control-input feed" id="fish" name="type"
                                                                       value="feed">
                                                                <label class="custom-control-label" for="fish">Fish</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                                                <input type="checkbox" class="filter-input custom-control-input vegetables" id="egg"
                                                                       name="type" value="vegetables">
                                                                <label class="custom-control-label" for="egg">Egg</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                                                <input type="checkbox" class="filter-input custom-control-input" id="beans" name="type" value="meat">
                                                                <label class="custom-control-label" for="beans">Beans</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-bottom">
                                            <div class="bg-white p-0" id="headingThree">
                                                <h5 class="mb-0">
                                                    <button
                                                        class="btn px-4 btn-collapse btn-block d-flex align-items-center justify-content-between box-shadow-0 collapsed"
                                                        data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                                                        aria-controls="collapseThree">
                                                        <span>Shopping by Price</span>
                                                        <i class="fas fa-plus arrow-collapse"></i>
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                                <div class="card-body pt-0 px-4">
                                                    <ul class="list-unstyled p-0 m-0 chceks-wrapper">
                                                        <li>
                                                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                                                <input type="checkbox" class="filter-input custom-control-input" id="euro20" name='type'
                                                                       value='all'>
                                                                <label class="custom-control-label" for="euro20">1 &amp; &euro; - 20 &euro;</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                                                <input type="checkbox" class="filter-input custom-control-input spicies" id="euro75"
                                                                       name='type' value='spicies'>
                                                                <label class="custom-control-label" for="euro75">20 &amp; &euro; - 75 &euro;</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                                                <input type="checkbox" class="filter-input custom-control-input market" id="euro150" name='type'
                                                                       value='market'>
                                                                <label class="custom-control-label" for="euro150">75 &amp; &euro; - 150 &euro;</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                                                <input type="checkbox" class="filter-input custom-control-input feed" id="euro500" name="type"
                                                                       value="feed">
                                                                <label class="custom-control-label" for="euro500">150 &amp; &euro; - 500 &euro;</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                                                <input type="checkbox" class="filter-input custom-control-input vegetables" id="euro100"
                                                                       name="type" value="vegetables">
                                                                <label class="custom-control-label" for="euro100">500 &amp; &euro; - 1000 &euro;</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div>
                                                                <div class="third">
                                                                    <input type="range" id="input-range" min="-10" max="400" step="2" value="40" data-rangeslider>
                                                                    <div class="d-flex justify-content-between">
                                                                        <div><span class="output"></span> &euro;</div>
                                                                        <div><span class="final-range"></span>500 &euro;</div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-bottom">
                                            <div class="bg-white p-0" id="headingFour">
                                                <h5 class="mb-0">
                                                    <button
                                                        class="btn px-4 btn-collapse btn-block d-flex align-items-center justify-content-between box-shadow-0 collapsed"
                                                        data-toggle="collapse" data-target="#collapseFour" aria-expanded="false"
                                                        aria-controls="collapseFour">
                                                        <span>Shopping by Resturants</span>
                                                        <i class="fas fa-plus arrow-collapse"></i>
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                                                <div class="card-body pt-0 px-4">
                                                    <ul class="list-unstyled p-0 m-0 chceks-wrapper">
                                                        <li>
                                                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                                                <input type="checkbox" class="filter-input custom-control-input" id="r1" name='type'
                                                                       value='all'>
                                                                <label class="custom-control-label" for="r1">Resturant 1</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                                                <input type="checkbox" class="filter-input custom-control-input spicies" id="r2"
                                                                       name='type' value='spicies'>
                                                                <label class="custom-control-label" for="r2">Resturant 2</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                                                <input type="checkbox" class="filter-input custom-control-input market" id="r3" name='type'
                                                                       value='market'>
                                                                <label class="custom-control-label" for="r3">Resturant 3</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                                                <input type="checkbox" class="filter-input custom-control-input feed" id="r4" name="type"
                                                                       value="feed">
                                                                <label class="custom-control-label" for="r4">Resturant 4</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                                                <input type="checkbox" class="filter-input custom-control-input vegetables" id="r5"
                                                                       name="type" value="vegetables">
                                                                <label class="custom-control-label" for="r5">Resturant 5</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-bottom">
                                            <div class="bg-white p-0" id="headingFive">
                                                <h5 class="mb-0">
                                                    <button
                                                        class="btn px-4 btn-collapse btn-block d-flex align-items-center justify-content-between box-shadow-0 collapsed"
                                                        data-toggle="collapse" data-target="#collapseFive" aria-expanded="false"
                                                        aria-controls="collapseFive">
                                                        <span>Shopping by Meals</span>
                                                        <i class="fas fa-plus arrow-collapse"></i>
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                                                <div class="card-body pt-0 px-4">
                                                    <ul class="list-unstyled p-0 m-0 chceks-wrapper">
                                                        <li>
                                                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                                                <input type="checkbox" class="filter-input custom-control-input" id="m1" name='type'
                                                                       value='all'>
                                                                <label class="custom-control-label" for="m1">Meal 1</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                                                <input type="checkbox" class="filter-input custom-control-input spicies" id="m2"
                                                                       name='type' value='spicies'>
                                                                <label class="custom-control-label" for="m2">Meal 2</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                                                <input type="checkbox" class="filter-input custom-control-input market" id="m3" name='type'
                                                                       value='market'>
                                                                <label class="custom-control-label" for="m3">Meal 3</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                                                <input type="checkbox" class="filter-input custom-control-input feed" id="m4" name="type"
                                                                       value="feed">
                                                                <label class="custom-control-label" for="m4">Meal 4</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                                                <input type="checkbox" class="filter-input custom-control-input vegetables" id="m5"
                                                                       name="type" value="vegetables">
                                                                <label class="custom-control-label" for="m5">Meal 5</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="row grid-layout">
                            <div class="col-md-4 eboro-box">
                                <div class="card card-box-shadow border-0 border-radius-20 p-4">
                                    <div class="grid-content">
                                        <div>
                                            <img src="images/donuts.png" class="card-img" alt="">
                                        </div>
                                        <div>
                                            <h4 class="c-ele red-color text-center font-size-18 bold searh-resulting">Eboro nisi venenantis</h4>
                                            <div class="c-ele text-muted text-center searh-resulting">Dunkin</div>
                                            <p class="m-0 font-size-15">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptate eos esse, sit officia sint cupiditate, vero maiores voluptas laboriosam iusto aut voluptatem ab pariatur sequi veritatis sed mollitia cumque minima.</p>
                                        </div>
                                    </div>
                                    <div class="card-line text-center my-3">
                                        <div class="card-poly">
                                            <img src="svg-icons/polygonincards.svg" alt="">
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="filter-result"><span class="result-searching">175.59</span> &euro;</div>
                                        <button class="btn red-bg text-white btn-sm btn-added-cart">{{trans('public.add_to_cart')}}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 eboro-box">
                                <div class="card card-box-shadow border-0 border-radius-20 p-4">
                                    <div class="grid-content">
                                        <div>
                                            <img src="images/donuts.png" class="card-img" alt="">
                                        </div>
                                        <div>
                                            <h4 class="c-ele red-color text-center font-size-18 bold searh-resulting">ABCDE nisi venenantis</h4>
                                            <div class="c-ele text-muted text-center searh-resulting">Dunkin</div>
                                            <p class="m-0 font-size-15">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptate eos esse, sit officia sint cupiditate, vero maiores voluptas laboriosam iusto aut voluptatem ab pariatur sequi veritatis sed mollitia cumque minima.</p>
                                        </div>
                                    </div>
                                    <div class="card-line text-center my-3">
                                        <div class="card-poly">
                                            <img src="svg-icons/polygonincards.svg" alt="">
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="filter-result"><span class="result-searching">101.35</span> &euro;</div>
                                        <button class="btn red-bg text-white btn-sm btn-added-cart">{{trans('public.add_to_cart')}}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 eboro-box">
                                <div class="card card-box-shadow border-0 border-radius-20 p-4">
                                    <div class="grid-content">
                                        <div class="mr-3">
                                            <img src="images/donuts.png" class="card-img" alt="">
                                        </div>
                                        <div>
                                            <h4 class="c-ele red-color text-center font-size-18 bold searh-resulting">Codiano nisi venenantis</h4>
                                            <div class="c-ele text-muted text-center searh-resulting">Dunkin</div>
                                            <p class="m-0 font-size-15">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptate eos esse, sit officia sint cupiditate, vero maiores voluptas laboriosam iusto aut voluptatem ab pariatur sequi veritatis sed mollitia cumque minima.</p>
                                        </div>
                                    </div>
                                    <div class="card-line text-center my-3">
                                        <div class="card-poly">
                                            <img src="svg-icons/polygonincards.svg" alt="">
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="filter-result"><span class="result-searching">125.65</span> &euro;</div>
                                        <button class="btn red-bg text-white btn-sm btn-added-cart">{{trans('public.add_to_cart')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </main>

    <!-- Start Footer -->
    @yield('footer')
    <!-- End Footer -->
</main>
@yield('script')
</body>
</html>
