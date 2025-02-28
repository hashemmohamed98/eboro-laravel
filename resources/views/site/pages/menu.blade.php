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

    <main id="menu">

        <div class="menus-banner overlay">
            <div class="container height-100-per">
                <div class="d-flex flex-column align-items-center justify-content-center height-100-per">
                    <div class="zindex breadcrumb-menu text-white d-flex align-items-center">
                        <div class="font-size-30"><a href="#" class="text-white"><i class="fas fa-home font-size-30"></i></a></div>
                        <div class="mx-3 font-size-20"><i class="fas fa-caret-right"></i></div>
                        <div class="font-size-25">Menu</div>
                    </div>
                    <div class="mt-5 width-100-per">
                        <div class="menu-banner">
                            <div class="menu-box d-flex" style="margin-top: 0;">
                                <div class="dropdown d-flex align-items-center justify-content-center height-60 px-3">
                                    <a class="btn btn-white d-flex align-items-center border-radius-0" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="text-menu">{{trans('public.view')}}</span> <img src="svg-icons/grid-menu.svg" class="mx-2" style="width:17px" alt=""> <i class="fas fa-list-ul red-color" style="font-size:20px"></i>
                                    </a>
                                </div>
                                <div class="search-area height-60">
                                    <i class="fas fa-search search-icon light-grey"></i>
                                    <input type="text" class="main-input form-control border-radius-0 height-60 placeholder-gray" placeholder="Search for resturant, cuisines or main dishes" name="" id="">
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
            </div>
        </div>

        <div class="bestinmonth-banner py-5">
            <div class="container">
                <h2 class="text-center red-color bold mb-5">{{trans('public.partners')}}</h2>
                <div class="tab-wrapper mb-5">
                    <ul class="nav nav-pills mb-3 justify-content-center bg-white py-2 rounded-pill card-box-shadow mx-auto"
                        role="tablist">
                        <li class="nav-item">
                            <a class="nav-link rounded-pill" data-toggle="pill" href="#all_content" role="tab"
                               aria-controls="pills-home" aria-selected="true">{{trans('public.all')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link rounded-pill active" data-toggle="pill" href="#pizza_content" role="tab"
                               aria-controls="pills-profile" aria-selected="false">restaurant</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link rounded-pill" data-toggle="pill" href="#berger_content" role="tab"
                               aria-controls="pills-profile" aria-selected="false">stores</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link rounded-pill" data-toggle="pill" href="#chicken_content" role="tab"
                               aria-controls="pills-contact" aria-selected="false">pharmacy</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link rounded-pill" data-toggle="pill" href="#soup_content" role="tab"
                               aria-controls="pills-contact" aria-selected="false">supermarket</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link rounded-pill" data-toggle="pill" href="#beverages_content" role="tab"
                               aria-controls="pills-contact" aria-selected="false">party</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link rounded-pill" data-toggle="pill" href="#deserts_content" role="tab"
                               aria-controls="pills-contact" aria-selected="false">anything</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade" id="all_content" role="tabpanel" aria-labelledby="pills-home-tab">All Content
                    </div>
                    <div class="tab-pane active" id="pizza_content" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card card-box-shadow border-0 border-radius-20 p-4">
                                    <img src="images/donuts.png" class="card-img" alt="">
                                    <h4 class="red-color text-center font-size-18 bold">Henderit nisi venenantis</h4>
                                    <span class="text-muted text-center">Dunkin</span>
                                    <p class="m-0 font-size-15">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptate eos esse, sit officia sint cupiditate, vero maiores voluptas laboriosam iusto aut voluptatem ab pariatur sequi veritatis sed mollitia cumque minima.</p>
                                    <div class="card-line text-center my-3">
                                        <div class="card-poly">
                                            <img src="svg-icons/polygonincards.svg" alt="">
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>75.99 &euro;</div>
                                        <button class="btn red-bg text-white btn-sm btn-added-cart">{{trans('public.add_to_cart')}}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card-box-shadow border-0 border-radius-20 p-4">
                                    <img src="images/donuts.png" class="card-img" alt="">
                                    <h4 class="red-color text-center font-size-18 bold">Henderit nisi venenantis</h4>
                                    <span class="text-muted text-center">Dunkin</span>
                                    <p class="m-0 font-size-15">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptate eos esse, sit officia sint cupiditate, vero maiores voluptas laboriosam iusto aut voluptatem ab pariatur sequi veritatis sed mollitia cumque minima.</p>
                                    <div class="card-line text-center my-3">
                                        <div class="card-poly">
                                            <img src="svg-icons/polygonincards.svg" alt="">
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>75.99 &euro;</div>
                                        <button class="btn red-bg text-white btn-sm btn-added-cart">{{trans('public.add_to_cart')}}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card-box-shadow border-0 border-radius-20 p-4">
                                    <img src="images/donuts.png" class="card-img" alt="">
                                    <h4 class="red-color text-center font-size-18 bold">Henderit nisi venenantis</h4>
                                    <span class="text-muted text-center">Dunkin</span>
                                    <p class="m-0 font-size-15">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptate eos esse, sit officia sint cupiditate, vero maiores voluptas laboriosam iusto aut voluptatem ab pariatur sequi veritatis sed mollitia cumque minima.</p>
                                    <div class="card-line text-center my-3">
                                        <div class="card-poly">
                                            <img src="svg-icons/polygonincards.svg" alt="">
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>75.99 &euro;</div>
                                        <button class="btn red-bg text-white btn-sm btn-added-cart">Add to Cart</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card-box-shadow border-0 border-radius-20 p-4">
                                    <img src="images/donuts.png" class="card-img" alt="">
                                    <h4 class="red-color text-center font-size-18 bold">Henderit nisi venenantis</h4>
                                    <span class="text-muted text-center">Dunkin</span>
                                    <p class="m-0 font-size-15">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptate eos esse, sit officia sint cupiditate, vero maiores voluptas laboriosam iusto aut voluptatem ab pariatur sequi veritatis sed mollitia cumque minima.</p>
                                    <div class="card-line text-center my-3">
                                        <div class="card-poly">
                                            <img src="svg-icons/polygonincards.svg" alt="">
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>75.99 &euro;</div>
                                        <button class="btn red-bg text-white btn-sm btn-added-cart">Add to Cart</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card-box-shadow border-0 border-radius-20 p-4">
                                    <img src="images/donuts.png" class="card-img" alt="">
                                    <h4 class="red-color text-center font-size-18 bold">Henderit nisi venenantis</h4>
                                    <span class="text-muted text-center">Dunkin</span>
                                    <p class="m-0 font-size-15">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptate eos esse, sit officia sint cupiditate, vero maiores voluptas laboriosam iusto aut voluptatem ab pariatur sequi veritatis sed mollitia cumque minima.</p>
                                    <div class="card-line text-center my-3">
                                        <div class="card-poly">
                                            <img src="svg-icons/polygonincards.svg" alt="">
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>75.99 &euro;</div>
                                        <button class="btn red-bg text-white btn-sm btn-added-cart">Add to Cart</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card-box-shadow border-0 border-radius-20 p-4">
                                    <img src="images/donuts.png" class="card-img" alt="">
                                    <h4 class="red-color text-center font-size-18 bold">Henderit nisi venenantis</h4>
                                    <span class="text-muted text-center">Dunkin</span>
                                    <p class="m-0 font-size-15">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptate eos esse, sit officia sint cupiditate, vero maiores voluptas laboriosam iusto aut voluptatem ab pariatur sequi veritatis sed mollitia cumque minima.</p>
                                    <div class="card-line text-center my-3">
                                        <div class="card-poly">
                                            <img src="svg-icons/polygonincards.svg" alt="">
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>75.99 &euro;</div>
                                        <button class="btn red-bg text-white btn-sm btn-added-cart">Add to Cart</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card-box-shadow border-0 border-radius-20 p-4">
                                    <img src="images/donuts.png" class="card-img" alt="">
                                    <h4 class="red-color text-center font-size-18 bold">Henderit nisi venenantis</h4>
                                    <span class="text-muted text-center">Dunkin</span>
                                    <p class="m-0 font-size-15">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptate eos esse, sit officia sint cupiditate, vero maiores voluptas laboriosam iusto aut voluptatem ab pariatur sequi veritatis sed mollitia cumque minima.</p>
                                    <div class="card-line text-center my-3">
                                        <div class="card-poly">
                                            <img src="svg-icons/polygonincards.svg" alt="">
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>75.99 &euro;</div>
                                        <button class="btn red-bg text-white btn-sm btn-added-cart">Add to Cart</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card-box-shadow border-0 border-radius-20 p-4">
                                    <img src="images/donuts.png" class="card-img" alt="">
                                    <h4 class="red-color text-center font-size-18 bold">Henderit nisi venenantis</h4>
                                    <span class="text-muted text-center">Dunkin</span>
                                    <p class="m-0 font-size-15">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptate eos esse, sit officia sint cupiditate, vero maiores voluptas laboriosam iusto aut voluptatem ab pariatur sequi veritatis sed mollitia cumque minima.</p>
                                    <div class="card-line text-center my-3">
                                        <div class="card-poly">
                                            <img src="svg-icons/polygonincards.svg" alt="">
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>75.99 &euro;</div>
                                        <button class="btn red-bg text-white btn-sm btn-added-cart">Add to Cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="berger_content" role="tabpanel" aria-labelledby="pills-home-tab">All Berger
                    </div>
                    <div class="tab-pane" id="chicken_content" role="tabpanel" aria-labelledby="pills-home-tab">Chicken Content
                    </div>
                    <div class="tab-pane" id="soup_content" role="tabpanel" aria-labelledby="pills-home-tab">All Content
                    </div>
                    <div class="tab-pane" id="beverages_content" role="tabpanel" aria-labelledby="pills-home-tab">Beverages Content
                    </div>
                    <div class="tab-pane" id="deserts_content" role="tabpanel" aria-labelledby="pills-home-tab">Deserts Content
                    </div>
                    <div class="tab-pane" id="salad_content" role="tabpanel" aria-labelledby="pills-home-tab">Salads Content
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">8 out of 40</div>
                    <div class="col-md-6">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end">
                                <li class="page-item disabled">
                                    <a class="page-link border-0 red-color" href="#" tabindex="-1" aria-disabled="true">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                </li>
                                <li class="page-item active"><a class="page-link red-color border-0 card-box-shadow" href="#">1</a></li>
                                <li class="page-item"><a class="page-link red-color border-0 card-box-shadow" href="#">2</a></li>
                                <li class="page-item"><a class="page-link red-color border-0 card-box-shadow" href="#">3</a></li>
                                <li class="page-item"><a class="page-link red-color border-0 card-box-shadow" href="#">4</a></li>
                                <li class="page-item"><a class="page-link red-color border-0 card-box-shadow" href="#">5</a></li>
                                <li class="page-item">
                                    <a class="page-link border-0 red-color" href="#"><i class="fas fa-chevron-right"></i></a>
                                </li>
                            </ul>
                        </nav>
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
