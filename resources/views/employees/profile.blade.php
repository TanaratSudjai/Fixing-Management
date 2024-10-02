<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<style>
     body {
            font-family: 'Kanit', sans-serif;
            background-color: #f3f4f6;
        }
</style>
<body>
    @extends('layouts.employ')
    @section('content')
        <div class="bg-white bg-cover bg-center h-20 shadow-md flex justify-center items-center fixed top-0 w-full z-10">
            <img src="{{ asset('images/logoo.png') }}" class="w-10 h-10">
        </div>
        <div class="bg-gray-100 min-h-screen">

            <div class="bg-cover bg-center h-40 sm:h-56 bg-gray-200"></div>

            <div class="relative">
                <div class="absolute -top-12 left-1/2 transform -translate-x-1/2">
                    <img src="{{ asset('/' . $employee->image) }}" alt="Profile Image"
                        class="w-24 h-24 sm:w-32 sm:h-32 rounded-full border-4 border-white object-cover">
                </div>
            </div>

            <div class="text-center mt-16 sm:mt-20">
                <h1 class="text-2xl sm:text-3xl font-semibold">{{ $employee->name }}</h1>
                <p class="text-gray-600">{{ $employee->email }}</p>
            </div>

            <div class="px-5">
                <div class="mt-8 bg-white shadow-lg rounded-lg p-6 max-w-4xl mx-auto">
                    <h2 class="text-lg font-medium mb-4">ข้อมูลพนักงาน</h2>
                    <ul class="text-gray-700">
                        <li class="mb-2"><strong>ตำแหน่ง:</strong>
                            @if ($employee->status == 2)
                                พนักงานช่าง
                            @endif
                        </li>
                        <li class="mb-2"><strong>วันที่เข้าทำงาน:</strong> {{ $employee->created_at }}</li>
                        <li class="mb-2"><strong>วันที่ทำงานปัจจุุบัน:</strong> {{ $employee->updated_at }}</li>
                    </ul>
                    <hr>
                    <div class="card p-4 bg-white shadow-lg rounded-lg">
                        <h2 class="text-lg font-semibold mb-4">ประวัติการซ่อมของพนักงาน {{ $employee->name }}</h2>
                        <div class="overflow-x-auto">
                            <table class="min-w-full table-auto border-collapse border border-gray-300">
                                <thead>
                                    <tr class="bg-gray-200">
                                        <th class="px-2 text-sm blog py-2 border border-gray-300 text-left">รหัสลูกค้า</th>
                                        <th class="px-2 text-sm blog py-2 border border-gray-300 text-left">รายละเอียด</th>
                                        <th class="px-2 text-sm blog py-2 border border-gray-300 text-left">สินค้าที่เบิก
                                        </th>
                                        <th class="px-2 text-sm blog py-2 border border-gray-300 text-left">จำนวนเบิก</th>
                                        <th class="px-2 text-sm blog py-2 border border-gray-300 text-left">สถานะซ่อม</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($workHistory as $history)
                                        <tr class="bg-white border-b hover:bg-gray-100">
                                            <td class="px-2 text-sm blog py-2 border border-gray-300">
                                                {{ $history->customer->name }}</td>
                                            <td class="px-2 text-sm blog py-2 border border-gray-300">
                                                {{ $history->repair_detail }}</td>
                                            <td class="px-2 text-sm blog py-2 border border-gray-300">
                                                {{ $history->product->product_name }}</td>
                                            <td class="px-2 text-sm blog py-2 border border-gray-300">
                                                {{ $history->unit_amount }}</td>
                                            <td class="px-2 text-sm blog py-2 border border-gray-300">
                                                {{ $history->status->status_name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>


        </div>
    @endsection
</body>

</html>
