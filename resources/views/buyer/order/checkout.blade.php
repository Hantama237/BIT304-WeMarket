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
            <h3>Checkout</h3>
            <div class="col-lg-12 box" style="padding-bottom: 20px;">
                @foreach ($shopProducts as $shop => $s)
                <div class="col-lg-12">
                    <h5>{{$shop}}</h5>
                    @foreach($s as $p)
                    <div class="col-lg-4">{{strlen($p->name)>25?substr($p->name,0,25)."..":$p->name}}</div>
                    <div class="col-lg-3"> Rp. {{number_format($p->price,0,',','.')}}</div>
                    <div class="col-lg-1">x{{$ammount[$p->id]}}</div>
                    <div class="col-lg-1">=</div>
                    <div class="col-lg-3" style="text-align: right;">{{number_format($p->price*$ammount[$p->id],0,',','.')}}</div>
                    <div class="col-lg-12"><hr></div>
                    @endforeach
                </div>
                @endforeach
                <form action="/checkout/proceed" method="POST">
                    @csrf
                    <div class="col-lg-6">
                        <h5>Please select delivery method</h5>
                    
                        <select required name="delivery_method" id="delivery_method">
                            <option value="take">Take</option>
                            <option selected value="deliver">Deliver</option>
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <h5>Please select payment method</h5>
                    
                        <select required name="payment_method" id="">
                            <option selected value="cod">Cash On Delivery(COD)</option>
                        </select>
                    </div>
                    <div id="addresses" class="col-lg-12">
                        <h5>Please select delivery address</h5>
                        @foreach ($addresses as $a)
                        <div class="col-lg-12">
                            <div class="col-lg-1">
                                <input checked="true" type="radio" name="address_id" value="{{$a->id}}">
                            </div>
                            <div class="col-lg-3">{{$a->postal_code}}, {{$a->subdistrict->subdistrict_name}}, {{$a->city->city_name}}</div>
                            <div class="col-lg-8">{{$a->address_detail}}</div>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="col-lg-12" style="text-align: right; margin-top:30px;">
                        <a href="/">
                            <button class="awe-btn">Cancel</button>
                        </a>
                        
                            <button class="awe-btn awe-btn-style3">
                                Order Now
                            </button>
                        
                    </div>
                </form>
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
