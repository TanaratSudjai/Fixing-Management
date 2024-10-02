<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">

</head>

<body class="bg-[#EEEEEE] font-kanit">
    @extends('layouts.admin')
    @section('content')
        <div class="flex justify-center h-[92vh] items-center p-4 bg-[#EEEEEE]">
            <div class="bg-white shadow-xl w-full max-w-lg rounded-lg p-6 sm:p-8">
                <h1 class="text-center text-[#373A40] text-2xl font-bold mb-5">เลือกพนักงาน</h1>
                <form id="repair-form" action="{{ route('repair.update', $repair->repair_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="repair_detail" class="text-gray-800 text-sm mb-2 block">รายละเอียดการแจ้งซ่อม</label>
                        <input type="text" name="repair_detail" id="repair_detail"
                            class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md outline-blue-600"
                            value="{{ old('repair_detail', $repair->repair_detail) }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="employee_id" class="text-gray-800 text-sm mb-2 block">นำพนักงานเพื่อไปซ่อม</label>
                        <select name="employee_id" id="employee_id"
                            class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md outline-blue-600">
                            <option value="">เลือกพนักงาน</option>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}"
                                    {{ $repair->employee_id == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" id="submit-btn"
                        class="w-full bg-[#DC5F00] hover:bg-[#DC5F00] text-white py-3 rounded-md transition duration-300 ease-in-out">
                        บันทึก
                    </button>

                    <div class="w-full text-center mt-4">
                        <a href="{{ route('customer.repir') }}"
                            class="text-[#373A40] text-sm hover:underline">กลับไปยังรายการ</a>
                    </div>
                </form>
            </div>
        </div>
    @endsection
    <script>
        document.getElementById('submit-btn').addEventListener('click', function(event) {
            event.preventDefault();
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
    </script>
</body>

</html>
