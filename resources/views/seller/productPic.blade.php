@extends('basesell')
@section('main')

<style>
  .borderIn {
    border-right:1px solid gray;
    height: 170px;
  }
  @media screen and (max-width: 700px) {
    .borderIn {
    border-bottom:1px solid gray;
    border-right:0px solid gray;
    height: 170px;
  }
  #preview-profile{
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
        }
  }
  
  
  </style> 
				
<div class="container" style="margin-bottom: 5%;">
  @if(count($errors) > 0)
				<div class="alert alert-danger">
					@foreach ($errors->all() as $error)
					{{ $error }} <br/>
					@endforeach
				</div>
        @endif
        @if(session('success'))
        <div class="alert alert-success">
              {{session('success')}}
        </div>
          @endif
<div class="col-lg-9 box">
  <div class="col-lg-3">
    <h3></h3>
    {{-- <h3>Menu</h3> --}}
    <div class="col-lg-12 box borderIn">
        Menu
        <ul>
          <li><a href="{{URL::to("/seller/dashboard")}}">Home</a></li>
          <li><a href="{{URL::to("/seller/product"))}}">Products</a></li>
          <li><a href="{{URL::to("/seller/order")}}">Orders</a></li>
        </ul>
    </div>
</div>
  <div class="col-lg-6 box">
    <h4>Add Product Picture</h4>
<form action="{{URL::to("/seller/addPicture")}}" method="POST" enctype="multipart/form-data" class="col-lg-16 box">
    {{ csrf_field() }}

 
          <label for="">You can add multiple picture of product</label>
          {{-- </div> --}}
          @foreach($shop1 as $sp)
          <input type="hidden"  name="shop_id" id="first_name" class="form-control" value="{{$sp->shop_id}}" >
          @endforeach
          
          <b>Product picture</b>                      
          <div class="input-group control-group increment" >
            <input type="file" name="filename[]" class="form-control">
            <div class="input-group-btn"> 
              <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
            </div>
          </div>
          <div class="clone hide">
            <div class="control-group input-group" style="margin-top:10px">
              <input type="file" name="filename[]" class="form-control">
              <div class="input-group-btn"> 
                <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
              </div>
            </div>
          </div>
          	  
          <input type="submit" value="submit" class="btn btn-primary">
        
        </div> 
      </div>
    </form>
    <script>
      
    $(document).ready(function() {
      $(".btn-success").click(function(){ 
          var html = $(".clone").html();
          $(".increment").after(html);
      });
      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".control-group").remove();
      });
    });
      
  </script>
        <span class="desktop">
            {{-- @include("components.buyer.sidebar") --}}
            <div class="w3-card w3-round w3-white box col-lg-3 box" style=" border:solid gray 1px;">
              {{-- <p style="float: right;">verified</p>   --}}
              <div class="w3-container">
                <p style="float: right;">verified</p>
                 <h4 class="w3-center">Shop info</h4>
                 {{-- <p style="float: right;">verified</p> --}}
            
                 <hr>
                 @foreach($shop1 as $p)
                 {{-- <p class="w3-center"></p> --}}
               
                   {{-- <img width="150px" style="round:50%" src="{{ url('/data_file/'.$p->idcard_picture) }}"> --}}
                   <div style="text-align: center;">
                   <img width="150px" height="150px" style="align-content: center" class="img-circle" src="{{ url('/data_file/'.$p->idcard_picture) }}" alt="picture">
                   </div>
                 <p> {{$p->name}}</p>
                 <p></i> {{$p->description}}</p>
                 <div style="text-align: center;">
                 <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i><a href="{{URL::to("/seller/update")}}">edit</a> </p>
                </div>
                 @endforeach
                 {{--<i class="fa fa-home fa-fw w3-margin-right w3-text-theme"> <i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i> --}}
                </div>
              </div>
        </span>
    </div> 
@endsection