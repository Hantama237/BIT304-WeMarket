@extends('basesell')
@section('main')

{{-- <style>
    .grid-container {
      display: grid;
      grid-column-gap: 30px;
      grid-template-columns: auto auto auto;
      background-color: white;
      padding: 10px;
    }
    
    .grid-item {
      background-color: white;
      border: 1px solid rgba(0, 0, 0, 0.8);
      padding-left: 10px;
      padding-right: 10px;
      padding-top: 30px;
      padding-bottom: 30px;
      font-size: 15px;
      text-align: center;
    }
    </style> --}}
<!-- LIST -->
<section>
    
    <div class="container">
        <span class="mobile">
            @include("components.buyer.sidebar")
        </span>
        
        <div class="col-lg-9 box">
          <h3>Seller dashboard</h3>
            <div class="col-lg-3">
                <h3></h3>
                {{-- <h3>Menu</h3> --}}
                <div class="col-lg-12 box" style="height: 170px; border-right:1px solid gray;">
                    Menu
                    <ul>
                        <li><a href="/seller/dashboard">Home</a></li>
                        <li><a href="/">Products</a></li>
                        <li><a href="/">Orders</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-5">
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
                  <div class="col-lg-4">
                    <h3>0</h3>
                    <p>Order</p>
                  </div>
                  <div class="col-lg-4">
                    <h3>5</h3>
                    <p>Products</p>
                  </div>
                  <div class="col-lg-4">
                    <h3>3</h3>
                    <p>Products sold</p>
                  </div>
              
            </div>
        </div>

        <span class="desktop">
            {{-- @include("components.buyer.sidebar") --}}
            <div class="w3-card w3-round w3-white box" style=" border:solid gray 1px;">
              {{-- <p style="float: right;">verified</p>   --}}
              <div class="w3-container">
                <p style="float: right;">verified</p>
                 <h4 class="w3-center">Shop info</h4>
                 {{-- <p style="float: right;">verified</p> --}}
                 @foreach($shop1 as $sp)
                 <p class="w3-center"> <img width="150px" height="150px" style="border-radius: 50%;" src="{{ url('/data_file/'.$sp->idcard_picture) }}" alt="picture"></p>
                 <hr>
                 
 
 
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