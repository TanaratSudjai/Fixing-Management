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
        <div class="p-6 bg-white border h-[100vh] flex justify-center w-full">
            <div class="container mx-auto">
                <div class="bg-white p-4 px-4 md:p-8 mb-6 h-[80vh]">
                    <h1 class="text-2xl bg-blue-500 p-5 text-center font-bold text-white">รายการการซ่อม</h1>
                    
                    <!-- รายการที่ยังไม่ได้แจ้งลูกค้า -->
                    <div class="space-y-4">
                        <h2 class="text-xl font-bold mb-4 mt-2">รายการที่ยังไม่ได้แจ้งลูกค้า</h2>
                        @foreach ($workrepair as $repair)
                            <div class="bg-gray-100 shadow-lg overflow-hidden">
                                <div class="p-4 border-b border-gray-200">
                                    <p class="text-sm font-bold text-gray-600">รหัสการซ่อม: <span
                                            class="text-gray-800">{{ $repair->repair_id }}</span></p>
                                    <p class="text-sm font-bold text-gray-600">ชื่อลูกค้า: <span
                                            class="text-gray-800">{{ $repair->customer->name }}</span></p>
                                </div>
                                <div class="p-4">
                                    <p class="text-sm font-bold text-gray-600">รายละเอียดการซ่อม: <span
                                            class="text-gray-800">{{ $repair->repair_detail }}</span></p>
                                    <p class="text-sm font-bold text-gray-600">รหัสสถานะ: <span
                                            class="text-gray-800">{{ $repair->status->status_name }}</span></p>
                                    <p class="text-sm font-bold text-gray-600">สินค้า: <span
                                            class="text-gray-800">{{ $repair->product->product_name ?? 'ยังไม่เบิกสินค้า' }}</span>
                                    </p>
                                    <p class="text-sm font-bold text-gray-600">แก้ไขหน่วย: <span
                                            class="text-gray-800">{{ $repair->unit_amount ?? 'ยังไม่เบิกสินค้า' }}</span></p>
                                    <p class="text-sm font-bold text-gray-600">สร้างเมื่อ: <span
                                            class="text-gray-800">{{ $repair->created_at }}</span></p>
                                    <p class="text-sm font-bold text-gray-600">อัปเดตเมื่อ: <span
                                            class="text-gray-800">{{ $repair->updated_at }}</span></p>
                                </div>
                                <div class="p-4 border-t border-gray-200 bg-gray-50 text-right">
                                    @if ($repair->product != null)
                                        <form action="{{ route('repair.updateStatus', $repair->repair_id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status_id" value="2">
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 ">
                                                เเจ้งลูกค้า
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('repair.selectproduct', $repair->repair_id) }}"
                                            class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 ">
                                            เบิกอะไหล่
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- รายการที่แจ้งลูกค้าแล้ว -->
                    <div class="mt-8">
                        <h2 class="text-xl font-bold mb-4 mt-2">รายการที่แจ้งลูกค้าแล้ว</h2>
                        @foreach ($inprogress as $repairInpogress)
                            <div class="bg-white shadow-md p-4 mb-4">
                                <p class="text-sm font-bold text-gray-600">รหัสการซ่อม: <span
                                        class="text-gray-800">{{ $repairInpogress->repair_id }}</span></p>
                                <p class="text-sm font-bold text-gray-600">ชื่อลูกค้า: <span
                                        class="text-gray-800">{{ $repairInpogress->customer->name }}</span></p>
                                <p class="text-sm font-bold text-gray-600">รายละเอียดการซ่อม: <span
                                        class="text-gray-800">{{ $repairInpogress->repair_detail }}</span></p>
                                <p class="text-sm font-bold text-gray-600">รหัสสถานะ: <span
                                        class="text-gray-800">{{ $repairInpogress->status->status_name }}</span></p>
                                <p class="text-sm font-bold text-gray-600">สินค้า: <span
                                        class="text-gray-800">{{ $repairInpogress->product->product_name ?? 'ยังไม่เบิกสินค้า' }}</span>
                                </p>
                                <p class="text-sm font-bold text-gray-600">สร้างเมื่อ: <span
                                        class="text-gray-800">{{ $repairInpogress->created_at }}</span></p>
                                <p class="text-sm font-bold text-gray-600">อัปเดตเมื่อ: <span
                                        class="text-gray-800">{{ $repairInpogress->updated_at }}</span></p>
                                <div class="mt-3">
                                    <form action="{{ route('repair.done', $repairInpogress->repair_id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status_id" value="3">
                                        <button type="submit"
                                            class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 ">
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
