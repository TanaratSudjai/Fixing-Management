<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
</head>

<body class="bg-[#E1F7F5] flex items-center justify-center min-h-screen" style="font-family: 'Kanit', sans-serif">
    <div class="bg-white p-6 md:p-8 lg:p-10 rounded-lg shadow-lg w-11/12 sm:w-2/3 md:w-1/2 lg:w-1/3 xl:w-1/4">
        <div class="flex justify-center mb-4">
            <img src="logo.png" alt="Logo" class="w-23 h-20">
        </div>
        <h2 class="text-xl md:text-2xl font-semibold text-center mb-6">เข้าสู่ระบบบัญชีของคุณ</h2>
        <form method="POST" action="{{ route('login') }}" class="flex flex-col">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">อีเมล</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">รหัสผ่าน</label>
                <input type="password" id="password" name="password" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <button type="submit"
                class="bg-[#A3C9F0] hover:bg-[#D0E4F4] text-black font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">เข้าสู่ระบบ</button>
        </form>

        <p class="text-center text-gray-500 text-xs mt-4"> ยังไม่ได้เป็นสมาชิก? <a
                href="{{ route('register') }}" class="text-blue-500 hover:text-blue-700">สมัครสมาชิก</a></p>
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