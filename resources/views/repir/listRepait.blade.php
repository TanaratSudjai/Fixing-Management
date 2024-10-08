<!DOCTYPE html>
<html lang="th" class="min-h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายการแจ้งซ่อม</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<style>
    body {
        font-family: 'Kanit', sans-serif;
    }
</style>

<body class="w-full">
    @extends('layouts.customer')

    @section('content')
        <div class="bg-white bg-cover bg-center h-20 shadow-md flex justify-center items-center fixed top-0 w-full z-10">
            <img src="{{ asset('images/logoo.png') }}" class="w-10 h-10">
        </div>

        <h1 class="text-3xl font-bold text-[#DC5F00] p-4 text-center mb-6 mt-20">รายการแจ้งซ่อม</h1>

        <div class="max-w-3xl  mx-auto space-y-4 px-4 pb-20 custom-scroll"
            style="max-height: calc(100vh - 140px); overflow-y: auto;">

            <div class="mb-[100px]">
                @foreach ($repairs as $repair)
                    <div class="bg-[#EEEEEE] p-4 shadow-md hover:shadow-lg transition-shadow duration-200 rounded-lg mb-[20px]">
                        <div class="flex justify-between items-center mb-2">
                            <h2 class="text-lg font-semibold text-[#686D76]">รหัส: {{ $repair->repair_id }}</h2>
                            <span
                                class="px-2 py-1 text-xs font-semibold rounded-full 
                        {{ $repair->status_id == 1
                            ? 'bg-yellow-200 text-yellow-800'
                            : ($repair->status_id == 2
                                ? 'bg-blue-200 text-blue-800'
                                : ($repair->status_id == 3
                                    ? 'bg-[#ed9946] text-[#231508]'
                                    : 'bg-green-200 text-green-800')) }}">
                                {{ $repair->status->status_name ?? 'N/A' }}
                            </span>
                        </div>
                        <p class="text-sm text-[#686D76] mb-1">
                            <span class="font-medium">ลูกค้า:</span> {{ $repair->customer->name ?? 'customer' }}
                        </p>
                        <p class="text-sm text-[#686D76] mb-2">
                            <span class="font-medium">รายละเอียด:</span> {{ $repair->repair_detail }}
                        </p>
                        <div class="mt-3 text-right">
                            @if ($repair->status_id == 1)
                                <div class="flex gap-2">
                                    <a href="{{ route('repairs.edit', $repair->repair_id) }}"
                                        class="text-sm font-medium text-[#FFFFFF] border border-[#DC5F00] bg-[#DC5F00] px-3 py-1 rounded-md transition-colors duration-300 hover:bg-[#FF6F00]">แก้ไข</a>
                                    <form id="delete-form-{{ $repair->repair_id }}"
                                        action="{{ route('repairscustomer.delete', $repair->repair_id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete('{{ $repair->repair_id }}')"
                                            class="text-sm font-medium text-[#FFFFFF] border border-[#686D76] bg-[#686D76] px-3 py-1 rounded-md transition-colors duration-300 hover:bg-[#686D76]">ยกเลิก</button>
                                    </form>
                                </div>
                            @elseif ($repair->status_id == 2)
                                <span class="text-sm font-medium text-[#4A90E2] px-2 py-1 rounded-md">กรุณารอพนักงาน</span>
                            @elseif ($repair->status_id == 3)
                                <span class="text-sm font-medium text-[#ed9946] px-2 py-1 rounded-md">กำลังดำเนินการ</span>
                            @else
                                <span class="text-sm font-medium text-[#7ED321] px-2 py-1 rounded-md">ซ่อมเสร็จแล้ว</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <style>
            body,
            html {
                overflow: hidden;
                height: 100%;
            }

            .custom-scroll::-webkit-scrollbar {
                width: 8px;
            }

            .custom-scroll::-webkit-scrollbar-thumb {
                background-color: #DC5F00;
                border-radius: 16px;
            }

            .custom-scroll::-webkit-scrollbar-track {
                background-color: #f1f1f1;
            }

            .custom-scroll div:hover {
                background-color: #f5f5f5;
            }
        </style>

        <script>
            function confirmDelete(repairId) {
                Swal.fire({
                    title: 'ยืนยันการยกเลิกหรือไม่?',
                    text: "คุณลูกค้าต้องการยกเลิกรายการนี้หรือไม่ ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#FF6F00',
                    cancelButtonColor: '#686D76',
                    confirmButtonText: 'ยืนยันการยกเลิก',
                    cancelButtonText: 'กลับ'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + repairId).submit();
                    }
                });
            }
        </script>
    @endsection
</body>

</html>
