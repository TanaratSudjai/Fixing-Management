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
                    <div class=" overflow-x-auto overflow-y-auto h-[90%]">
                        <table class="text-sm text-center text-black w-full">
                            <thead class="bg-gray-200 top-0">
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
                                                <a onclick="toggleEditEmployeeModal({{ $repair->repair_id }}, '{{ $repair->repair_detail }}', {{ $repair->employee_id ?? 'null' }})"
                                                    class="text-[#DC5F00] bg-[#EEEEEE]">เปลี่ยนพนักงาน</a>
                                            @else
                                                <a onclick="toggleEditEmployeeModal({{ $repair->repair_id }},'{{ $repair->repair_detail }}')"
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

    <div id="editEmployeeModal" class="fixed hidden w-full bg-opacity-50 backdrop-blur-sm">
        <div class=" w-full h-[95vh]  flex justify-center items-center">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md space-y-4">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">แก้ไขสินค้า</h2>
                    <button onclick="toggleEditEmployeeModal()" class="text-gray-400 hover:text-gray-600">
                        &times;
                    </button>

                </div>
                <h1 class="text-center text-[#373A40] text-2xl font-bold mb-5">เลือกพนักงาน</h1>
                <form id="repair-form" action="{{ route('repair.update', $repair->repair_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="repair_detail"
                            class="text-gray-800 text-sm mb-2 block">รายละเอียดการแจ้งซ่อม</label>
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
    </div>

    <script>
        function toggleEditEmployeeModal(repair_id, repair_detail, employee_id) {
            const modal = document.getElementById('editEmployeeModal');
            const form = document.getElementById('repair-form'); // Correct form ID

            // Toggle modal visibility
            modal.style.display = modal.style.display === 'none' ? 'block' : 'none';

            // Only if repair_id is provided, set the form action dynamically
            if (repair_id) {
                form.action = `/repair/update/${repair_id}`;
            }

            // Set the value of the repair_detail input field
            document.getElementById('repair_detail').value = repair_detail;

            // Set the selected employee in the dropdown
            const employeeSelect = document.getElementById('employee_id');
            employeeSelect.value = employee_id || ""; // Pre-select the employee if employee_id is provided
        }
    </script>


</body>

</html>
