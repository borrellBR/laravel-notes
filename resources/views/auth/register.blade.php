@include ('layouts.login-header')

    <form class="form" method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Enter Email" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Enter Password" required>
        </div>

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Enter Name" required autofocus>
        </div>

        <div class="form-group">
            <label for="name">Last Name:</label>
            <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Enter Lastname" required autofocus>
        </div>

        <div class="form-group">
            <label for="name">Para registrarte, debes aceptar los  <a href={{ route('terms') }} </a>terminos y condiciones:</label>
            <input type="checkbox" id="terms" name ='terms' required>
        </div>

        <br>

        <div class="submit">

            <button type="submit" class="btn btn-primary">
                Crear Cuenta
            </button>
            <br>
                <a class="btn btn-primary-register2" href={{ route('login') }}>
                    Login
                </a>
            </div>
        </div>

        @if (session('status'))
        <div>{{ session('status') }}</div>
    @endif
     </form>



