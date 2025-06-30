 @include ('layouts.login-header')


 <div class="login-container">
    <div class="contenedor-imagen">
        <i class="fi-rr-smile"></i>
    </div>

    <div class="contenedor-formulario">


        <form method="POST" action="{{ route('login') }}">
            @csrf
            <img class="img" src="Scribl.png" alt="Scribl Logo">
            <div class="fields">
            <div class="form-group">
                <label for="email">Email*</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Enter Email" required>
            </div>

            <div class="form-group">
                <label for="password">Password*</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Enter Password" required>
                <small id="passwordHelp" class="form-text text-muted">
                    Has olvidado tu contrasenya?
                    <strong> <a style="text-decoration:none; color:rgb(67, 67, 67); "href="{{ route('forgot-password') }}">
                        Recuperar</a>
                    </strong>
                </small>
            </div>
        </div>

            <div class="submit-container-login">

                <button type="submit" class="btn btn-primary">
                    Iniciar Sesion
                </button>
                <br>
                <a class="btn btn-primary-login2"href={{ route('register') }}>Register</a>
            </div>


            @if (session('status'))
            <div>{{ session('status') }}</div>
            @endif
    </div>
    </form>
</nav>

</div>



