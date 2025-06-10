<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Profile</title>
</head>
<body>
    <h1>Edit Profile</h1>
    <form method="POST" action="{{ route('edit-profile.put') }}">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ auth()->user()->name }}" required>
        </div>

        <div>
            <label for="lastname">Name:</label>
            <input type="text" id="lastname" name="lastname" value="{{ auth()->user()->lastname }}" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" required>
        </div>
        <button type="submit">Update Profile</button>
    </form>

    @if (session('message'))
        <div>{{ session('message') }}</div>
    @endif

    <a href="{{ route('index') }}">Back to Home</a>
</body>
</html>
