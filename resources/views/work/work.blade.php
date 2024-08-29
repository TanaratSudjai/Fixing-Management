<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work Repair List</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Kanit', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100">
    @extends('layouts.employ')
    @section('content')
        <div class="p-6 bg-[#EEEEEE] border flex justify-center w-full">
            <div class="container mx-auto">
                <div class="bg-white p-14 px-4 md:p-16 mb-6">
                    <h1 class="text-2xl bg-[#DC5F00] p-5 text-center font-bold text-[#EEEEEE]">รายการการซ่อม</h1>

                    <!-- รายการที่ยังไม่ได้แจ้งลูกค้า -->
                    <div class="space-y-4">
                        <h2 class="text-xl font-bold mb-4 mt-2 text-[#373A40]">รายการที่ยังไม่ได้แจ้งลูกค้า</h2>
                        @foreach ($workrepair as $repair)
                            <div class="bg-[#EEEEEE] shadow-lg overflow-hidden">
                                <div class="p-4 border-b border-[#686D76]">
                                    <p class="text-sm font-bold text-[#686D76]">รหัสการซ่อม: <span
                                            class="text-[#373A40]">{{ $repair->repair_id }}</span></p>
                                    <p class="text-sm font-bold text-[#686D76]">ชื่อลูกค้า: <span
                                            class="text-[#373A40]">{{ $repair->customer->name }}</span></p>
                                </div>
                                <div class="p-4">
                                    <p class="text-sm font-bold text-[#686D76]">รายละเอียดการซ่อม: <span
                                            class="text-[#373A40]">{{ $repair->repair_detail }}</span></p>
                                    <p class="text-sm font-bold text-[#686D76]">รหัสสถานะ: <span
                                            class="text-[#373A40]">{{ $repair->status->status_name }}</span></p>
                                    <p class="text-sm font-bold text-[#686D76]">สินค้า: <span
                                            class="text-[#373A40]">{{ $repair->product->product_name ?? 'ยังไม่เบิกสินค้า' }}</span>
                                    </p>
                                    <p class="text-sm font-bold text-[#686D76]">แก้ไขหน่วย: <span
                                            class="text-[#373A40]">{{ $repair->unit_amount ?? 'ยังไม่เบิกสินค้า' }}</span>
                                    </p>
                                    <p class="text-sm font-bold text-[#686D76]">สร้างเมื่อ: <span
                                            class="text-[#373A40]">{{ $repair->created_at }}</span></p>
                                    <p class="text-sm font-bold text-[#686D76]">อัปเดตเมื่อ: <span
                                            class="text-[#373A40]">{{ $repair->updated_at }}</span></p>
                                </div>
                                <div class="p-4 border-t border-[#686D76] bg-[#F0F0F0] text-right">
                                    @if ($repair->product != null)
                                        <form action="{{ route('repair.updateStatus', $repair->repair_id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status_id" value="2">
                                            <button type="submit"
                                                class="bg-[#DC5F00] hover:bg-[#E55C00] text-white font-bold py-2 px-4 ">
                                                เเจ้งลูกค้า
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('repair.selectproduct', $repair->repair_id) }}"
                                            class="bg-[#686D76] hover:bg-[#575B60] text-white font-bold py-2 px-4 ">
                                            เบิกอะไหล่
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- รายการที่แจ้งลูกค้าแล้ว -->
                    <div class="mt-8">
                        <h2 class="text-xl font-bold mb-4 mt-2 text-[#373A40]">รายการที่แจ้งลูกค้าแล้ว</h2>
                        @foreach ($inprogress as $repairInpogress)
                            <div class="bg-[#EEEEEE] shadow-md p-4 mb-4">
                                <p class="text-sm font-bold text-[#686D76]">รหัสการซ่อม: <span
                                        class="text-[#373A40]">{{ $repairInpogress->repair_id }}</span></p>
                                <p class="text-sm font-bold text-[#686D76]">ชื่อลูกค้า: <span
                                        class="text-[#373A40]">{{ $repairInpogress->customer->name }}</span></p>
                                <p class="text-sm font-bold text-[#686D76]">รายละเอียดการซ่อม: <span
                                        class="text-[#373A40]">{{ $repairInpogress->repair_detail }}</span></p>
                                <p class="text-sm font-bold text-[#686D76]">รหัสสถานะ: <span
                                        class="text-[#373A40]">{{ $repairInpogress->status->status_name }}</span></p>
                                <p class="text-sm font-bold text-[#686D76]">สินค้า: <span
                                        class="text-[#373A40]">{{ $repairInpogress->product->product_name ?? 'ยังไม่เบิกสินค้า' }}</span>
                                </p>
                                <p class="text-sm font-bold text-[#686D76]">สร้างเมื่อ: <span
                                        class="text-[#373A40]">{{ $repairInpogress->created_at }}</span></p>
                                <p class="text-sm font-bold text-[#686D76]">อัปเดตเมื่อ: <span
                                        class="text-[#373A40]">{{ $repairInpogress->updated_at }}</span></p>
                                <div class="mt-3">
                                    <form action="{{ route('repair.done', $repairInpogress->repair_id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status_id" value="3">
                                        <button type="submit"
                                            class="bg-[#DC5F00] hover:bg-[#E55C00] text-white font-bold py-2 px-4 ">
                                            ซ่อมสำเร็จ
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endsection

</body>

</html>
