

    @include('layouts.edit-user-header')

    <div class="title-bar">
        <h3>Editar Perfil</h3>
    </div>

    <hr class="hr-gray">

    <form method="POST" action="{{ route('edit-profile.put') }}" class="profile-form">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="email">Email*</label>
            <input type="email" id="email" name="email"
                   class="form-control profile-input"
                   placeholder="Enter email"
                   value="{{ auth()->user()->email }}" required>
        </div>

        <div class="form-group">
            <label for="name">Nombre*</label>
            <input type="text" id="name" name="name"
                   class="form-control profile-input"
                   value="{{ auth()->user()->name }}" required>
        </div>

        <div class="form-group">
            <label for="lastname">Apellidos*</label>
            <input type="text" id="lastname" name="lastname"
                   class="form-control profile-input"
                   value="{{ auth()->user()->lastname }}" required>
        </div>

        <div class="submit-container">
            <button type="submit" class="btn btn-primary submit-btn">
                <i class="fi fi-br-check"></i>Guardar Cambios
            </button>
        </div>
    </form>
