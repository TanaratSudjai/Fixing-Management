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

<style>
    body {
        font-family: 'Kanit', sans-serif;
    }
</style>

<body>
    @extends('layouts.admin')

    @section('content')
        <div class="flex items-center justify-center min-h-screen px-4 py-12 sm:px-6 lg:px-8 mt-[-30px]">
            <div class="p-6 sm:p-8 bg-white shadow-xl w-full max-w-md">
                <h1 class="text-center text-2xl font-bold mb-3">เพิ่มพนักงาน</h1>
                <form id="employee-form" action="{{ route('admin.addEmployee') }}" method="POST" class="mt-6 space-y-4" >
                    @csrf
                    <div>
                        <label class="text-gray-800 text-sm mb-2 block">ชื่อผู้ใช้</label>
                        <div class="relative flex items-center">
                            <input type="text" name="name" placeholder="Username" required
                                class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3  outline-blue-600">
                        </div>
                    </div>
                    <div>
                        <label class="text-gray-800 text-sm mb-2 block">อีเมล</label>
                        <div class="relative flex items-center">
                            <input type="email" name="email" placeholder="Email" required
                                class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3  outline-blue-600">
                        </div>
                    </div>
                    <div>
                        <label class="text-gray-800 text-sm mb-2 block">รหัสผ่าน</label>
                        <div class="relative flex items-center">
                            <input type="password" name="password" placeholder="Password" required
                                class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3  outline-blue-600">
                        </div>

                    </div>
                    <div>
                        <label class="text-gray-800 text-sm mb-2 block">ยืนยันรหัสผ่าน</label>
                        <div class="relative flex items-center">
                            <input type="password" name="password_confirmation" placeholder="Confirm Password" required
                            class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3  outline-blue-600">
                        </div>
                    </div>
                    
                    <button id="submit-btn" type="submit" class="w-full py-3 px-4 text-sm tracking-wide  text-black bg-[#A3C9F0] hover:bg-[#D0E4F4] focus:outline-none">เพิ่มพนักงาน</button>
                </form>
            </div>
        </div>

        <script>
            document.getElementById('submit-btn').addEventListener('click', function (event) {
                event.preventDefault(); // Prevent the form from submitting immediately

                Swal.fire({
                    title: "จะเพิ่มพนักงานคนนี้ใช้ไหม?",
                    text: "แน่ใจใช่ไหม?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "ใช่, แน่นอน!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('employee-form').submit(); // Submit the form if confirmed
                    }
                });
            });
        </script>
    @endsection
</body>

</html>
