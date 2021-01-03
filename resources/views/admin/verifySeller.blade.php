@extends('admin.base')
@section('main')


<!-- LIST -->
<section>
    
    <div class="container">
        <span class="mobile">
            {{-- @include("components.admin.sidebar") --}}
        </span>
        <div class="col-lg-12" style="margin-bottom: 70px;">
            <h3>Admin Dashboard</h3>
            <div class="col-lg-12 box" style="padding-bottom: 20px;">
                <div class="col-lg-3" >
                    <ul>
                        <a href="{{URL::to("/admin/home")}}">
                            <li>
                                Home
                            </li>
                        </a>
                        <a href="{{URL::to("/admin/verify")}}">
                            <li>
                                Verify Seller
                            </li>
                        </a>
                        <a href="{{URL::to("/admin/manageUser")}}">
                            <li>
                                Manage Users
                            </li>
                        </a>
                    </ul>
                </div>
                <div class="col-lg-9" style="color: black; border-left: 2px solid #dedede;">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Shop name</th>
                            <th>Picture</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($shop as $p)
                           <tr>
                               <td style="text-align: center">
                                   {{$p->name}}
                               </td>
                               <td style="text-align: center"> 
                                
                                     <img id="myImg" data-toggle="modal" id="exampleModal" data-target="#exampleModal" src="{{ url('/data_file/'.$p->idcard_picture) }}" style="height:120px; width:200px"/>
                                    
                                    </td>
                               <td style="text-align: center">
                                <a href="{{URL::to("/admin/verified/".$p->id)}}" class="awe-btn">verify this user</a>
                               </td>
                          </tr>
                            @endforeach
                        </tbody>
                       </table>
                    
                </div>
            </div>
            
        </div>
        <span class="desktop">
            {{-- @include("components.admin.sidebar") --}}
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
          <h5 class="modal-title" id="exampleModalLabel">Id_Card Preview</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
            <div class="modal-body">
            <img class="modal-content" id="img01" style="width: 100%"> 
            </div>
            <div class="modal-footer">
                <button type="button" class="awe-btn" data-dismiss="modal">Close</button>
                {{-- <button type="submit" class="awe-btn awe-btn-style3">Submit</button> --}}
            </div>
        
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
    // Get the modal
var modal = document.getElementById("exampleModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}
</script>

  
  

@endsection
