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
<!-- LIST -->
<section>
    
    <div class="container" style="margin-bottom: 5%;">
        
        
        <div class="col-lg-9 box" >
          <h3>Seller dashboard</h3>
            <div class="col-lg-3">
                <h3></h3>
                {{-- <h3>Menu</h3> --}}
                <div class="col-lg-12 box borderIn" >
                    Menu
                    <ul>
                        <li><a style="disabled" href="{{URL::to("/seller/dashboard")}}">Home</a></li>
                        <li><a href="#">Products</a></li>
                        <li><a href="#">Orders</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                {{-- <h3></h3>
                <div class="grid-container">
                    <div class="grid-item">
                        <h3>0</h3>
                        <p>Order</p>
                    </div>
                    <div class="grid-item">
                        <h3>3</h3>
                        <p>products</p>
                    </div>
                    <div class="grid-item">
                        <h3>3</h3>
                        <P>sold</P>
                    </div>  
                  
                  </div> --}}
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
                  <form action="{{URL::to("/seller/process")}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    @foreach($shop1 as $sp)
                          
                                <p>Please fill the form to complete the registration</p>
                                  <div class="form-group">
                                      <input type="hidden" name="name" id="first_name" class="form-control" value="{{$sp->name}}" >
                                  </div>
                              
                              <input type="hidden"  name="user_id" id="first_name" class="form-control" value="{{$sp->user_id}}" >
                              
                     
                         
                          <div class="form-group">
                              <input type="hidden" name="description" id="desc" class="form-control " value="{{$sp->description}}" >
                          </div>
                          
                          
                        
                          <div class="form-group">
                            <b>Upload ID-card</b><br>
                            <input type="file" name="idcard_picture">
                          </div>                       
                          @endforeach			  
                          <input type="submit" value="submit" class="btn btn-primary">
                        
              
            </div>
        </div>

        <span class="desktop">
          {{-- @include("components.buyer.sidebar") --}}
          <div class="w3-card w3-round w3-white box col-lg-3 box" style=" border:solid gray 1px;">
            {{-- <p style="float: right;">verified</p>   --}}
            <div class="w3-container">
              @foreach($shop1 as $p)
             
            <p style="float: right;">unverified</p>
               <h4 class="w3-center">Shop info</h4>
               {{-- <p style="float: right;">verified</p> --}}
          
               <hr>
               
               {{-- <p class="w3-center"></p> --}}
             
                 {{-- <img width="150px" style="round:50%" src="{{ url('/data_file/'.$p->idcard_picture) }}"> --}}
                 <div style="text-align: center;">
                 <img width="150px" height="150px" style="align-content: center" class="img-circle" src="" alt="picture">
                 </div>
               <p> {{$p->name}}</p>
               <p></i> {{$p->description}}</p>
               <div style="text-align: center;">
               <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i><a href="#">edit</a> </p>
              </div>
               @endforeach
               {{--<i class="fa fa-home fa-fw w3-margin-right w3-text-theme"> <i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i> --}}
              </div>
            </div>
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
