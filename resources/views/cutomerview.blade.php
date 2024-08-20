<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Repair Service</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
</head>

<body>
    <div class="nav p-10 bg-blue-500 h-2 flex justify-center items-center text-white">
        @if (session('message'))
            <span class="text-center"> สวัสดีคุณลูกค้า {{ session('message') }}</span>
        @endif
    </div>

    <div class="w-full mt-5 h-[75vh] max-w-sm mx-auto bg-white shadow-lg overflow-hidden">
        <header class="bg-blue-500 text-white text-center py-4">
            <h1 class="text-xl font-bold">เมนูการ</h1>
        </header>
        <div class="p-4">
            <a href="{{ route('customer.addrepir') }}"
                class="block bg-[#A3C9F0] hover:bg-[#D0E4F4] text-black text-center font-bold py-4 px-6 mb-4 shadow-md transition duration-300">
                เเจ้งซ่อม
            </a>
            <a href="{{ route('repairs.list') }}"
                class="block bg-[#A3C9F0] hover:bg-[#D0E4F4] text-black text-center font-bold py-4 px-6 shadow-md transition duration-300">
                รายการเเจ้งซ่อม
            </a>
        </div>
    </div>
    <div class="but logout p-3 flex justify-center">
        <a href="{{ route('login.form') }}"
            class="block bg-red-400 w-[380px] text-white text-center font-bold py-4 px-6 shadow-md transition duration-300">
            ออกจากระบบ
        </a>
    </div>
</body>

</html>
