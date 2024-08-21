<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class=" bg-[#E1F7F5] flex items-center justify-center min-h-screen bg-background">
        <div class=" bg-white  bg-card p-8 rounded-lg shadow-lg w-full max-w-sm">
            <div class="flex items-center justify-center mb-6">
                <img src="logo.png" alt="Logo" class="w-23 h-20">

            </div>
            <h2 class="text-xl font-semibold text-foreground text-center mb-10">Sign in to your account</h2>

            <form method="POST" action="{{ route('login') }}" class="flex flex-col">
                @csrf
                <div class="mb-2">
                    <label for="email" class="block text-muted-foreground mb-1">Email:</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="block w-full p-2 border border-border rounded mb-4" placeholder="Enter your email"
                        required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-muted-foreground mb-1">Password:</label>
                    <input type="password" id="password" name="password"
                        class="block w-full p-2 border border-border rounded mb-4" placeholder="Enter your password"
                        required>
                </div>

                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-4">Login</button>
            </form>

            <p class="w-full mt-8 flex justify-between"> Don't have an account yet? 
                <a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-700 ml-1 hover:underline">Sign up</a>
            </p>
        </div>
    </div>
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'รหัสผ่านไม่ถูกต้อง',
                html: '{!! implode("<br>", $errors->all()) !!}',
            })
        </script>
    @endif

</body>

</html>