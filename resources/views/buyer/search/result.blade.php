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
    }
    .product:hover{
        cursor: pointer;
        background-color: #d1d1d1;
        border: 3px solid white;
    }
</style>
<!-- LIST -->
<section>
    
    <div class="container">
        <span class="mobile">
            @include("components.buyer.sidebar")
        </span>
        <div class="col-lg-9">
            <h3>Search Products</h3>
            <div class="col-lg-12 box" style="padding-bottom: 20px;">
                <div class="col-lg-6">
                    <input style="width: 100%;" type="text"> 
                </div>
                <div style="padding-left:0px;" class="col-lg-6">
                    <button   class="awe-btn awe-btn-style3">Search</button> 
                    <button  class="awe-btn ">Recommendation</button>
                </div>
            </div>
            <h3>Search Result</h3>
            <div class="col-lg-12 box" style="margin-bottom:100px; padding-bottom: 20px;">
                <div class="product col-lg-3" >
                    <div style="width: 100%; height:120px;" id="product-img" >
                        
                    </div>
                    <div>Jeruk Bali, Manis</div>
                    <div>Lokasi</div>
                    <div>Rp. 22.000/Kg</div>
                </div>

                <div class="product col-lg-3" >
                    <div style="width: 100%; height:120px;" id="product-img" >
                        
                    </div>
                    <div>Jeruk Bali, Manis</div>
                    <div>Lokasi</div>
                    <div>Rp. 22.000/Kg</div>
                </div>
                <div class="product col-lg-3" >
                    <div style="width: 100%; height:120px;" id="product-img" >
                        
                    </div>
                    <div>Jeruk Bali, Manis</div>
                    <div>Lokasi</div>
                    <div>Rp. 22.000/Kg</div>
                </div>
                <div class="product col-lg-3" >
                    <div style="width: 100%; height:120px;" id="product-img" >
                        
                    </div>
                    <div>Jeruk Bali, Manis</div>
                    <div>Lokasi</div>
                    <div>Rp. 22.000/Kg</div>
                </div>

                <div class="product col-lg-3" >
                    <div style="width: 100%; height:120px;" id="product-img" >
                        
                    </div>
                    <div>Jeruk Bali, Manis</div>
                    <div>Lokasi</div>
                    <div>Rp. 22.000/Kg</div>
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