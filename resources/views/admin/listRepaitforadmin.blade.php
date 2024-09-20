<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Repairs List</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
</head>

<body class="bg-[#EEEEEE] font-kanit">
    @extends('layouts.admin')

    @section('content')
        <div class="p-6 bg-[#EEEEEE]  border h-[92vh] flex justify-center w-full">
            <div class="container mx-auto">
                <div class="bg-white p-4 px-4 md:p-8 mb-6 h-full rounded-md">
                    <h1 class="text-center text-2xl font-bold mb-3">รายการแจ้งซ่อม</h1>
                    <div class="relative overflow-x-auto overflow-y-auto h-[90%]">
                        <table class="text-sm text-center text-black w-full">
                            <thead class="bg-gray-200 sticky top-0">
                                <tr>
                                    <th class="text-center p-2 px-2 gap-2 w-1/12">รหัสแจ้งซ่อม</th>
                                    <th class="text-center p-2 px-2 gap-2 w-1/12">ชื่อลูกค้า</th>
                                    <th class="text-center p-2 px-2 gap-2 w-1/12">รายละเอียด</th>
                                    <th class="text-center p-2 px-2 gap-2 w-1/12">พนักงาน</th>
                                    <th class="text-center p-2 px-2 gap-2 w-1/12">สถานะ</th>
                                    <th class="text-center p-2 px-2 gap-2 w-1/12">ดำเนินการ</th>
                                </tr>
                            </thead>
                            <tbody class="text-center space-y-2">
                                @foreach ($repairs as $repair)
                                    <tr class="even:bg-gray-50">
                                        <td class="p-2">{{ $repair->repair_id }}</td>
                                        <td class="p-2">{{ $repair->customer->name }}</td>
                                        <td class="p-2">{{ $repair->repair_detail }}</td>
                                        <td class="p-2">{{ $repair->employee->name ?? 'กรุณาเลือกพนักงาน' }}</td>
                                        <td class="p-2">{{ $repair->status->status_name ?? 'N/A' }}</td>
                                        <td class="p-2">
                                            @if ($repair->status_id == 3)
                                                <a href="" class="text-[#EEEEEE] px-3 bg-[#686D76]">เรียบร้อย</a>
                                            @elseif($repair->status_id == 2)
                                                <a href="" class="text-[#EEEEEE] px-3 bg-[#DC5F00]">กำลังซ่อม</a>
                                            @elseif($repair->status_id == 1)
                                                <a href="{{ route('repair.selectemployee', $repair->repair_id) }}"
                                                    class="text-[#DC5F00] bg-[#EEEEEE]">เเจ้งพนักงานเเล้ว</a>
                                            @else
                                                <a href="{{ route('repair.selectemployee', $repair->repair_id) }}"
                                                    class="text-[#DC5F00] bg-[#EEEEEE]">เลือกพนักงาน</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection

</body>

</html>
