@include ('layouts.login-header')

    <form style="text-align:left; margin-left:110rem;  margin-right:10rem; margin-bottom:-5rem; " method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <label for="email">Email:</label>
            <input style="padding:2rem;" type="email" id="email" name="email" class="form-control" placeholder="Enter Email" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input style="padding:2rem;" type="password" id="password" name="password" class="form-control" placeholder="Enter Password" required>
        </div>

        <div class="form-group">
            <label for="name">Name:</label>
            <input style="padding:2rem;" type="text" id="name" name="name" class="form-control" placeholder="Enter Name" required autofocus>
        </div>

        <div class="form-group">
            <label for="name">Last Name:</label>
            <input style="padding:2rem;" type="text" id="lastname" name="lastname" class="form-control" placeholder="Enter Lastname" required autofocus>
        </div>

        <div class="form-group">
            <label for="name">Para registrarte, debes aceptar los  <a href="terms"</a>terminos y condiciones:</label>
            <input style="padding:2rem;"type="checkbox" id="terms" name ='terms' required>
        </div>

        <br>

        <div style="text-align:center; "class="submit">

            <button style= "padding-left:6.35rem; padding-right:6.35rem; margin-top:2rem; color:white; background-color:black;"type="submit" class="btn btn-primary">
                Crear Cuenta
            </button>
            <br>
                <a style= "margin-top:1rem; padding-left:8.8rem; padding-right:8.8rem; border-color:black; color:rgb(0, 0, 0); background-color:rgb(255, 255, 255);" class="btn btn-primary"href={{ route('login') }}>
                    Login
                </a>
            </div>
        </div>

        @if (session('status'))
        <div>{{ session('status') }}</div>
    @endif
     </form>



