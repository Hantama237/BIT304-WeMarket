<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>
</head>
<body>
    <div style="text-align:center; width: 100%; position: absolute; top:30%;">
        <div style="display: inline-block; padding:40px; border-radius:3%; background-color:#dedede;">
            <h2>Login Admin</h2>
            <div style="color: red; padding:5px; text-align:center;">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        {{$error}}
                    @endforeach
                @endif
            </div>
            <form action="{{URL::to("/admin/login")}}" method="post">
                <input placeholder="username" type="text" name="username"> <br>
                <br>
                <input placeholder="password" type="password" name="password">
                @csrf <br><br>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
    
</body>
</html>