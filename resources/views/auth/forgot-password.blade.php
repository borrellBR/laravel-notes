@include ('layouts.restore-header')

    <div class="center">
    <h1 style="text-align: center;">Ayudanos a Recuperar tu Contraseña</h1>
    <footer style="text-align: center; color:grey;">Introduce tu correo y te enviaremos las instrucciones para poder recuperarla.</footer>


    <form style="text-align:left; margin:60rem; margin-top:5rem; " method="POST" action="{{ route('forgot-password') }}">
        @csrf

        <div class="form-group">
            <label for="email">Email:</label>
            <input style="padding:2rem;" type="email" id="email" name="email" class="form-control" placeholder="Enter email" required autofocus>
        </div>

        <div style="text-align:center;" class="submit">
            <button style= "padding-left:4.35rem; padding-right:4.35rem;margin-top:20rem; color:white; background-color:black;"type="submit" class="btn btn-primary">
                Enviar Correo
            </button>
            <br>
            <a style="padding-left:4rem; padding-right:4rem; margin-top:1rem; color:rgb(0, 0, 0); background-color:rgb(255, 255, 255);" class="btn btn-primary"href={{ route('login') }}>
                Volver al Login
            </a>
        </div>
    </form>

    @if (session('status'))
        <div>{{ session('status') }}</div>
    @endif

    <a href="{{ route('login') }}">Login</a>

