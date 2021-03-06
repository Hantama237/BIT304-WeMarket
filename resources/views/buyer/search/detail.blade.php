@extends('base')
@section('main')


<style>
    #product-img{
        border-radius: 3px;
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
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
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
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
        border-bottom: 2px solid white;
    }
    .detail-thumbnail{
        height: 60px;
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        background-color: bisque;
    }

    .shop-image{
        height:100px;
        border-radius: 100%;
        background-color: aqua;
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
    }
    .hidden{
        display: none;
    }
</style>
<!-- LIST -->
<section>
    
    <div class="container">
        <span class="mobile">
            @include("components.buyer.sidebar")
        </span>
        <div class="col-lg-9">
            <h3>Product Detail</h3>
            <div class="col-lg-12 box" style="padding-bottom: 20px;">
                <div class="col-md-6 ">
                    <div id="detail-picture1" class="col-lg-12 detail-picture" style="background-image:url('{{ url('/data_file/'.$product->picture) }}') ">
                        {{-- image --}}
                    </div>
                    @if($product->pictures()->first()!==null)
                    @php
                        $id = 1;
                    @endphp
                        @foreach (json_decode($product->pictures()->first()->filename) as $p)
                            
                            <div id="detail-picture{{++$id}}" class="col-lg-12 detail-picture" style="background-image:url('{{ asset('/image/'.$p) }}'); display:none;">
                                {{-- image --}}
                            </div>
                        @endforeach
                       @endif
                    <div class="col-lg-12 row detail-thumbnails">
                        <div onclick="updateThumbnail('detail-picture1')" class="col-xs-3 detail-thumbnail" style="background-image:url('{{ url('/data_file/'.$product->picture) }}') "></div>
                       @if($product->pictures()->first()!==null)
                        @php
                            $id = 1;
                        @endphp
                        @foreach (json_decode($product->pictures()->first()->filename) as $p)
                            <div onclick="updateThumbnail('detail-picture{{++$id}}')" class="col-xs-3 detail-thumbnail" style="background-image:url('{{ asset('/image/'.$p) }}') "></div>
                        @endforeach
                       @endif
                        
                    </div>
                </div>
                <div class="col-md-6 detail-info">
                    <h5>{{$product->name}}</h5>
                    <div>Stock {{$product->stock}} | Sold {{$product->sold}}</div>
                    <div class="detail-description">
                        {{$product->description}}
                    </div>
                    <div class="detail-price">Rp. {{number_format($product->price,0,',','.')}}</div>
                    <div class="detail-purchase">
                        <div class="col-md-6" style="padding-left: 0px; padding-right:5px;"><button class="col-lg-12 awe-btn  awe-btn-style3" data-toggle="modal" data-target="#addToCartModal">Add To cart</button></div>
                        <div class="col-md-6" style="padding-right 0px; padding-left: 5px;"><button class="col-lg-12 awe-btn">Buy Now</button></div>
                        
                        
                    </div>
                </div>
            </div>

            <div class="col-lg-12 box" style="margin-top:20px; margin-bottom:20px; padding-bottom:15px;">
                <div class="col-xs-2">
                <div class="shop-image" style="background-image:url('{{ url('/data_file/'.$shop->idcard_picture) }}') ">
                    {{-- Background Image --}}
                    </div>
                </div>
                <div class="col-xs-4">
                    <h5>{{$shop->name}}</h5>
                    <span>{{$shop->description}}</span>
                </div>
                <div class="col-xs-6" style="text-align: right;  padding-top:10px;">
                    <a href="https://api.whatsapp.com/send?phone=62081326892496"><button>Contact Seller</button></a>
                    {{-- <button>Visit Shop</button> --}}
                </div>
            </div>
            
            <div class="col-lg-12 box" style="margin-bottom:100px; padding-bottom:20px;">
                <h5>Also from this shop</h5>
                @foreach ($products as $p)
                @php
                    $address = $p->shop->address;
                @endphp
                <a href="{{URL::to("/detail?id=".$p->id)}}">
                    <div class="product col-lg-3" >
                        <div style="width: 100%; height:120px; background-image:url('{{ url('/data_file/'.$p->picture) }}') ;" id="product-img">
                            
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
                <div class="col-lg-12">
                    {!!$pagination !!}
                </div>
                
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
<div style="z-index:999999" class="modal fade" id="addToCartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Product Quantity</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{URL::to("/cart/add")}}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="row">
                    {{-- <div class="col-xs-12"><input type="text" disabled name="application_date" class="awe-calendar" value="Today" placeholder="Today"></div> --}}
                    <input type="hidden" name="id" value="{{$product->id}}">
                    <input type="hidden" name="price" value="{{$product->price}}">
                    <div class="col-xs-12"><label for="ammount">Amount</label></div>
                    <div class="col-xs-6"><input required type="number" name="ammount" id="item_ammount" value="{{old("ammount")}}" placeholder="Ammount eg. 10"></div>
                    
                    <input type="hidden" readonly aria-readonly="true" name="residence_id" id="residence_id" value="{{old("residence_id")}}" placeholder="Please re-apply">
                    @csrf
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="awe-btn" data-dismiss="modal">Close</button>
                <button type="submit" class="awe-btn awe-btn-style3">Add to cart</button>
            </div>
        </form>
      </div>
    </div>
  </div>
{{-- End Model --}}
<!-- END / SEARCH TABS -->
<script>
    var max = {!!$product->stock!!};
    function updateModal(id,name){
        $("#residence_id").val(id);
        $("#residence_name").val(name);
    }
    //$('detail-picture')
    function updateThumbnail(id){
        $('.detail-picture').css({"display":"none"})
        $("#"+id).css({"display":"block"})
    }
    $('#item_ammount').change(function(){
        console.log($('#item_ammount').val());
        if($('#item_ammount').val() > max){
            $('#item_ammount').val(null);
            alert('Stock is less than the desired ammount')
        }
    })
</script>

@endsection
