<!DOCTYPE html>
<html lang="en">

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
        <div class="flex bg-[#EEEEEE] items-center justify-center h-[92vh] px-4 py-12 sm:px-6 lg:px-8">
            <div class="p-6 sm:p-8 bg-white shadow-xl w-full max-w-md rounded-lg">
                <h1 class="text-center text-2xl font-bold mb-6">เพิ่มพนักงาน</h1>
                <form id="employee-form" action="{{ route('admin.addEmployee') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="name" class="text-gray-800 text-sm mb-2 block">ชื่อผู้ใช้</label>
                        <input type="text" name="name" id="name" placeholder="Username" required
                            class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                    </div>
                    <div>
                        <label for="email" class="text-gray-800 text-sm mb-2 block">อีเมล</label>
                        <input type="email" name="email" id="email" placeholder="Email" required
                            class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                    </div>
                    <div>
                        <label for="password" class="text-gray-800 text-sm mb-2 block">รหัสผ่าน</label>
                        <input type="password" name="password" id="password" placeholder="Password" required
                            class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                    </div>
                    <div>
                        <label for="password_confirmation" class="text-gray-800 text-sm mb-2 block">ยืนยันรหัสผ่าน</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            placeholder="Confirm Password" required
                            class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                    </div>

                    <button id="submit-btn" type="submit"
                        class="w-full py-3 px-4 text-sm font-semibold text-white bg-[#DC5F00] hover:bg-[#D0E4F4] focus:outline-none rounded-md transition duration-300">
                        เพิ่มพนักงาน
                    </button>
                </form>
            </div>
        </div>

        <script>
            document.getElementById('submit-btn').addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the form from submitting immediately

                Swal.fire({
                    title: "จะเพิ่มพนักงานคนนี้ใช้ไหม?",
                    text: "แน่ใจใช่ไหม?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DC5F00",
                    cancelButtonColor: "#373A40",
                    confirmButtonText: "ใช่, ฉันแน่ใจ!",
                    cancelButtonText: "ยกเลิก"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('employee-form').submit();
                    }
                });
            });
        </script>
    @endsection
</body>

</html>
