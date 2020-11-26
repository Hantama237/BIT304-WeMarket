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
                        <a href="/admin/manageUser">
                            <li>
                                Manage Users
                            </li>
                        </a>
                    </ul>
                </div>
                <div class="col-lg-9" style="color: black; border-left: 2px solid #dedede;">                    
                <form method="POST" action="/admin/processBan/{{$user->id}}">
                        @csrf
                        <div class="col-lg-12">
                            <label for="name">User name</label><br>
                        <input style="width: 100%; disabled" type="text" name="name" value="{{$user->name}}"disabled>
                        </div>
                        <div class="col-lg-12">
                            <label for="name">Email</label><br>
                            <input style="width: 100%; disabled" type="text" name="email" value="{{$user->email}} "disabled>
                        </div>
                        <div class="col-lg-12">
                            <label for="description">Ban user until</label><br>
                            <input style="width: 100%;" type="date" name="banned_until" value="">
                        </div>
                        <div class="col-lg-12">
                            <br>
                            <input type="submit" class="awe-btn awe-btn-style3" value="Submit">
                        </div>
                    </form>    
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

<!-- END / SEARCH TABS -->
<script>
    function updateModal(id,name){
        $("#residence_id").val(id);
        $("#residence_name").val(name);
    }
</script>

@endsection
