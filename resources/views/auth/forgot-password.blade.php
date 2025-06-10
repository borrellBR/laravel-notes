<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <h1>Forgot Password</h1>
    <form method="POST" action="{{ route('forgot-password') }}">
        @csrf
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required autofocus>
        </div>
        <button type="submit">Send Password Reset Link</button>
    </form>

    @if (session('status'))
        <div>{{ session('status') }}</div>
    @endif

    <a href="{{ route('login') }}">Login</a>
</body>
</html>
