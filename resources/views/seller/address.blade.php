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
        
<div class="col-lg-9 box">
  <div class="col-lg-3">
    <h3></h3>
    {{-- <h3>Menu</h3> --}}
    <div class="col-lg-12 box borderIn">
        Menu
        <ul>
            <li><a href="/seller/dashboard">Home</a></li>
            <li><a href="/seller/product">Products</a></li>
            <li><a href="/seller/order">Orders</a></li>
        </ul>
    </div>
</div>
  <div class="col-lg-6 box">
    <h4>Update Shop Address</h4>
<form action="/seller/update/address" method="POST" >
    @csrf
   
          {{-- <div class="row"> --}}
              {{-- <div class="col-xs-12 col-sm-4 col-md-4"> --}}
                <div class="form-group">
                  <label for="">Province</label><br>
                    <select name="province_id" id="province" value="{{$address->province_id}}">
                        {!!$province!!}
                    </select>
                </div>  
                <div class="form-group">
                    <label for="">City</label><br>
                      <select name="city_id" id="city" value="{{$address->city_id}}">
                          {!!$city!!}
                      </select>
                  </div>  
                  <div class="form-group">
                    <label for="">Subdistric</label><br>
                      <select name="subdistrict_id" id="subdistrict" value="{{$address->subdistrict_id}}">
                        {!!$subdistrict!!}
                      </select>
                  </div>
                <div class="form-group">
                    <label for="">Postal Code</label><br>
                    <input type="text" name="postal_code" id="" value="{{$address->postal_code}}">    
                </div>
                <div class="form-group">
                    <label for="">Address</label> <br>
                    <textarea name="address_detail" id="address_detail" cols="20" rows="10">{{$address->address_detail}}</textarea>    
                </div>

              {{-- </div> --}}
              {{-- <input type="hidden"  name="user_id" id="first_name" class="form-control" value="{{$sp->user_id}}" > --}}
            
          <input type="submit" value="Save" class="btn btn-primary"> <a href="/seller/update"><button type="button"  style="margin-left: 10px" class="btn">cancel</button></a> 
        
        </div> 
      </div>
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
                  <img width="150px" height="150px" style="border-radius: 50%;" src="{{ url('/data_file/'.$p->idcard_picture) }}" alt="picture">
              
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
    <script>
      $(document).ready(()=>{
        $('#province').val("{!!$address->province_id!!}")
        $('#city').val("{!!$address->city_id!!}")
        $('#subdistrict').val('{!!$address->subdistrict_id!!}')
        function getKabupaten(idprovinsi){
            $.get("/api/city/"+idprovinsi,{},(data)=>{
                updateKabupaten(data);
            },"html")
        }
        function getKecamatan(idkecamatan){
            $.get("/api/subdistrict/"+idkecamatan,{},(data)=>{
                updateKecamatan(data);
            },"html");
        }
        function updateKabupaten(data){
            $("#city").html(data);
        }
        function updateKecamatan(data){
            $("#subdistrict").html(data);
        }
        
        $("#province").change(()=>{
            getKabupaten($("#province").val());
        })
        $("#city").change(()=>{
            getKecamatan($("#city").val());
        })


    })
    </script>
@endsection