@extends('basesell')
@section('main')

				
<div class="container" style="margin-bottom: 5%;">
  @if(count($errors) > 0)
				<div class="alert alert-danger">
					@foreach ($errors->all() as $error)
					{{ $error }} <br/>
					@endforeach
				</div>
				@endif
<div class="col-lg-9 box">
    <h4>Manage shop information</h4>
<form action="/seller/process" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    @foreach($shop as $sp)
          {{-- <div class="row"> --}}
              {{-- <div class="col-xs-12 col-sm-4 col-md-4"> --}}
                  <label for="">Shop name</label>
                  <div class="form-group">
                      <input type="text" name="name" id="first_name" class="form-control" placeholder="{{$sp->name}}" >
                  </div>
              {{-- </div> --}}
              <input type="text"  name="user_id" id="first_name" class="form-control" value="{{$sp->user_id}}" >
              
          {{-- </div> --}}
          
          {{-- <div class="form-group">
              <input type="email" name="email" id="email" class="form-control " placeholder="Email Address" >
          </div> --}}
          <label for="">description</label>
          <div class="form-group">
              <input type="text" name="description" id="desc" class="form-control " placeholder="{{$sp->description}}" >
          </div>
          
          {{-- <div class="form-group">
            <b>KTP</b><br>
            <input type="file" name="KTP">
          </div>
          <div class="form-group">
            <b>SIM</b><br>
            <input type="file" name="sim">
          </div>
          <div class="form-group">
            <b>SKCK</b><br>
            <input type="file" name="skck">
          </div>
          <div class="form-group">
            <b>STNK</b><br>
            <input type="file" name="stnk">
          </div> --}}
          <div class="form-group">
            <b>Change profile</b><br>
            <input type="file" name="idcard_picture">
          </div>                       
          @endforeach			  
          <input type="submit" value="submit" class="btn btn-primary">
        
        </div> 
        <span class="desktop">
            {{-- @include("components.buyer.sidebar") --}}
            <div class="w3-card w3-round w3-white box">
              {{-- <p style="float: right;">verified</p>   --}}
              <div class="w3-container">
                <p style="float: right;">verified</p>
                 <h4 class="w3-center">Shop info</h4>
                 {{-- <p style="float: right;">verified</p> --}}
            
                 <hr>
                 @foreach($shop as $sp)
                 <p class="w3-center"></p>
                   <img width="150px" src="{{ url('/data_file/'.$sp->idcard_picture) }}">
 
                 <p> {{$sp->name}}</p>
                 <p></i> {{$sp->description}}</p>
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