<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>employee list</title>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;

        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ddd;

        }

        th {
            background-color: #f4f4f4;
        }

        .btn {
            padding: 5px 10px;
            text-decoration: none;
            color: white;
            border-radius: 4px;
        }

        .btn-success {
            background-color: #28a745;
        }

        .btn-info {
            background-color: #17a2b8;
        }

        .btn-warning {
            background-color: #ff0707;
            color: rgb(253, 253, 253);
            /* เปลี่ยนสีตัวอักษรเป็นสีดำ */
        }
    </style>
</head>

<body>
    @extends('layouts.admin')

    @section('content')
        <div class="p-6 bg-white border h-[100vh] flex justify-center w-full">
            <div class="container mx-auto">
                <div class="bg-white rounded p-4 px-4 md:p-8 mb-6 h-[80vh]">

                    <h1 class="text-center text-2xl font-bold mb-3">Employees List</h1>

                    @if ($employees->isEmpty())
                        <p class="text-center text-2xl font-bold mb-3">No employees found.</p>
                    @else
                        <div className="md:container md:mx-auto">
                            <div className="relative overflow-x-auto shadow-md sm:rounded-lg">
                                <table class="w-full text-sm text-center rtl:text-center text-black">
                                    <thead class="text-sm text-black uppercase bg-white text-center">
                                        <tr>
                                            <th class="text-center p-2 px-2 gap-2 w-1/12">Employee ID</th>
                                            <th class="text-center p-2 px-2 gap-2 w-1/12">Name</th>
                                            <th class="text-center p-2 px-2 gap-2 w-1/12">Email</th>
                                            <th class="text-center p-2 px-2 gap-2 w-1/12">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach ($employees as $employee)
                                            <tr class="even:bg-gray-50">
                                                <td>{{ $employee->id }}</td>
                                                <td>{{ $employee->name }}</td>
                                                <td>{{ $employee->email }}</td>
                                                <td class="flex justify-center gap-3">
                                                    <div>
                                                        <a href="{{ route('employee.edit', $employee->id) }}"
                                                            class="btn bg-yellow-500 py-2">Edit</a>

                                                        <form id="del_form" action="{{ route('employee.delete', $employee->id) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button id="del_btn" type="submit"
                                                                class="btn btn-warning">Delete</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <script>
            document.getElementById('del_btn').addEventListener('click', function (event) {
                event.preventDefault(); // Prevent the form from submitting immediately

                Swal.fire({
                    title: "คุณแน่ใจว่าจะลบสินค้านี้หรือไม่?",
                    text: "แน่ใจใช่ไหม?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "ใช่, ฉันแน่ใจ!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('del_form').submit(); // Submit the form if confirmed
                    }
                });
            });
        </script>


    @endsection
</body>
