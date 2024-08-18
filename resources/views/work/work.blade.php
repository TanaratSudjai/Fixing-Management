<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work Repair List</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    @extends('layouts.employ')
    @section('content')
        <div class="p-6 bg-white border h-[100vh] flex justify-center w-full">
            <div class="container mx-auto">
                <div class="bg-white rounded p-4 px-4 md:p-8 mb-6 h-[80vh]">
                    <h1 class="text-xl text-white bg-[#17a2b8] p-5">Work Repair List</h1>
                    <div>
                        @foreach ($workrepair as $repair)
                            <div class="bg-white rounded-lg shadow-md p-4 mb-4">
                                <p class="text-sm font-bold text-gray-600">Repair ID: <span
                                        class="text-gray-800">{{ $repair->repair_id }}</span></p>
                                <p class="text-sm font-bold text-gray-600">Customer Name: <span
                                        class="text-gray-800">{{ $repair->customer->name }}</span></p>
                                <p class="text-sm font-bold text-gray-600">Repair Detail: <span
                                        class="text-gray-800">{{ $repair->repair_detail }}</span></p>
                                <p class="text-sm font-bold text-gray-600">Status ID: <span
                                        class="text-gray-800">{{ $repair->status->status_name }}</span></p>
                                <p class="text-sm font-bold text-gray-600">Product: <span
                                        class="text-gray-800">{{ $repair->product->product_name ?? 'ยังไม่เบิกสินค้า' }}</span>
                                </p>
                                <p class="text-sm font-bold text-gray-600">Unit Fix: <span
                                        class="text-gray-800">{{ $repair->unit_amount ?? 'ยังไม่เบิกสินค้า' }}</span></p>
                                <p class="text-sm font-bold text-gray-600">Created At: <span
                                        class="text-gray-800">{{ $repair->created_at }}</span></p>
                                <p class="text-sm font-bold text-gray-600">Updated At: <span
                                        class="text-gray-800">{{ $repair->updated_at }}</span></p>
                                <div class="mt-3">
                                    @if ($repair->product != null)
                                        <form action="{{ route('repair.updateStatus', $repair->repair_id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status_id" value="2">
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                                                เเจ้งลูกค้า
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('repair.selectproduct', $repair->repair_id) }}"
                                            class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                                            เบิกอะไหล่
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Second List -->
                    <div>
                        @foreach ($inprogress as $repairInpogress)
                            <div class="bg-white rounded-lg shadow-md p-4 mb-4">
                                <p class="text-sm font-bold text-gray-600">Repair ID: <span
                                        class="text-gray-800">{{ $repairInpogress->repair_id }}</span></p>
                                <p class="text-sm font-bold text-gray-600">Customer Name: <span
                                        class="text-gray-800">{{ $repairInpogress->customer->name }}</span></p>
                                <p class="text-sm font-bold text-gray-600">Repair Detail: <span
                                        class="text-gray-800">{{ $repairInpogress->repair_detail }}</span></p>
                                <p class="text-sm font-bold text-gray-600">Status ID: <span
                                        class="text-gray-800">{{ $repairInpogress->status->status_name }}</span></p>
                                <p class="text-sm font-bold text-gray-600">Product: <span
                                        class="text-gray-800">{{ $repairInpogress->product->product_name ?? 'ยังไม่เบิกสินค้า' }}</span>
                                </p>
                                <p class="text-sm font-bold text-gray-600">Created At: <span
                                        class="text-gray-800">{{ $repairInpogress->created_at }}</span></p>
                                <p class="text-sm font-bold text-gray-600">Updated At: <span
                                        class="text-gray-800">{{ $repairInpogress->updated_at }}</span></p>
                                <div class="mt-3">
                                    <form action="{{ route('repair.done', $repairInpogress->repair_id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status_id" value="3">
                                        <button type="submit"
                                            class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
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
