    @include ('layouts.main-header')

    <h1>Restablecer contraseña</h1>
    <form method="POST" action="{{ route('reset-password.post') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required autofocus>
        </div>
        <div>
            <label for="password">Nueva contraseña:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <label for="password_confirmation">Confirmar nueva contraseña:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>
        <button type="submit">Restablecer contraseña</button>
    </form>

    @if (session('status'))
        <div>{{ session('status') }}</div>
    @endif

    <a href="{{ route('login') }}">Iniciar sesión</a>

