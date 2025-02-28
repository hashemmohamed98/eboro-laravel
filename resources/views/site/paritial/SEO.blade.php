@section('SEO')
    <!-- META TAGS -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta property="og:site_name" content="Eboro.consegna a domicilio" />
    <meta property="og:locale" content="it_IT" />
    <meta property="og:locale:alternate" content="en_GB" />
    <link rel="icon" type="image/x-icon" href="{{asset('images/favicon.ico')}}">
    <meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <link rel="icon" href="{{asset('public/uploads/setting/'.$share_setting->logo)}}" sizes="200x100">
    <link rel="apple-touch-icon-precomposed" href="{{asset('public/uploads/setting/'.$share_setting->logo)}}">
    <meta property="og:description" content="{{ $setting->{"description_".app()->getLocale()} }}">
    <meta name="description" content="{{ $setting->{"description_".app()->getLocale()} }}">
    <meta property="og:image" content="{{asset('public/uploads/setting/'.$share_setting->logo)}}" />
    <meta property="fb:app_id" content="470130070779939"/>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-MF3CKN6BLE"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-MF3CKN6BLE');
    </script>
@endsection
