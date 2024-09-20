<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>


<body class="bg-[#EEEEEE] font-kanit">
    @extends('layouts.admin')

    @section('content')
        <div class="flex items-center justify-center h-[92vh] px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl w-full max-w-md rounded-md p-6 sm:p-8">
                <h1 class="text-center text-2xl font-bold mb-3 text-[#373A40]">แก้ไขพนักงาน</h1>

                <form action="{{ route('employee.update', $employee->id) }}" method="POST" id="editEmployee-form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div>
                        <div class="form-group mb-4">
                            <label for="name" class="text-[#373A40] text-sm mb-2 block">ชื่อ</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $employee->name) }}"
                                required
                                class="w-full text-[#373A40] text-sm border border-gray-300 px-4 py-3 rounded-md outline-none focus:ring-2 focus:ring-[#DC5F00]">
                        </div>

                        <div>
                            <label for="image" class="text-[#373A40] text-sm mb-2 block">โปรไฟล์พนักงาน</label>
                            <input type="file" name="image" id="image" accept="image/*"
                                class="w-full text-sm text-[#373A40] file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:bg-[#F3F4F6] hover:file:bg-[#F1F3F5]">
                            @error('image')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="button" id="submit-btn"
                            class="mt-4 w-full bg-[#DC5F00] hover:bg-[#C84D00] text-white text-center font-bold py-3 rounded-md transition duration-300 ease-in-out">
                            บันทึก
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            document.getElementById('submit-btn').addEventListener('click', function(event) {
                event.preventDefault();

                Swal.fire({
                    title: "คุณแน่ใจว่าจะบันทึกการเปลี่ยนแปลงนี้หรือไม่?",
                    text: "แน่ใจใช่ไหม?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DC5F00",
                    cancelButtonColor: "#373A40",
                    confirmButtonText: "ใช่, ฉันแน่ใจ!",
                    cancelButtonText: "ยกเลิก"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('editEmployee-form').submit(); // Submit the form if confirmed
                    }
                });
            });
        </script>
    @endsection
</body>

</html>
