    @include ('layouts.reset-header')

    <div class="title-bar">
        <h3 class="col-md-4">Restablecer Contraseña</h3>
    </div>
        <hr class="hr-gray">
    <br><br>
    <form method="POST" action="{{ route('reset-password.post') }}" class="password-form">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email"  class="form-control pw-input" placeholder="Enter email" required autofocus>
        </div>

        <div class="form-group">
            <label for="password">Nueva contraseña:</label>
            <input type="password" id="password" name="password"  class="form-control pw-input" placeholder="Enter new password"  required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirmar nueva contraseña:</label>
            <input type="password" id="password_confirmation" name="password_confirmation"  class="form-control pw-input" placeholder="Confirm new password"  required>
        </div>

        <div class="submit-container">
            <button type="submit" class="btn submit-btn">
                <i class="fi fi-br-check"></i>Guardar Cambios
            </button>

            <a class= "redirect-login"href="{{ route('login') }}">Volver al login</a>

        </div>
    </form>

    @if (session('status'))
        <div>{{ session('status') }}</div>
    @endif


