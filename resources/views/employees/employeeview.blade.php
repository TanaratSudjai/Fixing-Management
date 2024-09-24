<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee List</title>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-[#EEEEEE] font-kanit">
    @extends('layouts.admin')

    @section('content')
    <div class="p-6  bg-[#EEEEEE] border flex justify-center w-full">
        <div class="container mx-auto">
            <div class="bg-white p-4 px-4 md:p-8 mb-6 h-[80vh] overflow-y-auto rounded-md shadow-md">
                <h1 class="text-center text-2xl font-bold mb-3 text-[#373A40]">รายชื่อพนักงาน</h1>
                @if ($employees->isEmpty())
                    <p class="text-center text-xl font-semibold text-[#373A40] mb-3">ไม่พบพนักงาน</p>
                @else
                    <div class="overflow-x-auto">
                        <form method="GET" action="{{ route('pdf.customer') }}">
                            <button type="submit" name="download" value="1">Download PDF</button>
                        </form>

                        <table class="min-w-full divide-y divide-gray-200 text-sm text-center">
                            <thead class="bg-gray-200 top-0">
                                <tr>
                                    <th class="p-2 px-2 border-b border-gray-300    ">รหัสพนักงาน</th>
                                    <th class="p-2 px-2 border-b border-gray-300    ">โปรไฟล์</th>
                                    <th class="p-2 px-2 border-b border-gray-300    ">ชื่อ</th>
                                    <th class="p-2 px-2 border-b border-gray-300    ">อีเมล</th>
                                    <th class="p-2 px-2 border-b border-gray-300    ">สถานะ</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($employees as $employee)
                                    <tr class="even:bg-gray-50">
                                        <td class="p-2 border-b border-gray-300">{{ $employee->id }}</td>
                                        <td class="p-2 border-b border-gray-300 flex justify-center">
                                            @if ($employee->image)
                                                <img src="{{ asset('/' . $employee->image) }}" alt="Profile Image"
                                                    class="w-16 h-16 object-cover rounded-full">
                                            @else
                                                <img src="{{ asset('images/profile.png') }}" alt="Profile Image"
                                                    class="w-16 h-16 object-cover rounded-full">
                                            @endif
                                        </td>
                                        <td class="p-2 border-b border-gray-300">{{ $employee->name }}</td>
                                        <td class="p-2 border-b border-gray-300">{{ $employee->email }}</td>
                                        <td class="p-2 border-b border-gray-300">
                                            <div class="flex justify-center gap-3">

                                                <a onclick="toggleEditEmployeeModal({{ $employee->id }},'{{ $employee->name }}',)"
                                                    class="text-[#EEEEEE] px-3 py-1 bg-[#373A40] hover:bg-[#373A40]">แก้ไข</a>

                                                <form id="del_form_{{ $employee->id }}"
                                                    action="{{ route('employee.delete', $employee->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button id="del_btn_{{ $employee->id }}" type="submit"
                                                        class="text-[#EEEEEE] px-3 py-1 bg-[#DC5F00]  hover:bg-[#DC5F00]">ลบ</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('button[id^="del_btn_"]').forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();

                const employeeId = this.id.split('_')[2];
                const form = document.getElementById(`del_form_${employeeId}`);

                Swal.fire({
                    title: "คุณแน่ใจว่าจะลบพนักงานคนนี้?",
                    text: "แน่ใจใช่ไหม?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DC5F00",
                    cancelButtonColor: "#373A40",
                    confirmButtonText: "ใช่, ฉันแน่ใจ!",
                    cancelButtonText: "ยกเลิก"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Submit the form if confirmed
                    }
                });
            });
        });
    </script>
    @endsection

    <div id="editEmployeeModal" class="fixed hidden w-full bg-opacity-50 backdrop-blur-sm">
        <div class=" w-full h-[95vh]  flex justify-center items-center">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md space-y-4">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">แก้ไขพนักงาน</h2>
                    <button onclick="toggleEditEmployeeModal()" class="text-gray-400 hover:text-gray-600">
                        &times;
                    </button>
                </div>
                @if(isset($employee))
                    <form action="{{ route('employee.update', $employee->id) }}" method="POST" id="editEmployee-form"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div>
                            <div class="form-group mb-4">
                                <label for="name" class="text-[#373A40] text-sm mb-2 block">ชื่อ</label>
                                <input type="text" id="name" name="name" value="{{ old('name', $employee->name) }}" required
                                    class="w-full text-[#373A40] text-sm border border-gray-300 px-4 py-3 rounded-md outline-none focus:ring-2 focus:ring-[#DC5F00]">
                            </div>

                            <div class="mb-4">
                                <label for="profile_image"
                                    class="text-gray-800 text-sm font-medium mb-2 block">โปรไฟล์พนักงาน</label>
                                <div class="flex items-center justify-center w-full">
                                    <label
                                        class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 16l-4-4m0 0l4-4m-4 4h18m-8 4l4-4m0 0l-4-4m4 4H3"></path>
                                            </svg>
                                            <p class="mb-2 text-sm text-gray-500"><span
                                                    class="font-semibold">คลิกเพื่ออัปโหลด</span>
                                                หรือ ลากไฟล์มาที่นี่</p>
                                            <p class="text-xs text-gray-500">PNG, JPG หรือ GIF (ขนาดไม่เกิน 2MB)</p>
                                        </div>
                                        <input type="file" name="image" id="image" class="hidden" accept="image/*"/>
                                    </label>
                                </div>
                            </div>

                            <button type="submit" id="submit-btn"
                                class="mt-4 w-full bg-[#DC5F00] hover:bg-[#C84D00] text-white text-center font-bold py-3 rounded-md transition duration-300 ease-in-out">
                                บันทึก
                            </button>
                        </div>
                    </form>
                @else
                    <!-- If $repair data is not available -->
                    <div class="text-center text-gray-500">
                        ไม่มีข้อมูลที่จะแสดง
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function toggleEditEmployeeModal(id, name) {
            const modal = document.getElementById('editEmployeeModal');
            const form = document.getElementById('editEmployee-form');

            modal.style.display = modal.style.display === 'none' ? 'block' : 'none';

            if (id) {
                form.action = `/employee/update/${id}`;
            }

            document.getElementById('name').value = name;
        }
    </script>
</body>

</html>