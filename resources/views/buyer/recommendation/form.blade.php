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
            <h3>Please Answer All Question</h3>
            <div class="col-lg-12 box" style="padding-bottom: 20px; color: black;">
                <form action="{{URL::to("/recommendation")}}" method="GET">
                    <div class="col-lg-12" style="margin-bottom: 20px;">
                        <span style="font-weight: 600; font-size:20px; color:black; ">
                            Which of these are you looking for?
                        </span>
                    </div>
                    @foreach ($category as $c)
                    <div class="col-lg-12">
                        <input required type="radio" name="category" id="{{$c->category}}" value="{{$c->id}}">
                        <label for="{{$c->category}}">{{$c->category}}</label>
                    </div>
                    @endforeach
                    

                    <hr class="col-lg-12">
                    <div class="col-lg-12" style="margin-bottom: 20px;">
                        <span style="font-weight: 600; font-size:20px; color:black; ">
                            Which taste you might be looking for?
                        </span>
                    </div>
                    
                    @foreach ($taste as $t)
                    <div class="col-lg-12">
                        <input required type="radio" name="taste" id="{{$t->taste}}" value="{{$t->id}}">
                        <label for="{{$t->taste}}">{{$t->taste}}</label>
                    </div>
                    @endforeach
                    
                    <hr class="col-lg-12">
                    <div class="col-lg-12" style="margin-bottom: 20px;">
                        <span style="font-weight: 600; font-size:20px; color:black; ">
                            In scale 1 to 5 how strong the taste you prefered?
                        </span>
                    </div>
                    <div class="col-lg-4">
                        <input required type="range" name="taste_level" id="" min="0" max="5">
                    </div>

                    <hr class="col-lg-12">
                    <div class="col-lg-12" style="margin-bottom: 20px;">
                        <span style="font-weight: 600; font-size:20px; color:black; ">
                            What is your opinion about price?
                        </span>
                    </div>
                    <div class="col-lg-12">
                        <input required type="radio" name="price" id="low" value="0">
                        <label for="low">Lowest price is best</label>
                    </div>
                    <div class="col-lg-12">
                        <input required type="radio" name="price" id="med" value="1">
                        <label for="med">Price sometimes reflect quality</label>
                    </div>
                    <div class="col-lg-12">
                        <input required type="radio" name="price" id="high" value="2">
                        <label for="high">Higher the better</label>
                    </div>
                    <div class="col-lg-12" style="margin-top: 30px; text-align:right;">
                        <a href="{{URL::to("/")}}"><button type="button" class="awe-btn">Cancel</button></a>
                        <button type="submit" class="awe-btn awe-btn-style3">Submit</button>
                    </div>
                </form>
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

{{-- End Model --}}
<!-- END / SEARCH TABS -->
<script>
    function updateModal(id,name){
        $("#residence_id").val(id);
        $("#residence_name").val(name);
    }
</script>

@endsection
