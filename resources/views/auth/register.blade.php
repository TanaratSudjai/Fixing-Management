<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


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
            <h2 class="text-xl font-semibold text-foreground text-center mb-10">Create an account</h2>
            <form method="POST" action="{{ route('register') }}" id="registerForm">
                @csrf
                <div class="mb-4">
                    <label class="block text-muted-foreground mb-1" for="username">UserName</label>
                    <input class="border border-border rounded-lg p-2 w-full" type="text" id="name" name="name"
                        value="{{ old('name') }}" placeholder="Enter your username" required />
                </div>
                <div class="mb-4">
                    <label class="block text-muted-foreground mb-1" for="email">Email</label>
                    <input class="border border-border rounded-lg p-2 w-full" type="email" id="email" name="email"
                        value="{{ old('email') }}" placeholder="Enter your email" required />
                </div>
                <div class="mb-4">
                    <label class="block text-muted-foreground mb-1" for="password">Password</label>
                    <input class="border border-border rounded-lg p-2 w-full" type="password" id="password"
                        name="password" placeholder="Enter your password" required />
                </div>
                <div class="mb-4">
                    <label class="block text-muted-foreground mb-1" for="confirm-password">Confirm Password</label>
                    <input class="border border-border rounded-lg p-2 w-full" type="password" id="password_confirmation"
                        name="password_confirmation" placeholder="Confirm your password" required />
                </div>
                <button
                    class="mt-8 mb-4 w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">Sign up</button>
            </form>
        </div>
    </div>
    <script>
        document.getElementById('registerForm').addEventListener('submit', function (event) {
            event.preventDefault();

            let email = document.getElementById('email').value;
            let password = document.getElementById('password').value;
            let confirmPassword = document.getElementById('password_confirmation').value;

            if (!validateEmail(email)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Email',
                    text: 'Please enter a valid email address.',
                });
                return false;
            }

            if (password.length < 8) {
                Swal.fire({
                    icon: 'error',
                    title: 'Weak Password',
                    text: 'Password must be at least 8 characters long.',
                });
                return false;
            }

            if (password !== confirmPassword) {
                Swal.fire({
                    icon: 'error',
                    title: 'Password Mismatch',
                    text: 'Password and Confirm Password do not match.',
                });
                return false;
            }

            this.submit(); // If validation passes, submit the form
        });

        function validateEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(String(email).toLowerCase());
        }
    </script>
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                html: `
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                `,
            });
        </script>
    @endif


</body>

</html>