<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Repairs List</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

</head>
<style>
    body,
    html {
        overflow: hidden;
        height: 100%;
    }

    .custom-scroll {
        max-height: calc(100vh - 140px);
        overflow-y: auto;
    }

    .custom-scroll::-webkit-scrollbar {
        width: 8px;
    }

    .custom-scroll::-webkit-scrollbar-thumb {
        background-color: #DC5F00;
        border-radius: 8px;
    }

    .custom-scroll::-webkit-scrollbar-track {
        background-color: #f1f1f1;
    }

    .custom-scroll div:hover {
        background-color: #f5f5f5;
    }
</style>

<body class="bg-[#EEEEEE] font-kanit">
    @extends('layouts.admin')

    @section('content')
        <div class="p-6 bg-[#EEEEEE]  border h-[92vh] flex justify-center w-full ">
            <div class="container mx-auto">
                <div class="bg-white p-4 md:p-8 mb-6 rounded-md shadow-lg mb-5">
                    <h1 class="text-center text-3xl font-bold mb-6">รายการแจ้งซ่อม</h1>

                    {{-- Search Fields --}}
                    <div
                        class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6 p-4 bg-[#F7F7F7] border border-gray-300 rounded-lg shadow-sm">
                        <input id="employee-search" type="text"
                            class="block w-full border border-gray-300 rounded-lg placeholder-gray-500 text-gray-900 cursor-pointer ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm py-2 px-4 transition duration-150 hover:ring-gray-400 focus:outline-none"
                            placeholder="ค้นหาด้วยชื่อพนักงาน" oninput="searchRepairs()">

                        <input id="customer-search" type="text"
                            class="block w-full border border-gray-300 rounded-lg placeholder-gray-500 text-gray-900 cursor-pointer ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm py-2 px-4 transition duration-150 hover:ring-gray-400 focus:outline-none"
                            placeholder="ค้นหาด้วยชื่อลูกค้า" oninput="searchRepairs()">

                        <input id="detail-search" type="text"
                            class="block w-full border border-gray-300 rounded-lg placeholder-gray-500 text-gray-900 cursor-pointer ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm py-2 px-4 transition duration-150 hover:ring-gray-400 focus:outline-none"
                            placeholder="รายละเอียดการแจ้ง" oninput="searchRepairs()">
                    </div>

                    <div id="repair-table" class="custom-scroll overflow-y-auto ">
                        <table class="text-sm text-center text-black w-full min-w-[600px]">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="text-center p-2 px-2 gap-2 w-1/12  cols-2">รหัส</th>
                                    <th class="text-center p-2 px-2 gap-2 w-1/12  cols-2">ชื่อลูกค้า</th>
                                    <th class="text-center p-2 px-2 gap-2 w-1/12  cols-2">รายละเอียด</th>
                                    <th class="text-center p-2 px-2 gap-2 w-1/12  cols-2">พนักงาน</th>
                                    <th class="text-center p-2 px-2 gap-2 w-1/12  cols-2">สถานะ</th>
                                    <th class="text-center p-2 px-2 gap-2 w-1/12  cols-2">ดำเนินการ</th>
                                </tr>
                            </thead>
                            <tbody class="even:bg-gray-50 ">
                                @foreach ($repairs as $repair)
                                    <tr>
                                        <td class="p-2 ">{{ $repair->repair_id }}</td>
                                        <td class="p-2">{{ $repair->customer->name }}</td>
                                        <td class="p-2 ">{{ $repair->repair_detail }}</td>
                                        <td class="p-2 truncate">{{ $repair->employee->name ?? 'กรุณาเลือกพนักงาน' }}</td>
                                        <td class="p-2">{{ $repair->status->status_name ?? 'N/A' }}</td>
                                        <td class="p-2 break-keep">
                                            @if ($repair->status_id == 4)
                                                <a href="#"
                                                    class="text-[#EEEEEE] px-3 py-1 rounded bg-[#686D76] ">เรียบร้อย</a>
                                            @elseif($repair->status_id == 3)
                                                <a href="#"
                                                    class="text-[#EEEEEE] px-3 py-1 rounded bg-[#DC5F00] ">กำลังซ่อม</a>
                                            @elseif($repair->status_id == 2)
                                                <a onclick="toggleEditEmployeeModal({{ $repair->repair_id }}, '{{ $repair->repair_detail }}', {{ $repair->employee_id ?? 'null' }})"
                                                    class="text-[#DC5F00] bg-[#EEEEEE] px-3 py-1 rounded cursor-pointer break-keep truncate">เปลี่ยนพนักงาน</a>
                                            @else
                                                <a onclick="toggleEditEmployeeModal({{ $repair->repair_id }},'{{ $repair->repair_detail }}')"
                                                    class="text-[#DC5F00] bg-[#EEEEEE] px-3 py-1 rounded cursor-pointer break-all">เลือกพนักงาน</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div id="pagination-controls" class="flex justify-center items-center mt-4">
                        <button onclick="previousPage()"
                            class="bg-indigo-600 text-white py-2 px-4 rounded-lg mr-2">ก่อนหน้า</button>
                        <span id="current-page" class="text-gray-800">1</span> /
                        <span id="total-pages" class="text-gray-800">1</span>
                        <button onclick="nextPage()"
                            class="bg-indigo-600 text-white py-2 px-4 rounded-lg ml-2">ถัดไป</button>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    {{-- Modal --}}
    <div id="editEmployeeModal" class="fixed hidden w-full bg-opacity-50 backdrop-blur-sm">
        <div class=" w-full h-[95vh]  flex justify-center items-center">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md space-y-4">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold">เลือกพนักงาน</h2>
                    <button onclick="toggleEditEmployeeModal()" class="text-gray-400 hover:text-gray-600">
                        &times;
                    </button>
                </div>
                @if (isset($repair))
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
                            <label for="employee_id"
                                class="text-gray-800 text-sm mb-2 block">นำพนักงานเพื่อไปซ่อม</label>
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
                    </form>
                @else
                    <h1 class="text-center">ไม่มีรายการเเจ้งซ่อม</h1>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            toggleEditEmployeeModal();
        });

        function toggleEditEmployeeModal(repair_id, repair_detail, employee_id) {
            const modal = document.getElementById('editEmployeeModal');
            const form = document.getElementById('repair-form');

            modal.style.display = modal.style.display === 'none' ? 'block' : 'none';

            if (repair_id) {
                form.action = `/repair/update/${repair_id}`;
            }

            // Update form fields with product data
            document.getElementById('repair_detail').value = repair_detail;
            document.getElementById('employee_id').value = employee_id;
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Call searchRepairs when the page is loaded
            searchRepairs();
        });

        let currentPage = 1;
        const rowsPerPage = 10;

        function searchRepairs() {
            // Get the search inputs
            const employeeInput = document.getElementById('employee-search').value.toLowerCase();
            const customerInput = document.getElementById('customer-search').value.toLowerCase();
            const detailInput = document.getElementById('detail-search').value.toLowerCase();

            // Get all table rows in the body
            const rows = document.querySelectorAll('tbody tr');

            // Filter rows based on the search inputs
            let filteredRows = Array.from(rows).filter(row => {
                const employee = row.children[3].textContent.toLowerCase();
                const customer = row.children[1].textContent.toLowerCase();
                const detail = row.children[2].textContent.toLowerCase();

                const matchesEmployee = employee.includes(employeeInput);
                const matchesCustomer = customer.includes(customerInput);
                const matchesDetail = detail.includes(detailInput);

                return matchesEmployee && matchesCustomer && matchesDetail;
            });

            // Paginate the filtered rows
            paginate(filteredRows);
        }

        function paginate(rows) {
            // Calculate total pages
            const totalPages = Math.ceil(rows.length / rowsPerPage);
            document.getElementById('total-pages').textContent = totalPages;

            // Prevent out-of-bound pages
            if (currentPage > totalPages) currentPage = totalPages;
            if (currentPage < 1) currentPage = 1;

            // Slice rows for the current page
            const start = (currentPage - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            const rowsToShow = rows.slice(start, end);

            // Hide all rows
            document.querySelectorAll('tbody tr').forEach(row => row.style.display = 'none');

            // Show the rows for the current page
            rowsToShow.forEach(row => row.style.display = '');

            // Update current page display
            document.getElementById('current-page').textContent = currentPage;

            // Disable/enable pagination buttons based on the page
            document.querySelector('button[onclick="previousPage()"]').disabled = currentPage === 1;
            document.querySelector('button[onclick="nextPage()"]').disabled = currentPage === totalPages || totalPages ===
                0;
        }

        function previousPage() {
            if (currentPage > 1) {
                currentPage--;
                searchRepairs();
            }
        }

        function nextPage() {
            const totalPages = parseInt(document.getElementById('total-pages').textContent);
            if (currentPage < totalPages) {
                currentPage++;
                searchRepairs();
            }
        }

        function submitSearch() {
            currentPage = 1; // Reset to first page on a new search
            searchRepairs();
        }
    </script>


</body>

</html>
