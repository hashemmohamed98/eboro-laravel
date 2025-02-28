@section('home')
    <!-- META TAGS -->
    <link rel="stylesheet" href="{{asset('css/sliderstyle.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/hamburgers.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('css/stackedCards.css')}}">
    <link rel="stylesheet" href="{{asset('css/dropify.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/circle.css')}}">
    <link rel="stylesheet" href="{{asset('css/ranger.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/wokiee.css')}}">
    <link rel="stylesheet" href="{{asset('css/main-s.css')}}">
    <link rel="stylesheet" href="{{asset('css/datatables.min.css')}}">
    <meta name="google-site-verification" content="uTliqucB_dtxR_A-ecW050YwiIQswWGP9UYMTNRSYWM" />
    <style>
#preloader {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 50px;
    height: 50px;
    margin: -30px 0 0 -30px;
}

#status {
    position: fixed;
    z-index: 999999;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    display: block;
    background: #fff;
    background-image: url(images/preloader-1.gif);
    background-repeat: no-repeat;
    background-position: center;
}

        .stacked-cards {
            padding-top: 40px;
            padding-bottom: 15px;
        }
        .stacked-cards-fanOut {
            padding-bottom: 40px;
        }

        .stacked-cards-fanOut li img {
            max-height: 100%;
            width: 100%
        }

        .stacked-cards li {
            height: 400px;
        }

        @media (max-width: 767px) {
            .stacked-cards li {
                height: 200px;
            }
            .overlay-slider {display: none;}
        }

        .stacked-cards li {
            background: url() no-repeat scroll center center;
            background-size: cover;
        }

        .stacked-cards li:nth-child(1n) {
            background: url() no-repeat scroll center center;
            background-size: cover;
        }

        .stacked-cards li:nth-child(2n) {
            background: url() no-repeat scroll center center;
            background-size: cover;
        }
        .stacked-cards li:nth-child(3n) {
            background: url() no-repeat scroll center center;
            background-size: cover;
        }

        .stacked-cards li:nth-child(4n) {
            background: url() no-repeat scroll center center;
            background-size: cover;
        }
        .stacked-cards li:nth-child(5n) {
            background: url() no-repeat scroll center center;
            background-size: cover;
        }

        .overlay-slider {
            position: absolute;
            bottom: 0; left: 0;
            width: 100%;
            height: auto;
            background: rgb(0, 0, 0, .9);
            color: #FFF;
            padding: 30px;
        }

    </style>
@endsection
