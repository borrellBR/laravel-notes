@include ('layouts.edit-password-header')
<h1>Edit Password</h1>
<form method="POST" action="{{ route('edit-password.put') }}">
    @csrf
    @method('PUT')

    <div>
        <label for="current_password">Contraseña Actual:</label><br>
        <input type="password" id="current_password" name="current_password" required>
    </div><br>
    <div>
        <label for="new_password">Nueva Contraseña:</label><br>
        <input type="password" id="new_password" name="new_password" required>
    </div>
    <br>
    <div>
        <label for="new_password_confirmation">Confirmar Nueva Contraseña:</label> <br>
        <input type="password" id="new_password_confirmation" name="new_password_confirmation" required>
    </div>

    <br>
    <button type="submit">Update Profile</button>
</form>


@if (session('message'))
    <div>{{ session('message') }}</div>
@endif
