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
    @php
        $cart = Session::get('cart');
        $totalPrice = 0;
    @endphp
    <div style="z-index:9999" class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">My Cart</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="/checkout" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        @if($cart!=null)
                            @foreach ($cart as $c)
                            @php
                                $totalPrice +=$c['price']*$c['ammount'];
                            @endphp
                            <div class="col-xs-1"><input checked="true" type="checkbox" name="id[]" id="" value="{{$c['id']}}"></div>
                            <div class="col-lg-4"><a href="/detail?id={{$c['id']}}">{{strlen($c['name'])>25?substr($c['name'],0,25)."..":$c['name']}} </a></div>
                            <div class="col-lg-3"> Rp. {{number_format($c['price'],0,',','.')}}</div>
                            <div class="col-lg-1">x{{$c['ammount']}}</div>
                            <div class="col-lg-3"><button onclick="updateEditCartModal({!!$c['id']!!})" data-toggle="modal" data-target="#editCartModal" >edit</button> <a href="/cart/remove?id={{$c['id']}}"><button>hapus</button></a></div>
                            <div class="col-lg-12"><hr></div>
                            @endforeach
                        @else
                        No Product in cart
                        @endif
                        <div class="col-lg-12" style="text-align: right;">
                            <span style="font-weight:600;">
                                Total price: Rp. {{number_format($totalPrice,0,',','.')}}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="awe-btn" data-dismiss="modal">Close</button>
                    <button   class="awe-btn awe-btn-style3">Check Out</button>
                </div>
            </form>
          </div>
        </div>
      </div>
      <script>
          function updateEditCartModal(id){
              $('#editCartId').val(id);
          }
      </script>
      <div style="z-index:999999" class="modal fade" id="editCartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Ammount</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="/cart/set" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        {{-- <div class="col-xs-12"><input type="text" disabled name="application_date" class="awe-calendar" value="Today" placeholder="Today"></div> --}}
                        <input id="editCartId" type="hidden" name="id" value="">
                        <div class="col-xs-12"><label for="ammount">Ammount</label></div>
                        <div class="col-xs-6"><input required type="number" name="ammount" id="item_ammount" value="{{old("ammount")}}" placeholder="new ammount"></div>
                        
                        <input type="hidden" readonly aria-readonly="true" name="residence_id" id="residence_id" value="{{old("residence_id")}}" placeholder="Please re-apply">
                        @csrf
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="awe-btn" data-dismiss="modal">Close</button>
                    <button type="submit" class="awe-btn awe-btn-style3">Update</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    <!-- END / HERO SECTION -->
@endsection