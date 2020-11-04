<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!-- TITLE -->
    <title>WeHouse @yield('title')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <link rel="icon" href="{{asset('img/logo.png')}}" type="image/x-icon">

    <!-- GOOGLE FONT -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:700,600,400,300' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Oswald:400' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>

    <!-- CSS LIBRARY -->
    <link rel="stylesheet" type="text/css" href="{{asset('gofar/css/lib/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('gofar/css/lib/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('gofar/css/lib/awe-booking-font.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('gofar/css/lib/owl.carousel.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('gofar/css/lib/magnific-popup.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('gofar/css/lib/jquery-ui.css')}}">
    <!-- REVOLUTION DEMO -->
    <link rel="stylesheet" type="text/css" href="{{asset('gofar/revslider-demo/css/settings.css')}}">
    {{-- Sweet alert --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.7.2/dist/sweetalert2.all.min.js"></script>
    
    {{-- <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script> --}}

    <!-- MAIN STYLE -->
    <link rel="stylesheet" type="text/css" href="{{asset('gofar/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('gofar/css/demo.css')}}">

    <!-- CSS COLOR -->
    <link id="colorreplace" rel="stylesheet" type="text/css" href="{{asset('gofar/css/colors/blue.css')}}">

    <!--[if lt IE 9]>
        <script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <script src="https://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
    <script>
        // Create our number formatter.
        function getCurrencyText(price) {
            var formatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
            });
            return formatter.format(price).substring(2);
        }
        //document.getElementById("saldo").innerHTML = formatter.format({{Session::get('saldo')}}); /* $2,500.00 */
    </script>
</head>

<!--[if IE 7]> <body class="ie7 lt-ie8 lt-ie9 lt-ie10"> <![endif]-->
<!--[if IE 8]> <body class="ie8 lt-ie9 lt-ie10"> <![endif]-->
<!--[if IE 9]> <body class="ie9 lt-ie10"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->

<body>
    <!--<![endif]-->
    {{-- sweet alert style --}}
    <style>
        .swal2-container:not(.swal2-top):not(.swal2-top-start):not(.swal2-top-end):not(.swal2-top-left):not(.swal2-top-right):not(.swal2-center-start):not(.swal2-center-end):not(.swal2-center-left):not(.swal2-center-right):not(.swal2-bottom):not(.swal2-bottom-start):not(.swal2-bottom-end):not(.swal2-bottom-left):not(.swal2-bottom-right):not(.swal2-grow-fullscreen)>.swal2-modal {
            font-size: medium;
        }
        .swal2-container {
            z-index: 10000;
        }
        #header-page .logo img {
            width: 35%;
            max-height: 155px;
            /* margin-top: 8px; */
        }
        .widget_background__half .bg {
            background-image: none;
            background: black;
        }
        .category-heading-section-demo {
            height: 300px !important;
            background-size: contain;
            background-image: url({{asset("gofar/images/bg/sunset.jfif")}});
            
        }
    </style>
    <script>
        function bayarClick(formId,text){
          Swal.fire({
            title: 'Yakin ingin bayar?',
            text: text?text:""+"Pembayaran tidak dapat dibatalkan",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, bayar sekarang',
            cancelButtonText: "Tidak, nanti saja"
          }).then((result) => {
            if (result.value) {
              $(formId).submit();
            }
          })
        }
      </script>

    <!-- PAGE WRAP -->
    <div id="page-wrap">
        <!-- PRELOADER -->
        <div class="preloader"></div>
        <!-- END / PRELOADER -->

        <!-- HEADER PAGE -->
        <header id="header-page">
            <div class="header-page__inner">
                <div class="container">
                    <!-- LOGO -->
                    <div class="logo">
                        <a href="/">
                            <h1 style="color: #2f990b;">WeMarket</h1>
                            {{-- <img  src="{{asset('gofar/images/logo.png')}}" alt=""> --}}
                        </a>
                    </div>
                    <!-- END / LOGO -->

                    <!-- NAVIGATION -->
                    <nav class="navigation awe-navigation" data-responsive="1200">
                        <ul class="menu-list">
                            <!-- start menu -->
                            <li class="menu-item-has-children">
                                @if (Session::has('login'))
                                <a href="#">

                                    <div style="">
                                        {{-- <div style="display:inline;"><img src="{{asset(Session::get('profil'))}}" alt=""
                                                style="max-height:40px; margin-right:10px; border-radius: 50%;"></div> --}}
                                        &nbsp;<span id="namaUser">{{Session::get('name')}}</span>
                                    </div>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="javascript:void(0)" style="color: #0091ea; font-size:15px; "></a>
                                    </li>
                                    {{-- <li >
                                        <a href="/admin">Admin</a>
                                    </li>                                     --}}
                                    {{-- <li class="menu-item-has-children">
                                        <a href="#">Histori Tiket</a>
                                        <ul class="sub-menu">
                                            <li><a href="/tiket/pesawat/history">Pesawat</a></li>
                                            <li><a href="/tiket/bus/history">Bus</a></li>
                                            <li><a href="/home/kereta/history">Kereta Api</a></li>
                                        </ul>
                                    </li> --}}
                                    <li>
                                        <a href="/">Switch to buyer</a>
                                    </li>
                                    <li>
                                        <a href="/logout">Logout</a>
                                    </li>
                                </ul>
                                @endif
                            </li>

                        </ul>
                    </nav>
                    <!-- END / NAVIGATION -->

                    <!-- SEARCH BOX -->
                    <div class="search-box">
                        <span class="searchtoggle"><i class="awe-icon awe-icon-search"></i></span>
                        <form class="form-search">
                            <div class="form-item">
                                <input type="text" value="Search &amp; hit enter">
                            </div>
                        </form>
                    </div>
                    <!-- END / SEARCH BOX -->


                    <!-- TOGGLE MENU RESPONSIVE -->
                    <a class="toggle-menu-responsive" href="#">
                        <div class="hamburger">
                            <span class="item item-1"></span>
                            <span class="item item-2"></span>
                            <span class="item item-3"></span>
                        </div>
                    </a>
                    <!-- END / TOGGLE MENU RESPONSIVE -->

                </div>
            </div>
        </header>
        <!-- END / HEADER PAGE -->

        <!-- LOAD JQUERY -->
        <script type="text/javascript" src="{{asset('gofar/js/lib/jquery-1.11.2.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('gofar/js/lib/masonry.pkgd.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('gofar/js/lib/jquery.parallax-1.1.3.js')}}"></script>
        <script type="text/javascript" src="{{asset('gofar/js/lib/jquery.owl.carousel.js')}}"></script>
        <script type="text/javascript" src="{{asset('gofar/js/lib/theia-sticky-sidebar.js')}}"></script>
        <script type="text/javascript" src="{{asset('gofar/js/lib/jquery.magnific-popup.min.js')}}"></script>
        <script type='text/javascript' src="{{asset('gofar/js/lib/jquery-ui.js')}}"></script>
        <script type="text/javascript" src="{{asset('gofar/js/scripts.js')}}"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        {{-- <script type="text/javascript" src="{{asset('base64/jquery.base64.min.js')}}"></script> --}}
        {{-- Axios --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
        <!-- HERO SECTION -->
        @yield('content')

        <!-- FOOTER PAGE -->
        <footer id="footer-page">
            <div class="container">
                <div class="row">
                    <!-- WIDGET -->
                    <div class="col-md-3">
                        <div class="widget widget_contact_info">
                            <div class="widget_background">
                                <div class="widget_background__half">
                                    <div class="bg"></div>
                                </div>
                                <div class="widget_background__half">
                                    <div class="bg"></div>
                                </div>
                            </div>
                            <div class="logo">
                                <img style="border-radius: 3px;" src="{{asset('gofar/images/img/logo.PNG')}}" alt="">
                            </div>
                            <div class="widget_content">
                                {{-- <p>25 California Avenue, Santa Monica, California. USA</p>
                                <p>+1-888-8765-1234</p>
                                <a href="#">contact@gofar.com</a> --}}
                            </div>
                        </div>
                    </div>
                    <!-- END / WIDGET -->

                    <!-- WIDGET -->
                    <div class="col-md-2">
                        <div class="widget widget_about_us">
                            <h3>About Us</h3>
                            {{-- <div class="widget_content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vel dignissim
                                    dolor. Ut risus orci, aliquam sit amet semper eget, egestas aliquam felis.</p>
                            </div> --}}
                        </div>
                    </div>
                    <!-- END / WIDGET -->

                    <!-- WIDGET -->
                    <div class="col-md-2">
                        <div class="widget widget_categories">
                            <h3>Categories</h3>
                            {{-- <ul>
                                <li><a href="#">Countries</a></li>
                                <li><a href="#">Regions</a></li>
                                <li><a href="#">Cities</a></li>
                                <li><a href="#">Districts</a></li>
                                <li><a href="#">Countries</a></li>
                                <li><a href="#">Airports</a></li>
                                <li><a href="#">Hotels</a></li>
                                <li><a href="#">Places of interest</a></li>
                            </ul> --}}
                        </div>
                    </div>
                    <!-- END / WIDGET -->

                    <!-- WIDGET -->
                    <div class="col-md-2">
                        <div class="widget widget_recent_entries">
                            {{-- <h3>Recent Blog</h3>
                            <ul>
                                <li><a href="#">Countries</a></li>
                                <li><a href="#">Regions</a></li>
                                <li><a href="#">Cities</a></li>
                                <li><a href="#">Districts</a></li>
                                <li><a href="#">Countries</a></li>
                                <li><a href="#">Airports</a></li>
                                <li><a href="#">Hotels</a></li>
                                <li><a href="#">Places of interest</a></li>
                            </ul> --}}
                        </div>
                    </div>
                    <!-- END / WIDGET -->

                    <!-- WIDGET -->
                    <div class="col-md-3">
                        <div class="widget widget_follow_us">
                            <div class="widget_content">
                                {{-- <p>For Special booking request, please call</p>
                                <span class="phone">099-099-000</span> --}}
                                <div class="awe-social">
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-youtube-play"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END / WIDGET -->
                </div>
                <div class="copyright">
                    <p>©2020 WEhouse™ All rights reserved.</p>
                </div>
            </div>
        </footer>
        <!-- END / FOOTER PAGE -->

    </div>
    <!-- END / PAGE WRAP -->

    <!-- REVOLUTION DEMO -->
    <script type="text/javascript" src="{{asset('gofar/revslider-demo/js/jquery.themepunch.revolution.min.js')}}">
    </script>
    <script type="text/javascript" src="{{asset('gofar/revslider-demo/js/jquery.themepunch.tools.min.js')}}"></script>
    <script type="text/javascript">
        if ($('#slider-revolution').length) {
            $('#slider-revolution').show().revolution({
                ottedOverlay: "none",
                delay: 10000,
                startwidth: 1600,
                startheight: 650,
                hideThumbs: 200,

                thumbWidth: 100,
                thumbHeight: 50,
                thumbAmount: 5,


                simplifyAll: "off",

                navigationType: "none",
                navigationArrows: "solo",
                navigationStyle: "preview4",

                touchenabled: "on",
                onHoverStop: "on",
                nextSlideOnWindowFocus: "off",

                swipe_threshold: 0.7,
                swipe_min_touches: 1,
                drag_block_vertical: false,

                parallax: "mouse",
                parallaxBgFreeze: "on",
                parallaxLevels: [7, 4, 3, 2, 5, 4, 3, 2, 1, 0],


                keyboardNavigation: "off",

                navigationHAlign: "center",
                navigationVAlign: "bottom",
                navigationHOffset: 0,
                navigationVOffset: 20,

                soloArrowLeftHalign: "left",
                soloArrowLeftValign: "center",
                soloArrowLeftHOffset: 20,
                soloArrowLeftVOffset: 0,

                soloArrowRightHalign: "right",
                soloArrowRightValign: "center",
                soloArrowRightHOffset: 20,
                soloArrowRightVOffset: 0,

                shadow: 0,
                fullWidth: "on",
                fullScreen: "off",

                spinner: "spinner2",

                stopLoop: "off",
                stopAfterLoops: -1,
                stopAtSlide: -1,

                shuffle: "off",

                autoHeight: "off",
                forceFullWidth: "off",



                hideThumbsOnMobile: "off",
                hideNavDelayOnMobile: 1500,
                hideBulletsOnMobile: "off",
                hideArrowsOnMobile: "off",
                hideThumbsUnderResolution: 0,

                hideSliderAtLimit: 0,
                hideCaptionAtLimit: 0,
                hideAllCaptionAtLilmit: 0,
                startWithSlide: 0
            });
        }
    </script>



</body>

</html>