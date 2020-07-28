@extends('master')
@section('content')
<style>
    .login-page-demo{
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
        .login-page-demo{
            background-image:none;
            background-size: contain;
        }
    }
</style>
<section class="awe-parallax login-page-demo">
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
                <span>Welcome back</span>
                <h2>WEfans!</h2>
            </div>
            <form id="form-login" action="/login" method="POST">
                <div class="form-item">
                    <label>Email</label>
                    <input type="email" name="email">
                </div>
                <div class="form-item">
                    <label>Password</label>
                    <input type="password" name="password">
                </div>
                <a href="#" class="forgot-password">Forgot Password</a>
                <div class="form-actions">
                    <input type="submit" name="login" value="Log In">
                </div>
                @csrf
            </form>
            <div class="login-register-link">
                Dont have account yet? <a href="/register">Register HERE</a>
            </div>
        </div>
    </div>
</section>
@endsection