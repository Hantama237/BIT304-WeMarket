@extends('base')
@section('main')


<!-- LIST -->
<section>
    
    <div class="container">
        <span class="mobile">
            @include("components.buyer.sidebar")
        </span>
        <div class="col-lg-9" style="overflow: auto; margin-bottom:100px;">
            <h3>Shop Registration</h3>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="/seller/register">
                @csrf
                <div class="col-lg-12">
                    <label for="name">Shop Name (No Spaces)</label><br>
                    <input style="width: 100%;" type="text" name="name" value="{{old("name")}}">
                </div>
                <div class="col-lg-12">
                    <label for="description">Shop Description</label><br>
                    <input style="width: 100%;" type="text" name="description" value="{{old("description")}}">
                </div>
                <div class="col-lg-12">
                    <br>
                    <input type="submit" class="awe-btn awe-btn-style3" value="Register">
                </div>
            </form>
        </div>
        <span class="desktop">
            @include("components.buyer.sidebar")
        </span>
    </div>
</section>



@endsection
