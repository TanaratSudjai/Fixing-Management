<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-[#E1F7F5] flex items-center justify-center min-h-screen">
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="bg-white p-6 md:p-8 lg:p-10 rounded-lg shadow-lg w-11/12 sm:w-2/3 md:w-1/2 lg:w-1/3 xl:w-1/4">
        <div class="flex justify-center mb-4">
            <img src="logo.png" alt="Logo" class="w-23 h-20">
        </div>
        <h2 class="text-xl md:text-2xl font-semibold text-center mb-6">Sign in to your account</h2>
        <form method="POST" action="{{ route('login') }} " class="flex flex-col">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
                <input type="password" id="password" name="password" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>


            <div class="flex items-center justify-between"></div>
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Login</button>
        </form>

        <form method="POST" action="{{ route('logout') }} " class="flex flex-col">
            @csrf
            <p class="text-center text-gray-500 text-xs mt-4"> Don't have an account yet?<a
                    href="{{ route('register') }}" class="text-blue-500 hover:text-blue-700">Sign up</a></p>

        </form>
    </div>
</body>

</html>