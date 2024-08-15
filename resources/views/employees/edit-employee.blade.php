<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    @extends('layouts.admin')

    @section('content')
        <div class="flex items-center justify-center min-h-screen px-4 py-12 sm:px-6 lg:px-8 mt-[-100px]">
            <div class="p-6 sm:p-8 rounded-2xl bg-white shadow-xl w-full max-w-md">

                <h1 class="text-center text-2xl font-bold mb-3">Edit Employee</h1>

                <form action="{{ route('employee.update', $employee->id) }}" method="POST" id="editEmployee-form">
                    @csrf
                    @method('PUT')
                    <div class="">
                        <div class="form-group">
                            <label for="name" class="text-gray-800 text-sm mb-2 block">Name</label>
                            <input type="text" id="name" name="name" 
                                value="{{ old('name', $employee->name) }}" required
                                class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md outline-blue-600">
                        </div>

                        <!-- Status field is removed -->

                        <button type="button" id="submit-btn" class="mt-4 w-full bg-[#17a2b8] hover:bg-[#107584] text-white py-3 rounded-md transition duration-300 ease-in-out">
                            บันทึก
                        </button>
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
                        document.getElementById('editEmployee-form').submit(); // Submit the form if confirmed
                    }
                });
            });
        </script>
    @endsection
</body>

</html>
