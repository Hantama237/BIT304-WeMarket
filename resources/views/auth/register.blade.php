@extends('master')
@section('content')
<style>
    .register-page-demo{
        background-image: url({!!asset("gofar/images/login/Background.png")!!});
        background-size: contain;
    }
    #page-wrap{
        background-color: white !important;
    }
    #form-login{
        background: #f7f7f7;
    }
    .login-register-page__content form:after {
        background: #f7f7f7;
    }
    @media screen and (max-width: 600px) {
        .register-page-demo{
            background-image:none;
            background-size: contain;
        }
    }
</style>
<section class="awe-parallax register-page-demo">
    <div class="awe-overlay"></div>
    <div class="container">
        
        <div class="login-register-page__content">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="content-title">
                <span>Find fresh agricultural product</span>
                <h2>JOIN US !</h2>
            </div>
            <form action="{{URL::to("/register")}}" method="POST">
                @csrf
                <div class="form-item">
                    <label>Full Name</label>
                    <input type="text" name="name" value="{{old("name")}}">
                </div>

                <div class="form-item">
                    <label>Email</label>
                    <input type="email" name="email" value="{{old("email")}}">
                </div>
                
                <div class="form-item">
                    <label>Password</label>
                    <input type="password" name="password" value="{{old("password")}}">
                </div>

                <div class="form-item">
                    <label>Confirm password</label>
                    <input type="password" name="password_confirmation" value="{{old("password_confirmation")}}">
                </div>

                <a href="#" class="terms-conditions">By registering, you accept terms &amp; conditions</a>
                <div class="form-actions">
                    <input name="register" type="submit" value="Register">
                </div>
            </form>
            <div class="login-register-link">
                Already have Account? <a href="{{URL::to("/login")}}">Log in HERE</a>
            </div>
        </div>
    </div>
</section>
@endsection