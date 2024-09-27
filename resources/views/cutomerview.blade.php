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

<body class="bg-gray-100 font-['Kanit']">
    @extends('layouts.customer')

    @section('content')
        <div
            class="bg-white bg-cover bg-center h-20 shadow-md flex justify-center items-center fixed top-0 w-full z-10">
            <img src="{{ asset('images/logoo.png') }}" class="w-10 h-10">
        </div>

        <div class="h-[92vh] flex items-center justify-center w-full px-4">
            <div class=" w-full max-w-md mx-auto px-6 py-8 rounded-lg">
                <form action="{{ route('repairs.store') }}" method="POST" class="space-y-6">
                    @if (session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded"
                            role="alert">
                            <p class="font-bold">สำเร็จ!</p>
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded" role="alert">
                            <p class="font-bold">เกิดข้อผิดพลาด</p>
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @csrf
                    <header class="text-center mb-8">
                        <h1
                            class="text-2xl md:text-3xl lg:text-4xl font-bold text-[#DC5F00] mb-2 transform hover:scale-105 transition duration-300">
                            แจ้งซ่อมสำหรับลูกค้า
                        </h1>
                    </header>

                    <div>
                        <label for="repair_detail" class="block text-sm font-medium text-[#686D76] mb-2">
                            รายละเอียดการซ่อม
                        </label>
                        <textarea id="repair_detail" name="repair_detail" rows="4"
                            class="w-full px-3 py-2 h-[370px] text-[#373A40] border border-[#686D76] rounded-lg focus:outline-none focus:border-[#DC5F00] transition duration-300"
                            required></textarea>
                    </div>

                    <button type="submit"
                        class="w-full bg-[#DC5F00] hover:bg-[#FF6F00] text-white font-bold py-2 px-4 rounded-lg transform hover:scale-105 transition duration-300 focus:outline-none focus:ring-2 focus:ring-[#DC5F00] focus:ring-opacity-50">
                        ส่งคำขอ
                    </button>
                </form>
            </div>
        </div>

    @endsection
</body>

</html>
