<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
</head>

<style>
    body {
        font-family: 'Kanit', sans-serif;
    }
</style>

<body>
    @extends('layouts.admin')


    @section('content')
        <div class="flex items-center justify-center min-h-screen px-4 py-12 sm:px-6 lg:px-8 mt-[-30px]">
            <div class="p-6 sm:p-8 rounded-2xl bg-white shadow-xl w-full max-w-md">
                <h1 class="text-center text-2xl font-bold mb-3">เลือกพนักงาน</h1>
                <form id="repair-form" action="{{ route('repair.update', $repair->repair_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="repair_detail" class="text-gray-800 text-sm mb-2 block">รายละเอียดการแจ้งซ่อม</label>
                        <div class="relative flex items-center">
                            <input type="text" name="repair_detail" id="repair_detail"
                                class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3  outline-blue-600"
                                value="{{ old('repair_detail', $repair->repair_detail) }}" required>
                        </div>

                        <label for="employee_id" class="text-gray-800 text-sm mb-2 block">นำพนักงานเพื่อไปซ่อม</label>
                        <div class="relative flex items-center mb-4">
                            <select name="employee_id" id="employee_id" class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3  outline-blue-600">
                                <option value="">เลือกพนักงาน</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}"
                                        {{ $repair->employee_id == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="button" id="submit-btn" class="mt-2 w-full bg-[#A3C9F0] hover:bg-[#D0E4F4] text-black py-3  mb-4 transition duration-300 ease-in-out">
                            บันทึก
                        </button>

                        <div class="w-full text-center flex justify-center">
                            <a href="{{ route('customer.repir') }}" class="text-black text-sm hover:underline text-center">กลับไปยังรายการ</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <script>
            document.getElementById('submit-btn').addEventListener('click', function (event) {
                event.preventDefault(); // Prevent the form from submitting immediately

                Swal.fire({
                    title: "เลือกพนักงานคนนี้ใช้ไหม?",
                    text: "แน่ใจใช่ไหม?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "ใช่, แน่นอน!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('repair-form').submit(); // Submit the form if confirmed
                    }
                });
            });
        </scrip>
    @endsection
</body>

</html>
