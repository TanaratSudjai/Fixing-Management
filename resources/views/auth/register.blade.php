<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-200 flex items-center justify-center min-h-screen p-6">

    <div class="bg-white rounded-xl shadow-xl p-8 max-w-md w-full">
        <div class="flex justify-center mb-6">
            <img src="{{ asset('images/logoo.png') }}" width="60" height="60" alt="Logo">
        </div>
        <h2 class="text-2xl font-bold text-center text-[#DC5F00] mb-4">สร้างบัญชี FMS</h2>
        <form method="POST" action="{{ route('register') }}" id="registerForm" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-medium">ชื่อผู้ใช้</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                    placeholder="ป้อนชื่อของคุณ" required
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-[#DC5F00] transition duration-200" />
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-medium">อีเมล</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                    placeholder="ป้อนอีเมลของคุณ" required
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-[#DC5F00] transition duration-200" />
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-medium">รหัสผ่าน</label>
                <input type="password" id="password" name="password" placeholder="ป้อนรหัสผ่านของคุณ" required
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-[#DC5F00] transition duration-200" />
            </div>
            <div class="mb-4">
                <label for="password_confirmation"
                    class="block text-gray-700 text-sm font-medium">ยืนยันรหัสผ่าน</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    placeholder="ยืนยันรหัสผ่านของคุณ" required
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-[#DC5F00] transition duration-200" />
            </div>
            <div class="mb-4">
                <label for="image" class="block text-gray-700 text-sm font-medium">โปรไฟล์ลูกค้า</label>
                <div
                    class="flex flex-col items-center justify-center mt-2 border-2 border-dashed border-gray-300 p-4 rounded-md">
                    <label class="flex flex-col items-center cursor-pointer">
                        <div class="flex flex-col items-center">
                            <svg aria-hidden="true" class="w-10 h-10 text-gray-400 mb-3" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16l-4-4m0 0l4-4m-4 4h18m-8 4l4-4m0 0l-4-4m4 4H3"></path>
                            </svg>
                            <p class="text-center"><span class="font-semibold">คลิกเพื่ออัปโหลด</span>
                                หรือ ลากไฟล์มาที่นี่</p>
                            <p class="text-sm text-gray-500">PNG, JPG หรือ GIF (ขนาดไม่เกิน 2MB)</p>
                        </div>
                        <input type="file" name="image" id="image" class="hidden" />
                    </label>
                </div>
            </div>
            <button type="submit"
                class="w-full bg-[#DC5F00] hover:bg-[#C85100] text-white font-bold py-3 rounded-md transition duration-200">สมัครสมาชิก</button>
            <div class="text-center mt-4">
                <a href="/" class="text-gray-700 hover:underline">เข้าสู่ระบบ</a>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('registerForm').addEventListener('submit', function(event) {
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

            this.submit();
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
                title: 'Email นี้มีผู้ใช้ไปแล้ว',
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
