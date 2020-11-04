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
                            <a href="/manage/profile"><li >Profile</li></a>
                            <a href="/manage/address"><li>Address</li></a>
                            <a href="/manage/account"><li class="active">Account</li></a>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-8 box" style="padding-bottom: 20px">
                    <div style="padding-left:0px;" class="col-lg-12">
                        <h5 style="margin-top: 0px; ">Edit Account</h5>
                        <button type="button" class="awe-btn" data-toggle="modal" data-target="#emailModal">
                            Change Email Address
                        </button>
                        <button type="button" class="awe-btn" data-toggle="modal" data-target="#passwordModal">
                            Change Password
                        </button>
                    </div>
                </div>
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
<div style="z-index:999999" class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Change Email Address</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="/manage/account/update/email" method="POST">
            <div class="modal-body">
                <div class="row">
                    {{-- <div class="col-xs-12"><input type="text" disabled name="application_date" class="awe-calendar" value="Today" placeholder="Today"></div> --}}
                    <div class="col-xs-12"><label for="email">New Email (current:{{$data->email}})</label></div>
                    <div class="col-xs-12"><input required type="text" name="email" id="new_email" value="{{old("email")}}" placeholder="New Email Address"></div>                    
                    <div class="col-xs-12"><label for="password">Password</label></div>
                    <div class="col-xs-12"><input required type="password" name="password" id="password" value="{{old("password")}}" placeholder="Password"></div>
                    @csrf
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="awe-btn" data-dismiss="modal">Cancel</button>
                <button type="submit" class="awe-btn awe-btn-style3">Update Email</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div style="z-index:999999" class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="/manage/account/update/password" method="POST">
            <div class="modal-body">
                <div class="row">
                    {{-- <div class="col-xs-12"><input type="text" disabled name="application_date" class="awe-calendar" value="Today" placeholder="Today"></div> --}}
                    <div class="col-xs-12"><label for="email">New Password</label></div>
                    <div class="col-xs-12"><input required type="password" name="password" id="pw" value="{{old("password")}}" placeholder="New Password"></div>
                    <div class="col-xs-12"><label for="email">Confirm New Password</label></div>
                    <div class="col-xs-12"><input type="password" name="confirm_password" id="cpw" value="{{old("confirm_password")}}" placeholder="Confirm New Password"></div>
                    <div class="col-xs-12"><label for="email">Current Password</label></div>
                    <div class="col-xs-12"><input required type="password" name="old_password" id="opw" value="{{old("old_password")}}" placeholder="Current Password"></div>
                    <input type="hidden" readonly aria-readonly="true" name="residence_id" id="residence_id" value="{{old("residence_id")}}" placeholder="Please re-apply">
                    @csrf
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="awe-btn" data-dismiss="modal">Cancel</button>
                <button type="submit" class="awe-btn awe-btn-style3">Update Password</button>
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
