<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-200">
    <div class="flex justify-center min-h-screen w-full items-center px-4 sm:px-0">
        <div class="p-6 sm:p-10 w-full max-w-xs sm:max-w-md rounded-lg">
            <div class="flex items-center justify-center mb-4 sm:mb-6">
                <img src="{{ asset('/images/logoo.png') }}" alt="Logo" class="w-20 sm:w-23 h-16 sm:h-20">
            </div>
            <h2 class="text-lg sm:text-xl text-gray-800 text-center mb-8 sm:mb-10">ลงชื่อเข้าใช้บัญชีของคุณ</h2>
            <form method="POST" action="/login" class="flex flex-col">
                <div class="mb-3 sm:mb-4">
                    <label for="email" class="block text-gray-600 mb-1">อีเมล</label>
                    <input type="email" id="email" name="email"
                        class="block w-full p-2 border-2 focus:border-orange-500 outline-none mb-2 text-sm sm:text-base rounded-xl"
                        placeholder="ป้อนอีเมลของคุณ" required>
                </div>
                <div class="mb-4 sm:mb-6">
                    <label for="password" class="block text-gray-600 mb-1">รหัสผ่าน</label>
                    <input type="password" id="password" name="password"
                        class="block w-full p-2 border-2 focus:border-orange-500 outline-none rounded-xl mb-2 text-sm sm:text-base"
                        placeholder="ป้อนรหัสผ่านของคุณ" required>
                </div>
                <button type="submit"
                    class="bg-[#DC5F00] hover:bg-[#c55500] text-white font-bold py-2 px-4 rounded-xl focus:outline-none focus:shadow-outline mt-4 text-base sm:text-lg">เข้าสู่ระบบ</button>
            </form>
            <div class="flex w-full justify-center">
                <p class="w-full mt-6 sm:mt-8 flex justify-between text-xs sm:text-sm">
                    ยังไม่มีบัญชี?
                    <a href="/register" class="text-[#DC5F00] hover:text-[#c55500] ml-1 hover:underline">สมัครสมาชิก</a>
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
