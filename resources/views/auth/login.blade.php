<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    @vite('resources/css/app.css')
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
    <div class="container mx-auto px-[250px]">
        <form method="POST" action="{{ route('login') }} " class="flex flex-col">
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
            <a href="{{ route('register') }}">register</a>
        </form>
    </div>
</body>

</html>
