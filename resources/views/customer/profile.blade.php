<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    @extends('layouts.customer')
    @section('content')
        <div class="bg-gray-100 min-h-screen">

            <div class="bg-cover bg-center h-40 sm:h-56 bg-[#686D76]"></div>

            <div class="relative">
                <div class="absolute -top-12 left-1/2 transform -translate-x-1/2">
                    <img src="{{ asset($customer->image) }}" alt="Profile Image"
                        class="w-24 h-24 sm:w-32 sm:h-32 rounded-full border-4 border-white object-cover">
                </div>
            </div>

            <div class="text-center mt-16 sm:mt-20">
                <h1 class="text-2xl sm:text-3xl font-semibold">{{ $customer->name }}</h1>
                <p class="text-gray-600">{{ $customer->email }}</p>
            </div>

            <div class="px-5">
                <div class="mt-8 bg-white shadow-lg rounded-lg p-6 max-w-4xl mx-auto">
                    <h2 class="text-lg font-medium mb-4">ข้อมูลพนักงาน</h2>
                    <ul class="text-gray-700">
                        <li class="mb-2"><strong>ตำแหน่ง:</strong>
                            @if ($customer->status == 0)
                                ลูกค้าทั่วไป
                            @endif
                        </li>
                        <li class="mb-2"><strong>วันที่เข้าทำงาน:</strong> {{ $customer->created_at }}</li>
                        <li class="mb-2"><strong>วันที่ทำงานปัจจุุบัน:</strong> {{ $customer->updated_at }}</li>
                    </ul>
                </div>
            </div>
        </div>
    @endsection
</body>

</html>
