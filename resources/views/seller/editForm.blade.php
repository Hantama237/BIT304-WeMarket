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
            <li><a href="/seller/dashboard">Home</a></li>
            <li><a href="/seller/product">Products</a></li>
            <li><a href="/">Orders</a></li>
        </ul>
    </div>
</div>
  <div class="col-lg-6 box">
    <h4>Add Product</h4>
  <form action="/seller/editProcess/{{$product->id}}" method="POST" enctype="multipart/form-data" class="col-lg-16 box">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
         {{-- @foreach($product as $pr) --}}
          {{-- <div class="row"> --}}
              {{-- <div class="col-xs-12 col-sm-4 col-md-4"> --}}
                  <label for="">Product name</label>
                  <div class="form-group">
                  <input type="text" name="name" id="first_name" class="form-control" placeholder="{{$product->name}}">
                  </div>
              {{-- </div> --}}
              
              
          {{-- </div> --}}
          
          <input type="hidden"  name="shop_id" id="first_name" class="form-control" value="{{$product->shop_id}}" >
          
          {{-- <div class="form-group">
              <input type="email" name="email" id="email" class="form-control " placeholder="Email Address" >
          </div> --}}
          <label for="">Description</label>
          <div class="form-group">
          <input type="text" name="description" id="desc" class="form-control " placeholder="{{$product->description}}" >
          </div>
          <label for="">Price</label>
          <div class="form-group">
          <input type="number" name="price" id="num" class="form-control " placeholder="{{$product->price}}">
          </div>
          <label for="">Stock</label>
          <div class="form-group">
          <input type="number" name="stock" id="num" class="form-control " placeholder="{{$product->stock}}">
          </div>
         
       
          <div class="form-group">
            <b>Change picture</b><br>
            <img src="{{ url('/data_file/'.$product->picture) }}" alt="Picture">
            <input type="file" name="picture">
          </div>                       
          {{-- @endforeach	   --}}
          <input type="submit" value="submit" class="btn btn-primary">
        
        </div> 
      </div>
    </form>
    <script>
      function readURL(input) {
          console.log("changed");
          if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function(e) {
                  console.log(e.target.result)
                  $('#preview-profile').css('background-image', 'url(' +  e.target.result + ')');
                  // $('#preview-profile').text("Preview");
              }
              
              reader.readAsDataURL(input.files[0]); // convert to base64 string
          }
      }
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
                 @foreach($shop as $p)
                 {{-- <p class="w3-center"></p> --}}
               
                   {{-- <img width="150px" style="round:50%" src="{{ url('/data_file/'.$p->idcard_picture) }}"> --}}
                   <div style="text-align: center;">
                   <img width="150px" height="150px" style="align-content: center" class="img-circle" src="{{ url('/data_file/'.$p->idcard_picture) }}" alt="picture">
                   </div>
                 <p> {{$p->name}}</p>
                 <p></i> {{$p->description}}</p>
                 <div style="text-align: center;">
                 <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i><a href="/seller/update">edit</a> </p>
                </div>
                 @endforeach
                 {{--<i class="fa fa-home fa-fw w3-margin-right w3-text-theme"> <i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i> --}}
                </div>
              </div>
        </span>
    </div> 
@endsection