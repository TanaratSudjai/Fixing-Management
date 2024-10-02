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
                <form id="employee-form" action="{{ route('admin.addEmployee') }}" method="POST"
                    enctype="multipart/form-data" class="space-y-4">
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
                    <div class="mb-4">
                        <label for="profile_image"
                            class="text-gray-800 text-sm font-medium mb-2 block">โปรไฟล์พนักงาน</label>
                        <div class="flex items-center justify-center w-full">
                            <label
                                class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16l-4-4m0 0l4-4m-4 4h18m-8 4l4-4m0 0l-4-4m4 4H3"></path>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500"><span
                                            class="font-semibold">คลิกเพื่ออัปโหลด</span> หรือ ลากไฟล์มาที่นี่</p>
                                    <p class="text-xs text-gray-500">PNG, JPG หรือ GIF (ขนาดไม่เกิน 2MB)</p>
                                </div>
                                <input type="file" name="image" id="image" class="hidden" />
                            </label>
                        </div>
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
                event.preventDefault();

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
