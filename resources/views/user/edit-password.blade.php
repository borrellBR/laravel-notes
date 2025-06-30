


    @include('layouts.edit-password-header')

    <div class="title-bar">
        <h3 class="col-md-4">Mis Notas</h3>
    </div>

    <hr class="hr-gray">

    <form method="POST" action="{{ route('edit-password.put') }}" class="password-form">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="current_password">Contraseña Actual:</label>
            <input type="password" id="current_password" name="current_password" class="form-control pw-input" placeholder="Enter current password" required>
        </div>

        <div class="form-group">
            <label for="new_password">Nueva Contraseña:</label>
            <input type="password" id="new_password" name="new_password" class="form-control pw-input" placeholder="Enter new password" required>
        </div>

        <div class="form-group">
            <label for="new_password_confirmation">Confirmar Nueva Contraseña:</label>
            <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control pw-input" required>
        </div>

        <div class="submit-container">
            <button type="submit" class="btn submit-btn">
                <i class="fi fi-br-check"></i>Guardar Cambios
            </button>
        </div>
    </form>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
