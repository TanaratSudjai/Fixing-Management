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
                        <div class="relative overflow-x-auto">
                            <form method="GET" action="{{ route('pdf.customer') }}">
                                <button type="submit" name="download" value="1">Download PDF</button>
                            </form>

                            {{-- {{ $customet_report->links() }} --}}
                            <table class="min-w-full divide-y divide-gray-200 text-sm text-center">
                                <thead class="bg-gray-200 sticky top-0">
                                    <tr>
                                        <th class="p-2 px-2 border-b border-gray-300    ">รหัสพนักงาน</th>
                                        <th class="p-2 px-2 border-b border-gray-300    ">ชื่อ</th>
                                        <th class="p-2 px-2 border-b border-gray-300    ">อีเมล</th>
                                        <th class="p-2 px-2 border-b border-gray-300    ">สถานะ</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($employees as $employee)
                                        <tr class="even:bg-gray-50">
                                            <td class="p-2 border-b border-gray-300">{{ $employee->id }}</td>
                                            <td class="p-2 border-b border-gray-300">{{ $employee->name }}</td>
                                            <td class="p-2 border-b border-gray-300">{{ $employee->email }}</td>
                                            <td class="p-2 border-b border-gray-300">
                                                <div class="flex justify-center gap-3">
                                                    <a href="{{ route('employee.edit', $employee->id) }}"
                                                        class="text-[#EEEEEE] px-3 py-1 bg-[#373A40]  hover:bg-[#373A40]">แก้ไข</a>

                                                    <form id="del_form_{{ $employee->id }}"
                                                        action="{{ route('employee.delete', $employee->id) }}"
                                                        method="POST" style="display:inline;">
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
                button.addEventListener('click', function(event) {
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
</body>

</html>
