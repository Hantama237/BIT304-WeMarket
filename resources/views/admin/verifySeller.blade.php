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
                        <a href="/admin/home">
                            <li>
                                Home
                            </li>
                        </a>
                        <a href="/admin/verify">
                            <li>
                                Verify Seller
                            </li>
                        </a>
                        <a href="">
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
                                     <img src="{{ url('/data_file/'.$p->idcard_picture) }}" style="height:120px; width:200px"/>
                               </td>
                               <td style="text-align: center">
                                <a href="/admin/verified/{{$p->id}}" class="awe-btn">verify this user</a>
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
