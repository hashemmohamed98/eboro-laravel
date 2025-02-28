
@section('order-modal')

    <!-- Order info modal  -->
    <div class="modal fade" id="Order_info" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <h4 class="py-3 px-2"> Order Information (No Edition)</h4>
                <div class="modal-body">
                    <div class="row px-2">
                        <div class="form-group col-md-6">
                            <label for="">Client name*</label>
                            <input type="text" class="form-control radius" placeholder="id.name" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Total price*</label>
                            <input type="" class="form-control radius" placeholder="50,000 Euro" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="row px-2">
                        <div class="form-group col-md-6">
                            <label for="">Delivery name*</label>
                            <input type="" class="form-control radius" placeholder="" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Shipment price*</label>
                            <input type="" class="form-control radius" placeholder="25.00 Euro" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="row px-2">
                        <div class="form-group col-md-6">
                            <label for="">Address*</label>
                            <input type="" class="form-control radius" placeholder="4 A lorem ipsum" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Mobile number*</label>
                            <input type="number" class="form-control radius" placeholder="" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="row px-2">
                        <div class="form-group col-md-6">
                            <label for="">Product name*</label>
                            <input type="" class="form-control radius" disabled>
                        </div>
                        <div class="form-group col-md-6 position-relative">
                            <label for="">Amount*</label>
                            <input type="" class="form-control radius">
                            <i class="fas fa-times text-danger position-absolute" style="right: 0;top: 60%; cursor: pointer;"></i>
                        </div>
                    </div>
                    <div class="row px-2">
                        <div class="form-group col-md-6">
                            <label for="">Product name*</label>
                            <input type="" class="form-control radius" disabled>
                        </div>
                        <div class="form-group col-md-6 position-relative">
                            <label for="">Amount*</label>
                            <input type="" class="form-control radius">
                            <i class="fas fa-times text-danger position-absolute" style="right: 0;top: 60%; cursor: pointer;"></i>
                        </div>
                    </div>
                    <div class="row px-2">
                        <div class="form-group col-md-6">
                            <label for="">Product name*</label>
                            <input type="" class="form-control radius" disabled>
                        </div>
                        <div class="form-group col-md-6 position-relative">
                            <label for="">Amount*</label>
                            <input type="" class="form-control radius">
                            <i class="fas fa-times text-danger position-absolute" style="right: 0;top: 60%; cursor: pointer;"></i>
                        </div>
                    </div>
                    <div class="row px-2">
                        <div class="form-group col-md-6">
                            <label for="">Product name*</label>
                            <input type="" class="form-control radius" disabled>
                        </div>
                        <div class="form-group col-md-6 position-relative">
                            <label for="">Amount*</label>
                            <input type="" class="form-control radius">
                            <i class="fas fa-times text-danger position-absolute" style="right: 0;top: 60%; cursor: pointer;"></i>
                        </div>
                    </div>
                    <div class="row px-2">
                        <div class="form-group col-md-6">
                            <label for="">Product name*</label>
                            <input type="" class="form-control radius" disabled>
                        </div>
                        <div class="form-group col-md-6 position-relative">
                            <label for="">Amount*</label>
                            <input type="" class="form-control radius">
                            <i class="fas fa-times text-danger position-absolute" style="right: 0;top: 60%; cursor: pointer;"></i>
                        </div>
                    </div>
                    <div class="form-group col-12">
                        <label for="">Add Note*</label>
                        <textarea name="" class="form-control radius" placeholder="" cols="30" rows="5"></textarea>
                    </div>
                    <div class="btn text-left px-2">
                        <button type="button" class="btn dashboard-main-bg radius px-4 text-white ">{{trans('admin.save')}} </button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- delete modal  -->
    <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h6 class="text-dark"> Are you sure you want to delete
                        < name>
                    </h6>
                </div>
                <div class="modal-footer d-flex justify-content-between align-items-center">
                    <button type="button" class="btn btn-secondary border-0 bg-transparent text-danger" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger radius text-white">Delete</button>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('cashers-modal')


@endsection


@section('resturant-modal')

    <!-- add branch  -->
    <div class="modal fade" id="Branch" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <h4 class="py-3 px-2"> Branch Information </h4>
                <div class="modal-body">
                    <form class="">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="">Branch name*</label>
                                <input type="text" class="form-control radius" placeholder="pizza" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Hotloine number*</label>
                                <input type="number" class="form-control radius" placeholder="pizza" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Branch addressx*</label>
                                <input type="email" class="form-control radius" placeholder="" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="col-md-6">
                                <label for="">Branch map*</label>
                                <div class="input-group mb-3">
                                    <label class="form-control left-radius border-right-0" style="width: 50px;">
                                        <img id="output" height="30px" class="d-block m-auto border-0">
                                    </label>
                                    <div class="input-group-append">
                                        <label for="photo" class="form-control right-radius border-left-0 text-muted py-0">
                                            <div class="d-flex justify-content-end">
                                                <i class="fas fa-image fa-2x mb-3"></i>
                                            </div>
                                        </label>
                                        <input type="file" accept="image/*" onchange="loadFile(event)" class="form-control p-3 text-muted d-none" placeholder="Password*" id="photo" aria-describedby="emailHelp" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Open time*</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control left-radius border-right-0 rounded-0" placeholder="4:30" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-transparent right-radius border-left-0 rounded-0 border-right" id="basic-addon2">
                                                    AM
                                    </span>
                                        <i class="fas fa-caret-down d-block position-relative" style="top: 58%;right: 50%;"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Close time*</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control border-right-0 left-radius" placeholder="4:30" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    <div class="input-group-append flex-column">
                                        <span class="input-group-text bg-transparent right-radius border-left-0 rounded-0 border-right" id="basic-addon2">
                                        PM
                                </span>
                                        <i class="fas fa-caret-down d-block position-relative" style="bottom: 30%;left: 40%;"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Open days*</label>
                                <input type="" class="form-control radius" placeholder="" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Branch status*</label>
                                <select type="" class="form-control radius">
                                    <option value="">1</option>
                                    <option value="">1</option>
                                    <option value="">1</option>
                                </select>
                            </div>

                            <div class="form-group col-12">
                                <label for="">Descritption*</label>
                                <textarea name="" class="form-control radius" placeholder="Enter message" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                        <button type="button" class="btn dashboard-main-bg px-4 text-white">{{trans('admin.save')}} </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection



@section('delivery-modal')


@endsection

@section('sauce-modal')

    <!-- add sauce modal -->
    <div class="modal fade" id="suace-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <h4 class="py-3 px-2"> Sauce Information </h4>
                <div class="modal-body">
                    <form class="">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="">Sauce name*</label>
                                <input type="" class="form-control radius" placeholder="pizza" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">ID*</label>
                                <input type="" class="form-control radius" placeholder="pizza" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Category*</label>
                                <select type="" class="form-control radius">
                                    <option value="">1</option>
                                    <option value="">1</option>
                                    <option value="">1</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Price*</label>
                                <input type="" class="form-control radius" placeholder="" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="col-md-6">
                                <label for="">Photo*</label>
                                <div class="input-group mb-3">
                                    <label class="form-control left-radius border-right-0" style="width: 50px;">
                                        <img id="output" height="30px" class="d-block m-auto border-0">
                                    </label>
                                    <div class="input-group-append">
                                        <label for="photo" class="form-control right-radius border-left-0 text-muted py-0">
                                            <div class="d-flex justify-content-end">
                                                <i class="fas fa-image fa-2x mb-3"></i>
                                            </div>
                                        </label>
                                        <input type="file" accept="image/*" onchange="loadFile(event)" class="form-control p-3 text-muted d-none" placeholder="Password*" id="photo" aria-describedby="emailHelp" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">short descritption*</label>
                                <input type="" class="form-control radius" placeholder="" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>

                            <div class="form-group col-12">
                                <label for="">Descritption*</label>
                                <textarea name="" class="form-control radius" placeholder="Enter message" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                        <button type="button" class="btn dashboard-main-bg px-4 text-white">{{trans('admin.save')}} </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- add sauce modal  -->
    <div class="modal fade" id="addSauce" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content p-3">
                <div class="modal-header p-0 border-0">
                    <h4 class="py-3 px-2"> Sauce Information </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="">select sauct*</label>
                    <div class="input-group mb-0 search">
                        <div class="input-group-append bg-transparent">
                            <span class="input-group-text bg-white p-1" id="basic-addon2">
                                    <img src="../../assets/images/sambousek.png" alt="" width="25px">
                                </span>
                        </div>
                        <select class="form-control right-radius">
                            <option value="">ranch</option>
                        </select>
                    </div>
                    <div class="row sauce-boxes pt-5">
                        <div class="col-md-3 mb-3">
                            <div class="item  shadow position-relative text-center py-2 rounded-lg">
                                <img src="../../assets/images/sambousek.png" width="50%" alt="">
                                <h5>Ranch</h5>
                                <i class="fas fa-times position-absolute" style="cursor: pointer; top: 2%; right: 2%;"></i>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="item  shadow position-relative text-center py-2 rounded-lg">
                                <img src="../../assets/images/sambousek.png" width="50%" alt="">
                                <h5>Ranch</h5>
                                <i class="fas fa-times position-absolute" style="cursor: pointer; top: 2%; right: 2%;"></i>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="item  shadow position-relative text-center py-2 rounded-lg">
                                <img src="../../assets/images/sambousek.png" width="50%" alt="">
                                <h5>Ranch</h5>
                                <i class="fas fa-times position-absolute" style="cursor: pointer; top: 2%; right: 2%;"></i>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="item  shadow position-relative text-center py-2 rounded-lg">
                                <img src="../../assets/images/sambousek.png" width="50%" alt="">
                                <h5>Ranch</h5>
                                <i class="fas fa-times position-absolute" style="cursor: pointer; top: 2%; right: 2%;"></i>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="item  shadow position-relative text-center py-2 rounded-lg">
                                <img src="../../assets/images/sambousek.png" width="50%" alt="">
                                <h5>Ranch</h5>
                                <i class="fas fa-times position-absolute" style="cursor: pointer; top: 2%; right: 2%;"></i>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="item  shadow position-relative text-center py-2 rounded-lg">
                                <img src="../../assets/images/sambousek.png" width="50%" alt="">
                                <h5>Ranch</h5>
                                <i class="fas fa-times position-absolute" style="cursor: pointer; top: 2%; right: 2%;"></i>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="item  shadow position-relative text-center py-2 rounded-lg">
                                <img src="../../assets/images/sambousek.png" width="50%" alt="">
                                <h5>Ranch</h5>
                                <i class="fas fa-times position-absolute" style="cursor: pointer; top: 2%; right: 2%;"></i>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="item  shadow position-relative text-center py-2 rounded-lg">
                                <img src="../../assets/images/sambousek.png" width="50%" alt="">
                                <h5>Ranch</h5>
                                <i class="fas fa-times position-absolute" style="cursor: pointer; top: 2%; right: 2%;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 d-flex justify-content-start">
                    <button type="button" class="btn dashboard-main-bg px-4 text-white">Add </button>
                </div>
            </div>
        </div>
    </div>

    <!-- add sauce modal  -->
    <div class="modal fade" id="addSauce">
        <div class="modal-dialog modal-xl">
            <div class="modal-content p-3">
                <div class="modal-header p-0 border-0">
                    <h4 class="py-3 px-2">{{trans('dashboard.beverages.sauce_information')}}  </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="">{{trans('dashboard.beverages.select_sauce')}} *</label>
                    <div class="d-flex justify-content-between">
                        <div class="input-group mb-0 search" style="width:90%;">
                            <div class="input-group-append bg-transparent">
                                <span class="input-group-text bg-white p-1" id="basic-addon2">
                                    <img src="images/sambousek.png" alt="" width="25px">
                                </span>
                            </div>
                            <select class="form-control right-radius select-modal">
                                <option value="">Select</option>
                                <option value="ranch">ranch</option>
                            </select>
                        </div>
                        <button type="button" class="btn btn-warning text-white add-modal">{{trans('admin.add')}} </button>
                    </div>
                    <div class="row sauce-boxes pt-5">
                    </div>
                </div>
                <div class="modal-footer border-0 d-flex justify-content-start">

                </div>
            </div>
        </div>
    </div>


    <!-- delete modal  -->
    <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h6 class="text-dark"> Are you sure you want to delete
                        < name>
                    </h6>
                </div>
                <div class="modal-footer d-flex justify-content-between align-items-center">
                    <button type="button" class="btn btn-secondary border-0 bg-transparent text-danger" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger radius text-white">Delete</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('beveraged-modal')

    <!-- add beverages modal -->
    <div class="modal fade" id="beverages" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <h4 class="py-3 px-2"> {{trans('dashboard.beverages.beverages_information')}}</h4>
                <div class="modal-body">
                    <form class="">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="">{{trans('dashboard.beverages.sauce_name')}}*</label>
                                <input type="" class="form-control radius" placeholder="Fanta" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Price*</label>
                                <input type="" class="form-control radius" placeholder="5.99 Euro" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label class="form-control left-radius border-right-0" style="width: 50px;">
                                        <img id="output" height="30px" class="d-block m-auto border-0">
                                    </label>
                                    <div class="input-group-append">
                                        <label for="photo" class="form-control right-radius border-left-0 text-muted py-0">
                                            <div class="d-flex justify-content-end">
                                                <i class="fas fa-image fa-2x mb-3"></i>
                                            </div>
                                        </label>
                                        <input type="file" accept="image/*" onchange="loadFile(event)" class="form-control p-3 text-muted d-none" placeholder="Password*" id="photo" aria-describedby="emailHelp" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <label for="">Add note*</label>
                                <textarea name="" class="form-control radius" placeholder="Enter message" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                        <button type="button" class="btn dashboard-main-bg px-4 text-white">{{trans('admin.save')}} </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- add sauce modal  -->
    <div class="modal fade" id="addSauce" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content p-3">
                <div class="modal-header p-0 border-0">
                    <h4 class="py-3 px-2"> {{trans('dashboard.beverages.sauce_information')}} </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="">{{trans('dashboard.beverages.select_sauce')}}*</label>
                    <div class="input-group mb-0 search">
                        <div class="input-group-append bg-transparent">
                            <span class="input-group-text bg-white p-1" id="basic-addon2">
                                    <img src="../../assets/images/sambousek.png" alt="" width="25px">
                                </span>
                        </div>
                        <select class="form-control right-radius">
                            <option value="">ranch</option>
                        </select>
                    </div>
                    <div class="row sauce-boxes pt-5">
                        <div class="col-md-3 mb-3">
                            <div class="item  shadow position-relative text-center py-2 rounded-lg">
                                <img src="../../assets/images/sambousek.png" width="50%" alt="">
                                <h5>Ranch</h5>
                                <i class="fas fa-times position-absolute" style="cursor: pointer; top: 2%; right: 2%;"></i>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="item  shadow position-relative text-center py-2 rounded-lg">
                                <img src="../../assets/images/sambousek.png" width="50%" alt="">
                                <h5>Ranch</h5>
                                <i class="fas fa-times position-absolute" style="cursor: pointer; top: 2%; right: 2%;"></i>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="item  shadow position-relative text-center py-2 rounded-lg">
                                <img src="../../assets/images/sambousek.png" width="50%" alt="">
                                <h5>Ranch</h5>
                                <i class="fas fa-times position-absolute" style="cursor: pointer; top: 2%; right: 2%;"></i>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="item  shadow position-relative text-center py-2 rounded-lg">
                                <img src="../../assets/images/sambousek.png" width="50%" alt="">
                                <h5>Ranch</h5>
                                <i class="fas fa-times position-absolute" style="cursor: pointer; top: 2%; right: 2%;"></i>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="item  shadow position-relative text-center py-2 rounded-lg">
                                <img src="../../assets/images/sambousek.png" width="50%" alt="">
                                <h5>Ranch</h5>
                                <i class="fas fa-times position-absolute" style="cursor: pointer; top: 2%; right: 2%;"></i>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="item  shadow position-relative text-center py-2 rounded-lg">
                                <img src="../../assets/images/sambousek.png" width="50%" alt="">
                                <h5>Ranch</h5>
                                <i class="fas fa-times position-absolute" style="cursor: pointer; top: 2%; right: 2%;"></i>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="item  shadow position-relative text-center py-2 rounded-lg">
                                <img src="../../assets/images/sambousek.png" width="50%" alt="">
                                <h5>Ranch</h5>
                                <i class="fas fa-times position-absolute" style="cursor: pointer; top: 2%; right: 2%;"></i>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="item  shadow position-relative text-center py-2 rounded-lg">
                                <img src="../../assets/images/sambousek.png" width="50%" alt="">
                                <h5>Ranch</h5>
                                <i class="fas fa-times position-absolute" style="cursor: pointer; top: 2%; right: 2%;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 d-flex justify-content-start">
                    <button type="button" class="btn dashboard-main-bg px-4 text-white">{{trans('admin.add')}} </button>
                </div>
            </div>
        </div>
    </div>

    <!-- delete modal  -->
    <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h6 class="text-dark"> Are you sure you want to delete
                        < name>
                    </h6>
                </div>
                <div class="modal-footer d-flex justify-content-between align-items-center">
                    <button type="button" class="btn btn-secondary border-0 bg-transparent text-danger" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger radius text-white">Delete</button>
                </div>
            </div>
        </div>
    </div>

@endsection

