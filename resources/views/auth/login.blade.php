 @include ('layouts.login-header')



    <form style=" text-align:left; margin-left:110rem;  margin-right:10rem; margin-bottom:-5rem; " method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="email">Email*</label>
            <input style="padding:2rem;" type="email" id="email" name="email" class="form-control" placeholder="Enter Email" required>
        </div>

        <div class="form-group">
            <label for="password">Password*</label>
            <input style="padding:2rem;" type="password" id="password" name="password" class="form-control" placeholder="Enter Password" required>
                <small id="passwordHelp" class="form-text text-muted">
                        Has olvidado tu contrasenya?
                    <strong> <a style="text-decoration:none; color:rgb(67, 67, 67); "href="{{ route('forgot-password') }}">
                        Recuperar</a>
                    </strong>
                </small>
        </div>

        <div style="margin-top: 14rem; text-align:center; "class="submit">

            <button style= "padding-left:6.35rem; padding-right:6.35rem; margin-top:10rem; color:white; background-color:black;"type="submit" class="btn btn-primary">
               Iniciar Sesion
            </button>
            <br>
             <a style= "margin-top:1rem; padding-left:8rem; padding-right:8rem; border-color:black; color:rgb(0, 0, 0); background-color:rgb(255, 255, 255);" class="btn btn-primary"href={{ route('register') }}>Register</a>
            </div>
        </div>
        @if (session('status'))
        <div>{{ session('status') }}</div>
    @endif

    </form>




