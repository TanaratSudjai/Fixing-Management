<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>Repairs List</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Kanit', sans-serif;
            margin: 20px;
        }
    
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
    
        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: center;
        }
    
        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }
    
        .btn {
            padding: 8px 15px;
            text-decoration: none;
            color: white;
            display: inline-block;
        }
    
        .btn-success {
            background-color: #28a745;
        }
    
        .btn-warning {
            background-color: #ff0000; /* Red background */
            color: #ffffff; /* White text */
        }
    
        .btn-warning:hover {
            background-color: #cc0000; /* Darker red on hover */
        }
    
        .btn-edit {
            background-color: #f0ad4e; /* Yellow button */
            color: #fff;
        }
    
        .btn-edit:hover {
            background-color: #ec971f;
        }
    
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
    
        @media (max-width: 768px) {
            table {
                font-size: 12px;
            }
    
            .btn {
                padding: 6px 10px;
                font-size: 12px;
            }
        }
    </style>
</head>

<body>
    @extends('layouts.admin')

    @section('content')
        <div class="p-6 bg-white border h-[100vh] flex justify-center w-full">
            <div class="container mx-auto">
                <div class="bg-white  p-4 px-4 md:p-8 mb-6 h-[80vh]">

                    <h1 class="text-center text-2xl font-bold mb-3">รายการแจ้งซ่อม</h1>
                    <div class="relative overflow-x-auto ">
                    <table class="text-sm text-center rtl:text-center text-black">
                        <thead class="text-sm text-black uppercase bg-white text-center">
                                    <tr>
                                        <th class="text-center p-2 px-2 gap-2 w-1/12">รหัสแจ้งซ่อม</th>
                                        <th class="text-center p-2 px-2 gap-2 w-1/12">ชื่อลูกค้า</th>
                                        <th class="text-center p-2 px-2 gap-2 w-1/12">รายละเอียด</th>
                                        <th class="text-center p-2 px-2 gap-2 w-1/12">พนักงาน</th>
                                        <th class="text-center p-2 px-2 gap-2 w-1/12">สถานะ</th>
                                        <th class="text-center p-2 px-2 gap-2 w-1/12">ดำเนินการ</th>
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
                                                    <a href="" class="btn btn-info bg-[#17a2b8]">อยู่ระหว่างการซ่อม</a>
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
                    
                @endsection
            </div>
        </div>
    </div>
</body>

</html>
