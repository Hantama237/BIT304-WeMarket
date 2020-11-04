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
                <div class="col-lg-8 box" style="padding-bottom: 20px">
                    <div style="padding-left:0px;" class="col-lg-12">
                            <div class="row col-lg-6">
                                <h5 style="margin-top: 0px; margin-left:0px; ">Edit Address
                                    
                                </h5>
                            </div>
                            <div class="row col-lg-6" style="text-align: right;">
                                <button style="display: inline-block;" type="button" class="awe-btn" data-toggle="modal" data-target="#addAddressModal">
                                    Add New Address
                                </button>
                            </div>
                            
                        
                        @foreach ($addresses as $address)
                            <div class="col-lg-12">asdd 11</div>
                        @endforeach
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
<div style="z-index:999999" class="modal fade" id="addAddressModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Address</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="/manage/address/add/address" method="POST">
            <div class="modal-body">
                <div class="row">
                    {{-- <div class="col-xs-12"><input type="text" disabled name="application_date" class="awe-calendar" value="Today" placeholder="Today"></div> --}}
                    <div class="col-xs-12"><label for="email">Province</label></div>
                    <div class="col-xs-12">
                        <select name="province_id" id="province">
                            {!!$provincies->data!!}
                        </select>
                    </div>
                    <div class="col-xs-12"><label for="email">City</label></div>
                    <div class="col-xs-12">
                        <select name="city_id" id="city">
                            <option selected disabled value="">Select Province First</option>
                        </select>
                    </div>
                    <div class="col-xs-12"><label for="email">Sub District</label></div>
                    <div class="col-xs-12">
                        <select name="subdistrict_id" id="subdistrict">
                            <option selected disabled value="">Select City First</option>
                        </select>
                    </div>
                    <div class="col-xs-12"><label for="email">Postal Code</label></div>
                    <div class="col-xs-12">
                        <input type="text" name="postal_code" value="{{old("postal_code")}}">
                    </div>
                    <div class="col-xs-12"><label for="email">Address Detail</label></div>
                    <div class="col-xs-12">
                        <input type="text" name="address_detail" value="{{old("address_detail")}}">
                    </div>
                    @csrf
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="awe-btn" data-dismiss="modal">Cancel</button>
                <button type="submit" class="awe-btn awe-btn-style3">Add Address</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- END / SEARCH TABS -->
<script>
    $(document).ready(()=>{
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
