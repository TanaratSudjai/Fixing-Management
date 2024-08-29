<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="bg-[#373A40] flex items-center justify-center min-h-screen bg-background">
        <div class="bg-white bg-card p-10 rounded-lg shadow-2xl w-full mx-[17%] xl:max-w-xl">
            <div class="flex items-center justify-center mb-6">
                <img src={{asset('images/logoo.png')}} alt="Logo" class="w-23 h-20">

            </div>
            <h2 class="text-xl text-foreground text-center mb-10">ลงชื่อเข้าใช้บัญชีของคุณ</h2>

            <form method="POST" action="{{ route('login') }}" class="flex flex-col">
                @csrf
                <div class="mb-2">
                    <label for="email" class="block text-muted-foreground mb-1">อีเมล</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="block w-full p-2 border border-border rounded mb-4 text-base" placeholder="ป้อนอีเมลของคุณ"
                        required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-muted-foreground mb-1">รหัสผ่าน</label>
                    <input type="password" id="password" name="password"
                        class="block w-full p-2 border border-border rounded mb-4 " placeholder="ป้อนรหัสผ่านของคุณ"
                        required>
                </div>

                <button type="submit"
                    class="bg-[#DC5F00] hover:bg-[#DC5F00] text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-4 text-lg">เข้าสู่ระบบ</button>
            </form>

            <p class="w-full mt-8 flex justify-between"> ยังไม่มีบัญชี? 
                <a href="{{ route('register') }}" class="text-[#DC5F00] hover:text-[#DC5F00] ml-1 hover:underline">สมัครสมาชิก</a>
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