<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>
</head>
<body>
    <h2>Login Admin</h2>
    <form action="/admin/login" method="post">
        <input placeholder="username" type="text" name="username"> <br>
        <input placeholder="password" type="password" name="password">
        @csrf <br>
        <button type="submit">Login</button>
    </form>
</body>
</html>