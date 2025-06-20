@include ('layouts.main-header')


    <h1>Ayudanos a Recuperar tu Contraseña</h1>
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
