@extends('base')
@section('main')

<style>
    #product-img{
        border-radius: 3px;
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        background-image: url('http://127.0.0.1:8000/images/user/1/TVD9ldkcG7.jpg');
    }
    .product{
        border: 3px solid white;
        border-radius: 3px;
        padding-top: 10px;
        padding-bottom: 10px;
        background-color: #f2f2f2; 
        color: black;
    }
    .product:hover{
        cursor: pointer;
        background-color: #d1d1d1;
        border: 3px solid white;
    }
    .product-name{
        padding-top: 3px;
        font-weight:600;
    }
    .product-price{
        font-size: 16px;
        color: black;
        width: 67%;
        display: inline-block;
        text-align: left;
    }
    .product-location{
        width: 100%;
        text-align: left;
        color: gray;
        font-size: 13px;
    }
    .product-stock{
        font-size: 12px;
        color: green;
        width: 30%;
        display: inline-block;
        text-align: right;
    }
    
    .detail-picture{
        background-color: bisque;
        
        height: 300px;
    }
    .detail-description{
        margin-top: 5px;
        color: black;
    }
    .detail-price{
        margin-top: 10px;
        color: green;
        font-size: 20px;
        font-weight: 600;
    }
    .detail-purchase{
        margin-top:15px;
    }

    .detail-thumbnails{
        margin-top:10px;
        cursor: pointer;
    }
    .detail-thumbnail:hover{
        border-bottom: 2px solid gray;
    }
    .detail-thumbnail{
        height: 60px;
        background-color: bisque;
    }

    .shop-image{
        height:100px;
        border-radius: 100%;
        background-color: aqua;
    }

    table { 
        width: 100%; 
        border-collapse: collapse; 
    }
    /* Zebra striping */
    tr:nth-of-type(odd) { 
        background: #eee; 
    }
    th { 
        background: #333; 
        color: white; 
        font-weight: bold; 
    }
    td, th { 
        padding: 6px; 
        border: 1px solid #ccc; 
        text-align: left; 
    }
    @media only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

	/* Force table to not be like tables anymore */
	table, thead, tbody, th, td, tr { 
		display: block; 
	}
	
	/* Hide table headers (but not display: none;, for accessibility) */
	thead tr { 
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
	
	tr { border: 1px solid #ccc; }
	
	td { 
		/* Behave  like a "row" */
		border: none;
		border-bottom: 1px solid #eee; 
		position: relative;
		padding-left: 50%; 
	}
	
	td:before { 
		/* Now like a table header */
		position: absolute;
		/* Top/left values mimic padding */
		top: 6px;
		left: 6px;
		width: 45%; 
		padding-right: 10px; 
		white-space: nowrap;
	}
	
	/*
	Label the data
	*/
	td:nth-of-type(1):before { content: "Shop"; }
	td:nth-of-type(2):before { content: "Product"; }
	td:nth-of-type(3):before { content: "Order Date"; }
	td:nth-of-type(4):before { content: "Status"; }
	td:nth-of-type(5):before { content: "Delivery Method"; }
	td:nth-of-type(6):before { content: "Address"; }
    td:nth-of-type(7):before { content: ""; }
    }
</style>
<!-- LIST -->
<section>
    
    <div class="container">
        @if (session('message'))
            <div class="alert alert-danger">{{ session('message') }}</div>
        @endif
        <span class="mobile">
            @include("components.buyer.sidebar")
        </span>
        <div class="col-lg-9" style="margin-bottom: 100px;">
            <h3>Orders Detail</h3>
            <div class="col-lg-12 box" style="padding-bottom: 20px;">
               <h5 style="margin-bottom: 20px;">{{$order->shop->name}}</h5>
               @php
                   $totalPrice = 0;
               @endphp
               @foreach ($order->products as $prod)
               @php
                   $p = $prod->product;
                   $totalPrice+=$prod->price*$prod->quantity;
               @endphp
                   <div class="col-lg-12">
                        <div class="col-lg-4"><a href="/detail?id={{$p->id}}">{{strlen($p->name)>25?substr($p->name,0,25)."..":$p->name}} </a></div>
                        <div class="col-lg-3"> Rp. {{number_format($prod->price,0,',','.')}}</div>
                        <div class="col-lg-1">x{{$prod->quantity}}</div>
                        <div class="col-lg-1">=</div>
                        <div class="col-lg-3">{{number_format($p->price*$prod->quantity,0,',','.')}}</div>
                        <div class="col-lg-12"><hr></div>
                   </div>
               @endforeach
               <div class="col-lg-12" style="text-align: left; color:black; font-size:18px;">
                    <span>
                        Total Price Rp. {{number_format($totalPrice,0,',','.')}}
                    </span>
                </div>
                <div class="col-lg-12"><hr></div>
                <h5>{{$order->delivery_method=="deliver"?"Receive":"Pick Up"}} Address</h5>
                <div class="col-lg-12">
                    {{$order->address}}
                </div>
                <div class="col-lg-12"><hr></div>
                <div class="col-lg-6 row">
                    <h5 style="">Status</h5>
                    <div class="col-lg-12">
                        {{$order->status}}
                    </div>
                </div>
                <div class="col-lg-6 row">
                    <h5>Order Date</h5>
                    <div class="col-lg-12">
                        {{$order->order_date}}
                    </div>
                </div>

                <div class="col-lg-12"><hr></div>
                <div class="col-lg-12" style="text-align: right;">
                    <button class="awe-btn awe-btn-style3">Confirm Received</button>
                </div>
            </div>     
            
        </div>
        <span class="desktop">
            @include("components.buyer.sidebar")
        </span>
    </div>
</section>
<script>
    $('#delivery_method').on('change', function() {
        if(this.value == 'take'){
            $('#addresses').css({"display":"none"});
        }else{
            $('#addresses').css({"display":"block"});
        }
    });
</script>
{{-- Modal --}}
<!-- Modal -->
<style>
    .modal-body input{
        width: 100%;
        margin-bottom: 10px;
    }
</style>
<div style="z-index:999999" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Submit Application</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/residences/apply" method="POST">
            <div class="modal-body">
                <div class="row">
                    {{-- <div class="col-xs-12"><input type="text" disabled name="application_date" class="awe-calendar" value="Today" placeholder="Today"></div> --}}
                    <div class="col-xs-6"><input type="number" name="required_year" id="required_year" value="{{old("required_year")}}" placeholder="Required year"></div>
                    <div class="col-xs-6"><input type="number" name="required_month" id="required_month" value="{{old("required_month")}}" placeholder="Required month"></div>
                    <div class="col-xs-12"><label for="residence_name">Residence</label></div>
                    <div class="col-xs-12"><input type="text" readonly aria-readonly="true" name="residence_name" id="residence_name" value="{{old("residence_name")}}" placeholder="Please re-apply"></div>
                    <input type="hidden" readonly aria-readonly="true" name="residence_id" id="residence_id" value="{{old("residence_id")}}" placeholder="Please re-apply">
                    @csrf
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="awe-btn" data-dismiss="modal">Close</button>
                <button type="submit" class="awe-btn awe-btn-style3">Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>
{{-- End Model --}}
<!-- END / SEARCH TABS -->
<script>
    function updateModal(id,name){
        $("#residence_id").val(id);
        $("#residence_name").val(name);
    }
</script>

@endsection
