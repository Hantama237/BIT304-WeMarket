@extends('master')
@section('content')

    <!-- HEADING PAGE -->
    <section class="awe-parallax category-heading-section-demo" style="height: 200px;">
        <div class="awe-overlay"></div>
        <div class="container">
            <div class="category-heading-content category-heading-content__2 text-uppercase">
                
            </div>
        </div>
    </section>
    <style>
        .box {
            background-color: white;
            padding-top: 20px;
        }
        .modal-header .close {
            margin-top: -30px;
        }
        .modal-content{
            box-shadow: none;
            border-radius: 0px;
            margin-top: 100px;
        }
    
    </style>
    <style>
        .flight-item,
        .trip-item,
        .attraction-item,
        .hotel-item {
            min-height: 0px;
        }

        .flight-item .item-price-more a {
            margin-top: 5px;
        }

        .flight-item {
            background-color: #f9f9f9;
            /* border: 2px solid #eee; */
        }

        .flight-item .item-body {
            width: 80%;
            padding: 15px 0px;
            color: #666;
        }

        select {
            width: 80%;
            margin-bottom: 5px;
        }

        .flight-item .item-price-more {
            padding: 0px 30px;
            margin: 10px 0px;
        }

        .flight-item .item-price-more .price .amount {
            font-size: 20px;
        }

        .item-title {
            font-weight: 700;
            font-size: 20px;
        }

        /* .col-xs-6.left {} */

        .item-body .right {
            text-align: right;
        }

        .col-xs-12.bottom {
            margin-top: 10px;
        }

        .mobile {
            display: none;
        }

        .desktop {
            display: block;
        }

        @media screen and (max-width: 600px) {
            .flight-item {
                text-align: center;
            }

            .flight-item .item-body {
                width: 100%;
                padding: 15px 0px;
                color: #666;
            }

            .awe-btn,
            select {
                width: 100% !important;
            }

            .mobile {
                display: block;
            }

            .desktop {
                display: none;
            }
        }

    </style>
    <!-- END / HEADING PAGE -->
    <!-- HERO SECTION -->
    {{-- <section class="hero-section">
        <div id="slider-revolution">
            <ul>
                <li data-slotamount="7" data-masterspeed="500" data-title="Slide title 1">
                    <img src="{{asset("gofar/images/bg/1.jpg")}}" data-bgposition="left center" data-duration="14000" data-bgpositionend="right center" alt="">

                    <div class="tp-caption sfb fadeout slider-caption-sub slider-caption-sub-1" data-x="500" data-y="230" data-speed="700" data-start="1500" data-easing="easeOutBack">
                      Last minute deal
                    </div>

                    <div class="tp-caption sfb fadeout slider-caption slider-caption-1" data-x="center" data-y="280" data-speed="700" data-easing="easeOutBack"  data-start="2000">Top discount Paris Hotels</div>
                    
                    <a href="#" class="tp-caption sfb fadeout awe-btn awe-btn-style3 awe-btn-slider" data-x="center" data-y="380" data-easing="easeOutBack" data-speed="700" data-start="2200">Book now</a>
                </li> 

                <li data-slotamount="7" data-masterspeed="500" data-title="Slide title 2">
                    <img src="{{asset("gofarimages/bg/2.jpg")}}" data-bgposition="left center" data-duration="14000" data-bgpositionend="right center" alt="">

                    <div class="tp-caption  sft fadeout slider-caption-sub slider-caption-sub-2" data-x="center" data-y="220" data-speed="700" data-start="1500" data-easing="easeOutBack">
                      Check out the top weekly destination
                    </div>

                    <div class="tp-caption sft fadeout slider-caption slider-caption-2" data-x="center" data-y="260" data-speed="700" data-easing="easeOutBack"  data-start="2000">
                        Travel with us
                    </div>
                    
                    <a href="#" class="tp-caption sft fadeout awe-btn awe-btn-style3 awe-btn-slider" data-x="center" data-y="370" data-easing="easeOutBack" data-speed="700" data-start="2200">Book now</a>
                </li>

                <li data-slotamount="7" data-masterspeed="500" data-title="Slide title 3">
                    <img src="{{asset("gofarimages/bg/3.jpg")}}" data-bgposition="left center" data-duration="14000" data-bgpositionend="right center" alt="">

                    <div class="tp-caption lfl fadeout slider-caption slider-caption-3" data-x="center" data-y="260" data-speed="700" data-easing="easeOutBack"  data-start="1500">
                        Gofar
                    </div>
                    
                    <div href="#" class="tp-caption lfr fadeout slider-caption-sub slider-caption-sub-3" data-x="center" data-y="365" data-easing="easeOutBack" data-speed="700" data-start="2000">Take you to every corner of the world</div>
                </li> 

            </ul>
        </div>
    </section> --}}
    @yield('main')
    <!-- END / HERO SECTION -->
@endsection