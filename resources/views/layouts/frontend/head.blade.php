<!doctype html>
<!-- <html class="no-js" lang="zxx"> -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="icon" href="{{ url('frontend/assets/img/logo/favicon.PNG') }}">
    <title>Daily Rasta News Agency</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" type="image/x-icon" href="frontend/assets/img/favicon.ico">
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org//face/nafees-nastaleeq" type="text/css" />


    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/ticker-style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/slicknav.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.5.3/css/bootstrap.min.css"
        integrity="sha384-JvExCACAZcHNJEc7156QaHXTnQL3hQBixvj5RV5buE7vgnNEzzskDtx9NQ4p6BJe" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('frontend/assets/css/custom.css') }}">
    {{-- <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"> --}}

    @stack('frontCss')

    <style>
        p,
        a,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        span,
        button,
        input,
        label,
        select,
        textarea {
            font-family: 'NafeesRegular';
            font-weight: normal;
            font-style: normal;
        }

        .dl,
        ol,
        ul {
            margin-top: 0;
            margin-bottom: 0px !important;
        }

        #sarach_data {
            position: absolute;
            background-color: #ffe7e6;
            color: black;
            top: 38px;
        }

        .main-search-button {
            position: absolute;
            right: -70px;
            height: 38px;
            width: 70px;
            color: #ffffff;
            top: 5;
            border: none;
            top: 0px;
            border-radius: 5px;
            background-color: #109cde;
        }

        .main-search-button:hover {
            background-color: #f14c38;
            color: #ffffff;

        }

        .date-search {
            position: absolute;
            right: -31px;
            height: 39px;
            width: 70px;
            color: #ffffff;
            top: 5;
            border: none;
            top: 23px;
            border-radius: 5px;
            background-color: #109cde;
        }

        .date-search:hover {
            background-color: #f14c38;
            color: #ffffff;
        }
        .rtl{
            direction: rtl;
        }
        @media only screen and (max-width: 414px) and (min-width: 375px)  {
            .disply{
                        display: none !important;
            }
            .hello .slick-list .slick-track{
                left: -20px !important;
            }
            .slick-list .slick-track{
                left: -2px !important;
            }
        }
        @media only screen and (min-width: 768px) and (max-width: 991px) {
        .header-area .header-mid .logo .med-width {
         width: 200px !important;
            }

                .header-sticky.sticky-bar.sticky .main-menu ul > li > a {
                padding: 13px 13px !important;
            }

            .info-open a img{
                width: 114px !important;
                margin-top: 14px;
                height: 56px;
            }

        }

        @media screen and (max-width: 480px) {
            .area{
                padding-top: 20px !important;
            }

            .img{
                width: 50% !important;
            }

           .hello .slick-list .slick-track{
                left: -41px !important;
            }
            .slick-list .slick-track{
                left: -2px !important;
            }

            .what-new{
                padding-left: 15px;
            }

            a:hover{
               color: #fc3f00;
            }

            .rowcenter {
                text-align: center;
            }

            .test {
                text-align: left !important;
                width: 80px !important;
                /* display: none !important; */
            }
            .rtl{
                direction: ltr;
            }
            .disply{
                display: none !important;
            }
            .center{
                left: 38px;
            }
        }


        .overflo {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            /* number of lines to show */
            -webkit-box-orient: vertical;

        }
        a:hover{
               color: #fc3f00;
            }

    </style>


</head>

<body>
    @include('layouts.frontend.inc.header')

    {{-- <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="{{ asset('frontend/assets/img/logo/logo.png') }}" alt="">
                </div>
            </div>
        </div>
    </div> --}}

    @yield('content')
    @include('layouts.frontend.inc.footer')
    <!-- All JS Custom Plugins Link Here here -->
    <script src="{{ asset('') }}frontend//assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="{{ asset('frontend/assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
    <!-- Jquery Mobile Menu -->
    <script src="{{ asset('frontend/assets/js/jquery.slicknav.min.js') }}"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/slick.min.js') }}"></script>
    <!-- Date Picker -->
    {{-- <script src="{{ asset('frontend/assets/js/gijgo.min.js') }}"></script> --}}
    <!-- One Page, Animated-HeadLin -->
    <script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/animated.headline.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.magnific-popup.js') }}"></script>

    <!-- Breaking New Pluging -->
    {{-- <script src="{{ asset('frontend/assets/js/jquery.ticker.js') }}"></script> --}}
    {{-- <script src="{{ asset('frontend/assets/js/site.js') }}"></script> --}}

    <!-- Scrollup, nice-select, sticky -->
    <script src="{{ asset('frontend/assets/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.sticky.js') }}"></script>

    <!-- contact js -->
    <script src="{{ asset('frontend/assets/js/contact.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.form.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/mail-script.js') }}"></script>

    <!-- Jquery Plugins, main Jquery -->
    <script src="{{ asset('frontend/assets/js/plugins.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    @stack('frontJs')


    <script>
        @if (Session::has('message'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('message') }}");
        @endif

        @if (Session::has('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ session('error') }}");
        @endif

        @if (Session::has('info'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.info("{{ session('info') }}");
        @endif

        @if (Session::has('warning'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>

    <script type="text/javascript">
        $('#searchBtn').on('click', function(e) {
            e.preventDefault();

            var search = $('#search').val();

            $.ajax({
                type: 'get',
                url: '{{ URL::to('search') }}',
                data: {
                    'search': search
                },
                success: function(data) {

                    if (data.length > 0) {

                        $.each(data, function(indx, stock) {

                            $('#sarach_data').html(' ');

                            $('#sarach_data').append(
                                '<li  class="list-group-item list-group-item-info"><a href="' +
                                stock.slug + '/??????" target="_blank">' + stock.title +
                                ' </a></li>');
                        });

                    } else {
                        $('#sarach_data').html(' ');
                        $('#sarach_data').append(
                            '<li  class="list-group-item list-group-item-info">???????? ???????? ???????? ??????</li>'
                        );

                    }
                }

            });
        })
    </script>



</body>

</html>
