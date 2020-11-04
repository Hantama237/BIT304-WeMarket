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
                            
                        <div class="col-lg-12" style="height: 20px;"></div>
                        @foreach ($addresses as $address)
                            <div class="col-lg-12" style="color:black; background-color: #e0e0e0; padding-top:10px; padding-bottom:10px; margin-bottom:10px;">
                                <div class="col-lg-12" style="padding: 0px;">
                                    <div class="col-lg-6" style="padding: 0px;"><b>Address 1</b> </div>
                                    <div class="col-lg-6" style="padding: 0px; text-align:right;"><button onclick='updateAlamat({!!json_encode($address)!!})' style="display: inline-block;" data-toggle="modal" data-target="#editAddressModal">Edit</button></div>
                                </div>
                                {{$address->subdistrict->subdistrict_name}}, {{$address->city->city_name}}, {{$address->province->province_name}}, {{$address->postal_code}} {{$address->address_detail}}
                            
                            </div>
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

<div style="z-index:999999" class="modal fade" id="editAddressModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Address</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="/manage/address/update/address" method="POST">
            <input type="hidden" name="id" id="address_id">
            <div class="modal-body">
                <div class="row">
                    {{-- <div class="col-xs-12"><input type="text" disabled name="application_date" class="awe-calendar" value="Today" placeholder="Today"></div> --}}
                    <div class="col-xs-12"><label for="email">Province</label></div>
                    <div class="col-xs-12">
                        <select name="province_id" id="province_id">
                            {!!$provincies->data!!}
                        </select>
                    </div>
                    <div class="col-xs-12"><label for="email">City</label></div>
                    <div class="col-xs-12">
                        <select name="city_id" id="city_id">
                            <option selected disabled value="">Select Province First</option>
                        </select>
                    </div>
                    <div class="col-xs-12"><label for="email">Sub District</label></div>
                    <div class="col-xs-12">
                        <select name="subdistrict_id" id="subdistrict_id">
                            <option selected disabled value="">Select City First</option>
                        </select>
                    </div>
                    <div class="col-xs-12"><label for="email">Postal Code</label></div>
                    <div class="col-xs-12">
                        <input type="text" name="postal_code" id="postal_code" value="{{old("postal_code")}}">
                    </div>
                    <div class="col-xs-12"><label for="email">Address Detail</label></div>
                    <div class="col-xs-12">
                        <input type="text" name="address_detail" id="address_detail" value="{{old("address_detail")}}">
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
    function updateAlamat(data){

        getKabupaten1(data.province_id,data.city_id);
        getKecamatan1(data.city_id,data.subdistrict_id);
        $('#address_id').val(data.id)
        $('#province_id').val(data.province_id)
        $('#postal_code').val(data.postal_code)
        $('#address_detail').val(data.address_detail)
    }
    function getKabupaten1(idprovinsi,idkabupaten){
        $.get("/api/city/"+idprovinsi,{},(data)=>{
            updateKabupaten1(data);
            $('#city_id').val(idkabupaten)
        },"html")
    }
    function getKecamatan1(idkabupaten,idkecamatan){
        $.get("/api/subdistrict/"+idkabupaten,{},(data)=>{
            updateKecamatan1(data);
            $('#subdistrict_id').val(idkecamatan)
        },"html");
    }
    function updateKabupaten1(data){
        $("#city_id").html(data);
    }
    function updateKecamatan1(data){
        $("#subdistrict_id").html(data);
    }
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


        function getKabupaten2(idprovinsi){
            $.get("/api/city/"+idprovinsi,{},(data)=>{
                updateKabupaten2(data);
            },"html")
        }
        function getKecamatan2(idkecamatan){
            $.get("/api/subdistrict/"+idkecamatan,{},(data)=>{
                updateKecamatan2(data);
            },"html");
        }
        function updateKabupaten2(data){
            $("#city_id").html(data);
        }
        function updateKecamatan2(data){
            $("#subdistrict_id").html(data);
        }
        $("#province_id").change(()=>{
            getKabupaten2($("#province_id").val());
        })
        $("#city_id").change(()=>{
            getKecamatan2($("#city_id").val());
        })
        

    })
</script>
@endsection
