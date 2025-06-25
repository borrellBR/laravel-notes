@include ('layouts.edit-data-header')
<div class="display-inline" style="display: flex;padding-bottom: -4rem; margin-bottom:-2rem;  justify-content: space-between; align-items: center;">
    <h3 class="col-md-4">Mis Notas</h3>
</div>

    <hr style="border: 1px solid #cbc9c9; margin: 20px 0;">

    <form style="text-align:left; margin:60rem; margin-top:5rem; " method="POST" action="{{ route('edit-password.put') }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="current_password">Contraseña Actual:</label>
            <input style="padding:2rem;" type="password" id="current_password" name="current_password" class="form-control" placeholder="Enter current password" required>
        </div>


        <div class="form-group">
            <label for="new_password">Nueva Contraseña:</label>
            <input style="padding:2rem;" type="password" id="new_password" name="new_password" class="form-control" placeholder="Enter new Password"required>
        </div>

        <div class="form-group">
            <label for="new_password_confirmation">Confirmar Nueva Contraseña:</label> <br>
            <input type="password" id="new_password_confirmation" name="new_password_confirmation"class="form-control" required>
        </div>

        <div style="text-align:center; "class="submit">
            <button style= "margin-top:30rem; color:white; background-color:black;"type="submit" class="btn btn-primary">
               <i style="color:white; margin-right:0.5rem; align-items:center;" class="fi fi-br-check"></i>Guardar Cambios</button>
            </div>
    </form>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
