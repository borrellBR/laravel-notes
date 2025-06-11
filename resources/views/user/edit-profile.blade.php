<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Profile</title>
</head>
<body>
    @include ('layouts.header')
    <h1>Edit Profile</h1>
    <form method="POST" action="{{ route('edit-profile.put') }}">
        @csrf
        @method('PUT')
        <br>
        <div>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" required>
        </div><br>
        <div>
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" value="{{ auth()->user()->name }}" required>
        </div>
        <br>
        <div>
            <label for="lastname">Last Name:</label> <br>
            <input type="text" id="lastname" name="lastname" value="{{ auth()->user()->lastname }}" required>
        </div>

        <br>
        <button type="submit">Update Profile</button>
    </form>

    @if (session('message'))
        <div>{{ session('message') }}</div>
    @endif

    <a href="{{ route('index') }}">Back to Home</a>
</body>
</html>
