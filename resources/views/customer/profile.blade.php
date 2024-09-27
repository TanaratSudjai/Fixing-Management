<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .scrollbar::-webkit-scrollbar {
            width: 10px;
        }

        .scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .scrollbar::-webkit-scrollbar-thumb {
            background-color: #686D76;
            border-radius: 10px;
            border: 3px solid #f1f1f1;
        }
    </style>
</head>

<body>
    @extends('layouts.customer')
    @section('content')
        <div class="bg-white bg-cover bg-center h-20 shadow-md flex justify-center items-center fixed top-0 w-full z-10">
            <img src="{{ asset('images/logoo.png') }}" class="w-10 h-10">
        </div>
        <div class=" min-h-screen overflow-x-auto">
            <div class="bg-cover bg-center h-40 sm:h-56 bg-gray-300">
            </div>
            <div class="relative">
                <div class="absolute -top-16 sm:-top-20 left-1/2 transform -translate-x-1/2">
                    <img src="{{ asset($customer->image) }}" alt="Profile Image"
                        class="w-28 h-28 sm:w-36 sm:h-36 rounded-full border-4 border-white object-cover shadow-lg">
                </div>
            </div>

            <div class="text-center mt-20 sm:mt-24">
                <h1 class="text-2xl sm:text-3xl font-semibold">{{ $customer->name }}</h1>
                <p class="text-gray-500">{{ $customer->email }}</p>
            </div>
            <div class="px-4 sm:px-6 lg:px-8 mt-8 max-h-screen overflow-y-auto scrollbar">
                <div class="rounded-lg p-6 max-w-3xl mx-auto bg-[#EEEEEE] shadow-lg">
                    <h2 class="text-xl font-semibold mb-4  text-center">ประวัติการเเจ้งซ่อม</h2>
                    <ul class="text-gray-700 space-y-3 flex flex-col gap-5">
                        <li class="flex items-center justify-between shadow-md p-6 bg-[#FF6F00] text-white rounded-xl">
                            <strong class="w-1/2 text-white">รอการตอบรับ</strong>
                            <span>{{ $countRepair_pending }}</span>
                        </li>
                        <li class="flex items-center justify-between shadow-md p-6 bg-[#DC5F00] text-white rounded-xl">
                            <strong class="w-1/2 text-white">กำลังดำเนินการ:</strong>
                            <span>{{ $countRepair_inprogress }}</span>
                        </li>
                        <li class="flex items-center justify-between shadow-md p-6 bg-[#686D76] text-white rounded-xl">
                            <strong class="w-1/2 text-white">เสร็จสมบูรณ์:</strong>
                            <span>{{ $countRepair_done }}</span>
                        </li>

                        <li class="flex items-center justify-between shadow-md p-6 bg-[#686D76] text-white rounded-xl">
                            <strong class="w-1/2 text-white">
                                <a href="{{ route('logout') }}">ออกจากระบบ</a>
                            </strong>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @endsection
</body>

</html>
