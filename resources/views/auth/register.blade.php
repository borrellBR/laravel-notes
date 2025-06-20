@include ('layouts.login-header')


    <h1>Register</h1>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required autofocus>
        </div>

        <div>
            <label for="name">Last Name:</label>
            <input type="text" id="lastname" name="lastname" required autofocus>
        </div>

        <div>
            <label for="name">Para registrarte, debes aceptar los terminos y condiciones:</label>
            <input type="checkbox" id="terms" name ='terms' required>
        </div>

        <br>

        <button type="submit">Register</button>
    </form>

    @if (session('status'))
        <div>{{ session('status') }}</div>
    @endif

    <a href="{{ route('login') }}">Login</a>
