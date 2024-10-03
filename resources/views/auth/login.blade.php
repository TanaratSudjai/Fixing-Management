<!DOCTYPE html>
<html lang="th">

<head></head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
</style>
</head>

<body class="bg-gray-100 flex justify-center items-center min-h-screen">
    <div class="w-full max-w-xs">
        <div class="bg-white shadow-2xl rounded-lg p-6">
            <div class="flex justify-center mb-4">
                <img src="{{ asset('/images/logoo.png') }}" alt="Logo" class="w-20 h-20">
            </div>
            <h2 class="text-lg text-gray-800 text-center mb-8">ลงชื่อเข้าใช้บัญชีของคุณ</h2>
            <form id="loginForm" method="POST" action="{{ route('login') }}" class="flex flex-col">
                @csrf
                <div class="mb-3">
                    <label for="email" class="block text-gray-600 mb-1">อีเมล</label>
                    <input type="email" id="email" name="email"
                        class="block w-full p-2 border-2 focus:border-orange-500 outline-none mb-2 text-sm sm:text-base rounded-xl"
                        placeholder="ป้อนอีเมลของคุณ" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-600 mb-1">รหัสผ่าน</label>
                    <input type="password" id="password" name="password"
                        class="block w-full p-2 border-2 focus:border-orange-500 outline-none rounded-xl mb-2 text-sm sm:text-base"
                        placeholder="ป้อนรหัสผ่านของคุณ" required>
                </div>
                <button type="submit"
                    class="bg-[#DC5F00] hover:bg-[#c55500] text-white font-bold py-2 px-4 rounded-xl focus:outline-none focus:shadow-outline mt-4 text-base sm:text-lg">เข้าสู่ระบบ</button>
            </form>
            <div class="flex w-full justify-center font-bold">
                <p class="w-full mt-6 flex justify-between text-xs sm:text-sm">
                    ยังไม่มีบัญชี?
                    <a href="/register" class="hover:underline">สมัครสมาชิก</a>
                </p>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'รหัสผ่านไม่ถูกต้อง',
                html: '{!! implode('<br>', $errors->all()) !!}',
            })
        </script>
    @endif
</body>

</html>
