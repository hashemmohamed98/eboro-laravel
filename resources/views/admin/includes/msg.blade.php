{{--<script src="{{asset('admin/assets/sweetalert/sweetalert.min.js')}}"></script>--}}

@if (Session::has('success'))
    {{--<script>--}}
        {{--window.onload = function () {--}}
            {{--swal("", "{{ Session::get('success') }}", "success");--}}
        {{--}--}}
    {{--</script>--}}
    <div class="alert alert-success removeFast">
        <h3>{{ Session('success') }}</h3>
    </div>
    @php
        session()->forget('success');
    @endphp
@endif

@if (Session::has('error'))
    {{--<script>--}}
        {{--window.onload = function () {--}}
            {{--swal("", "{{ Session::get('error') }}", "error");--}}
        {{--}--}}
    {{--</script>--}}
    <div class="alert alert-danger removeFast">
        <h3>{{ Session('error') }}</h3>
    </div>
    @php
        session()->forget('error');
    @endphp
@endif
@if (Session::has('info'))
    <script>
        window.onload = function () {
            swal("", "{{ Session::get('info') }}", "info");
        }
    </script>
    @php
        session()->forget('info');
    @endphp
@endif

@if ($errors->any())
    <div class="alert alert-danger removeFast">
        <?php
        foreach ($errors->all() as $error) {
            echo "<h3>".$error."</h3>";
        }
        ?>
    </div>
    @php
    @endphp
@endif
