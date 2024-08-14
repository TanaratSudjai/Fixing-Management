<!DOCTYPE html>
<html>

<head>
    <title>Repairs List</title>
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
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        .btn {
            padding: 5px 10px;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
        }

        .btn-warning {
            background-color: #f0ad4e;
        }
    </style>
</head>

<body>
    @if (session('error'))
        <div class="alert alert-success">
            {{ session('error') }}
        </div>
    @endif
    @extends('layouts.admin')

    @section('content')
    <div class="px-6 bg-white border h-[100vh] flex justify-center w-full">
        <div class="container mx-auto">
            <div class="bg-white rounded p-4 px-4 md:p-8 mb-6 h-[80vh]">
            
                <h1 class="text-center text-2xl font-bold mb-4">
                    จัดการรายการแจ้งซ่อม
                </h1>
                
                <div class="md:container md:mx-auto">
                    <div class="relative overflow-x-auto ">
                        <table class="w-full text-sm text-left rtl:text-right text-black dark:text-gray-400">
                            <thead class="text-sm text-black uppercase bg-white text-center">
                                <tr>
                                    <th scope="col" class="px-2 py-3">
                                        Repair ID
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Customer
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Detail
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Employee
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($repairs as $repair)
                                    <tr>
                                        <td>{{ $repair->repair_id }}</td>
                                        <td>{{ $repair->customer->name }}</td>
                                        <td>{{ $repair->repair_detail }}</td>
                                        <td>{{ $repair->employee->name ?? 'Requires Employee' }}</td>
                                        <td>{{ $repair->status->status_name ?? 'N/A' }}</td>

                                        <td>
                                            <a href="{{ route('repair.selectemployee', $repair->repair_id) }}"
                                                class="btn btn-warning">SelectEmployee</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    @endsection

</body>

</html>
