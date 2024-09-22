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
    <div class="flex items-center justify-center bg-gray-200 w-full min-h-screen px-4 sm:px-0">
        <div class="p-6 sm:p-10 w-full max-w-xs sm:max-w-md rounded-xl">
            <div class="flex items-center justify-center mb-4 sm:mb-6">
                <img src="{{ asset('images/logoo.png') }}" alt="Logo" class="w-20 sm:w-23 h-16 sm:h-20">
            </div>
            <h2 class="text-lg sm:text-xl text-gray-800 text-center mb-8 sm:mb-10">สร้างบัญชี FMS</h2>
            <form method="POST" action="{{ route('register') }}" id="registerForm" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-600 mb-1" for="name">ชื่อผู้ใช้</label>
                    <input class="border border-gray-300 rounded-xl p-2 w-full focus:border-orange-500 outline-none"
                        type="text" id="name" name="name" value="{{ old('name') }}"
                        placeholder="ป้อนชื่อของคุณ" required />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-600 mb-1" for="email">อีเมล</label>
                    <input class="border border-gray-300 rounded-xl p-2 w-full focus:border-orange-500 outline-none"
                        type="email" id="email" name="email" value="{{ old('email') }}"
                        placeholder="ป้อนอีเมลของคุณ" required />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-600 mb-1" for="password">รหัสผ่าน</label>
                    <input class="border border-gray-300 rounded-xl p-2 w-full focus:border-orange-500 outline-none"
                        type="password" id="password" name="password" placeholder="ป้อนรหัสผ่านของคุณ" required />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-600 mb-1" for="password_confirmation">ยืนยันรหัสผ่าน</label>
                    <input class="border border-gray-300 rounded-xl p-2 w-full focus:border-orange-500 outline-none"
                        type="password" id="password_confirmation" name="password_confirmation"
                        placeholder="ยืนยันรหัสผ่านของคุณ" required />
                </div>
                <div class="mb-4">
                    <label for="profile_image"
                        class="block text-gray-800 text-sm font-medium mb-2">โปรไฟล์ลูกค้า</label>
                    <div class="flex items-center justify-center w-full">
                        <label
                            class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16l-4-4m0 0l4-4m-4 4h18m-8 4l4-4m0 0l-4-4m4 4H3"></path>
                                </svg>
                                <p class="mb-2 text-sm text-gray-500"><span
                                        class="font-semibold">คลิกเพื่ออัปโหลด</span>
                                    หรือ ลากไฟล์มาที่นี่</p>
                                <p class="text-xs text-gray-500">PNG, JPG หรือ GIF (ขนาดไม่เกิน 2MB)</p>
                            </div>
                            <input type="file" name="image" id="image" class="hidden" />
                        </label>
                    </div>
                </div>
                <div class="w-full text-center">
                    <button
                        class="mt-8 mb-4 w-full bg-[#DC5F00] hover:bg-[#c55500] text-white font-bold py-2 px-4 rounded-xl focus:outline-none focus:shadow-outline"
                        type="submit">สมัครสมาชิก</button>
                    <a class="hover:underline w-full text-[#DC5F00] font-bold py-2 px-4 rounded-xl focus:outline-none focus:shadow-outline"
                        href="/">
                        เข้าสู่ระบบ
                    </a>
                </div>
            </form>
        </div>
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
