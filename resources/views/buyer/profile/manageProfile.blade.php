{{-- @extends('base')
@section('main')
    <form enctype='multipart/form-data' action="/manage/profile/update/profile" method="POST">
        <input onchange="readURL(this)" id="imgInp" type="file" accept="image/*" name="profile_picture"><br>
        <input type="text" name="name">
        @csrf
    <input type="submit" value="Save">
    </form>
    <script>
        function readURL(input) {
            console.log("changed");
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                // reader.onload = function(e) {
                //     // console.log(e.target.result)
                //     // $('#img-preview').css('background-image', 'url(' +  e.target.result + ')');
                //     // $('#img-preview').text("Preview");
                // }
                
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }
    </script>
@endsection --}}

@extends('base')
@section('main')


<!-- LIST -->
<section>
    <style>
        .myul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        .myul li{
            font-size: 12pt;
            color: #000;
            padding: 3px;
            background-color: #e0e0e0;
        }
        .myul li:hover{
            background-color: grey;
        }
        .active{
            background-color: #73de77 !important;
        }
        #preview-profile{
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
        }
    </style>
    <div class="container">
        <span class="mobile">
            @include("components.buyer.sidebar")
        </span>
        <div class="col-lg-9" style="margin-bottom: 100px;">
            <h3>Manage Profile</h3>
            <div class="col-lg-12" style="padding-bottom: 20px; background-color:none; padding-left:0px;">
                <div class="col-lg-4" style="padding-left:0px;">
                    <div class="col-lg-12 box" style="padding-bottom: 20px">
                        <ul class="myul">
                            <a href="{{URL::to("/manage/profile")}}"><li class="active" >Profile</li></a>
                            <a href="{{URL::to("/manage/address")}}"><li>Address</li></a>
                            <a href="{{URL::to("/manage/account")}}"><li >Account</li></a>
                        </ul>
                    </div>
                </div>
                <form enctype='multipart/form-data' action="{{URL::to("/manage/profile/update/profile")}}" method="POST">
                    @csrf
                    <div class="col-lg-8 box" style="padding-bottom: 20px">
                        <div style="padding-left:0px;" class="col-lg-12">
                            <h5 style="margin-top: 0px; margin-left:40px;">Edit Profile</h5>
                            <div class="col-lg-12">
                                <div class="row col-lg-5" style="text-align: center;">
                                    <div id="preview-profile" style="display:inline-block;background-color: #73de77; background-image: url('{{asset("images/user/".$data->id."/".$data->profile_picture)}}'); height:100px; width:100px; border-radius:100%;"></div>
                                </div>
                                <div class="row col-lg-7 align-middle" style="height: 100px; position: relative;">
                                    <div style="display: inline-block; position: absolute; bottom:0%; -ms-transform: translateY(-50%); transform: translateY(-50%);"><input  onchange="readURL(this)" id="imgInp" type="file" accept="image/*" name="profile_picture"></div>
                                    
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="row col-lg-5 align-middle" >
                                    <div style="margin-top: 8px; text-align:center;">
                                        <label for="name">Name</label>    
                                    </div>
                                </div>
                                <div class="row col-lg-7"><input style="width: 100%;" type="text" name="name" value="{{$data->name}}"></div>
                            </div>
                            <div class="col-lg-12" style="margin-top: 25px;">
                                <div class="row col-lg-5"></div>
                                <div class="row col-lg-7">
                                    <button type="submit" class="awe-btn awe-btn-style3">Save</button>
                                </div>
                            </div>
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
