<!DOCTYPE html>
<html lang="th" class="min-h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายการแจ้งซ่อม</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
</head>

<style>
    body {
        font-family: 'Kanit', sans-serif;
    }
</style>

<body>
    @extends('layouts.customer')

    @section('content')
        <h1 class="text-3xl font-bold text-[#DC5F00] p-4 text-center mb-6">รายการแจ้งซ่อม</h1>
        <div class="max-w-3xl mx-auto space-y-4 px-4">
            @foreach ($repairs as $repair)
                <div class="bg-[#EEEEEE] p-4 shadow-md hover:shadow-lg transition-shadow duration-200 rounded-lg">
                    <div class="flex justify-between items-center mb-2">
                        <h2 class="text-lg font-semibold text-[#686D76]">รหัส: {{ $repair->repair_id }}</h2>
                        <span
                            class="px-2 py-1 text-xs font-semibold rounded-full 
                        {{ $repair->status_id == 1
                            ? 'bg-yellow-200 text-yellow-800'
                            : ($repair->status_id == 2
                                ? 'bg-blue-200 text-blue-800'
                                : 'bg-green-200 text-green-800') }}">
                            {{ $repair->status->status_name ?? 'N/A' }}
                        </span>
                    </div>
                    <p class="text-sm text-[#686D76] mb-1">
                        <span class="font-medium">ลูกค้า:</span> {{ $repair->customer->name ?? 'customer' }}
                    </p>
                    <p class="text-sm text-[#686D76]">
                        <span class="font-medium">รายละเอียด:</span> {{ $repair->repair_detail }}
                    </p>
                    <div class="mt-3 text-right">
                        @if ($repair->status_id == 1)
                            <a href="{{ route('repairs.edit', $repair->repair_id) }}"
                                class="text-sm font-medium text-[#FFFFFF] border border-[#DC5F00] bg-[#DC5F00] px-2 py-1 rounded-md">แก้ไข</a>
                        @elseif ($repair->status_id == 2)
                            <span
                                class="text-sm font-medium text-[#4A90E2] px-2 py-1 rounded-md">กำลังดำเนินการ</span>
                        @else
                            <span
                                class="text-sm font-medium text-[#7ED321] px-2 py-1 rounded-md">ซ่อมเสร็จแล้ว</span>
                        @endif
                    </div>


                </div>
            @endforeach
        </div>
        <div class="w-full flex justify-end relative">
            <div
                class="bg-[#686D76] hover:bg-[#FF6F00] text-2xl w-[50px] h-[50px] flex items-center justify-center fixed top-[85%] right-5 m-4 rounded-full">
                <a href="{{ route('customer.dashboard') }}" class="text-[#EEEEEE]">X</a>
            </div>
        </div>
    @endsection
</body>

</html>
