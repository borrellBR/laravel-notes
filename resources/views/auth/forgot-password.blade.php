@include ('layouts.restore-header')

    <div class="center">
    <h1 class="title">Ayudanos a Recuperar tu Contraseña</h1>
    <footer style="text-align: center; color:grey;">Introduce tu correo y te enviaremos las instrucciones para poder recuperarla.</footer>


    <form class="restablecer-form" method="POST" action="{{ route('forgot-password') }}">
        @csrf

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Enter email" required autofocus>
        </div>

        <div style="text-align:center;" class="submit">
            <button type="submit" class="btn btn-primary">
                Enviar Correo
            </button>
            <br>
            <a class="btn btn-primary2"href={{ route('login') }}>
                Volver al Login
            </a>
        </div>
    </form>

    @if (session('status'))
        <div>{{ session('status') }}</div>
    @endif


