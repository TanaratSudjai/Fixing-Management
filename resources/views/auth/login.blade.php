<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<body>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
    </form>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
        <a href="{{route('register')}}">register</a>
    </form>
</body>

</html>
