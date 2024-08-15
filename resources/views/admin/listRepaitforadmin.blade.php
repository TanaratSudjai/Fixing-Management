<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
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

                    <h1 class="text-center text-2xl font-bold mb-3">รายการแจ้งซ่อม</h1>
                    <div className="md:container md:mx-auto">
                        <div className="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-center rtl:text-center text-black ">
                                <thead class="text-sm text-black uppercase bg-white text-center">
                                    <tr>
                                        <th class="text-center p-2 px-2 gap-2 w-1/12">รหัสแจ่งซ่อม</th>
                                        <th class="text-center p-2 px-2 gap-2 w-1/12">ชื่อลูกค้า</th>
                                        <th class="text-center p-2 px-2 gap-2 w-1/12">รายละเอียด</th>
                                        <th class="text-center p-2 px-2 gap-2 w-1/12">พนักงาน</th>
                                        <th class="text-center p-2 px-2 gap-2 w-1/12">สถานะ</th>
                                        <th class="text-center p-2 px-2 gap-2 w-1/12">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($repairs as $repair)
                                        <tr class="even:bg-gray-50">
                                            <td>{{ $repair->repair_id }}</td>
                                            <td>{{ $repair->customer->name }}</td>
                                            <td>{{ $repair->repair_detail }}</td>
                                            <td>{{ $repair->employee->name ?? 'กรุณาเลือกพนักงาน' }}</td>
                                            <td>{{ $repair->status->status_name ?? 'N/A' }}</td>
                                            <td>
                                                @if ($repair->status_id == 3)
                                                    <a href="" class="btn btn-success">เรียบร้อย</a>
                                                @elseif($repair->status_id == 2)
                                                    <a href="" class="btn btn-info">อยู่ระหว่างการซ่อม</a>
                                                @else
                                                    <a href="{{ route('repair.selectemployee', $repair->repair_id) }}"
                                                        class="btn btn-warning">เลือกพนักงาน</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endsection
            </div>
        </div>
    </div>
</body>

</html>
