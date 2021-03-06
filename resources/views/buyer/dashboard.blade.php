@extends('base')
@section('main')

<style>
    #product-img{
        border-radius: 3px;
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        /* background-image: url('http://127.0.0.1:8000/images/user/1/TVD9ldkcG7.jpg'); */
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
        width: 62%;
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
        width: 35%;
        display: inline-block;
        text-align: right;
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
        <div class="col-lg-9">
            <h3>Search Products</h3>
            <div class="col-lg-12 box" style="padding-bottom: 20px;">
                <form action="{{URL::to("/search")}}" method="get">
                    <div class="col-lg-6">
                        <input name="keywords" style="width: 100%;" type="text" > 
                    </div>
                    <div style="padding-left:0px;" class="col-lg-6">
                        <button type="submit" class="awe-btn awe-btn-style3">Search</button> 
                        <a href="{{URL::to("/recommendation/form")}}"><button type="button"  class="awe-btn ">Recommendation</button></a>
                    </div>
                </form>
            </div>
            <h3>Special For You</h3>
            <div class="col-lg-12 box" style="margin-bottom:100px; padding-bottom: 20px;">
                @foreach ($products as $p)
                @php
                    $address = $p->shop->address;
                @endphp
                <a href="{{URL::to("/detail?id=".$p->id)}}">
                    <div class="product col-lg-3" >
                        <div style="width: 100%; height:120px; background-image:url('{{ url('/data_file/'.$p->picture) }}') ;" id="product-img" >
                            
                        </div>
                        <div class="product-name">{{strlen($p->name)>11?substr($p->name,0,11)."..":$p->name}}, {{$p->taste->taste}}</div>
                        <div class="product-location">{{$address->subdistrict->subdistrict_name}}, {{$address->city->city_name}}</div>
                        <div>
                            
                            <div class="product-price">Rp. {{number_format($p->price,0,',','.')}}</div>
                            <div class="product-stock">stock {{$p->stock}}</div>
                        </div>
                        
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        <span class="desktop">
            @include("components.buyer.sidebar")
        </span>
    </div>
</section>

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
