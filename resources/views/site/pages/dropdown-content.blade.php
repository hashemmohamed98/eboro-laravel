@if(isset($Sauce))
    <div class="col-md-3 mb-3">
        <div class="item shadow position-relative text-center py-2 rounded-lg">
            <img src="{{asset('/public/uploads/Product/'.$Sauce->image)}}" width="50%" alt="">
            <h5 class="bold blue-color font-size-18">{{$Sauce->name}}</h5>
            <div class="delete-cart cursor-pointer"><i class="fas fa-times"></i></div>
        </div>
    </div>
@endif
<script>
    $(".delete-cart").on("click", function() {
        $(this).parent().parent().remove();
    })
</script>