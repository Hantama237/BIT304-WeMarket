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
            <h3>Manage Address</h3>
            <div class="col-lg-12" style="padding-bottom: 20px; background-color:none; padding-left:0px;">
                <div class="col-lg-4" style="padding-left:0px;">
                    <div class="col-lg-12 box" style="padding-bottom: 20px">
                        <ul class="myul">
                            <a href="/manage/profile"><li >Profile</li></a>
                            <a href="/manage/address"><li class="active">Address</li></a>
                            <a href="/manage/account"><li>Account</li></a>
                        </ul>
                    </div>
                </div>
                <form enctype='multipart/form-data' action="/manage/profile/update/profile" method="POST">
                    @csrf
                    <div class="col-lg-8 box" style="padding-bottom: 20px">
                        <div style="padding-left:0px;" class="col-lg-12">
                            <h5 style="margin-top: 0px; margin-left:40px;">Edit Address</h5>
                            
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

<!-- END / SEARCH TABS -->
<script>
    function updateModal(id,name){
        $("#residence_id").val(id);
        $("#residence_name").val(name);
    }
</script>

@endsection
