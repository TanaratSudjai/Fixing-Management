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

        .alert-success {
            color: green;
            background-color: #d4edda;
            border-color: #c3e6cb;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    @if (session('error'))
        <div class="alert alert-success">
            {{ session('error') }}
        </div>
    @endif

    <h1>Repairs List</h1>
    <table>
        <thead>
            <tr>
                <th>Repair ID</th>
                <th>Customer</th>
                <th>Detail</th>
                <th>Employee</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($repairs as $repair)
                <tr>
                    <td>{{ $repair->repair_id }}</td>
                    <td>{{ $repair->customer->name }}</td>
                    <td>{{ $repair->repair_detail }}</td>
                    <td>{{ $repair->employee->name ?? 'Requires Employee' }}</td>
                    <td>{{ $repair->status->status_name ?? 'N/A' }}</td>

                    <td>
                        @if ($repair->status_id == 3)
                            <a href="" class="btn btn-success">DONE</a>
                        @elseif($repair->status_id == 2)
                            <a href="" class="btn btn-info">INPROGRESS</a>
                        @else
                            <a href="{{ route('repair.selectemployee', $repair->repair_id) }}"
                                class="btn btn-warning">PLANING</a>
                        @endif
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
