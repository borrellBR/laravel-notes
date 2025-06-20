@include ('layouts.edit-data-header')

<div class="display-inline" style="display: flex;padding-bottom: -4rem; margin-bottom:-2rem;  justify-content: space-between; align-items: center;">
    <h3 class="col-md-4">Editar Perfil</h3>
</div>
<hr style="border: 1px solid #cbc9c9; margin: 20px 0;">

    <form style="text-align:left; margin:60rem; margin-top:5rem; " method="POST" action="{{ route('edit-profile.put') }}">
        @csrf
        @method('PUT')

        <div class="form-group">
          <label for="email">Email*</label>
          <input style="padding:2rem;" type="email"  id="email" name="email" class="form-control" placeholder="Enter email" value="{{ auth()->user()->email }}" required>
        </div>

        <div class="form-group">
          <label for="name">Nombre*</label>
          <input style="padding:2rem;" type="text" id="name" name="name" class="form-control" placeholder="Password" value="{{ auth()->user()->name }}" required>
        </div>

        <div class="form-group">
            <label for="lastname">Apellidos*</label>
                <input style="padding:2rem;" type="text" id="lastname"  name="lastname" class="form-control" value="{{ auth()->user()->lastname }}" required>

        </div>

        <div style="text-align:center; "class="submit">
         <button style= "margin-top:30rem; color:white; background-color:black;"type="submit" class="btn btn-primary">
            <i style="color:white; margin-right:0.5rem; align-items:center;" class="fi fi-br-check"></i>Guardar Cambios</button>
         </div>
      </form>

