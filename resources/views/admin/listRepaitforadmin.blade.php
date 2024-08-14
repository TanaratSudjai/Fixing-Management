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
                        <a href="{{ route('repair.selectemployee', $repair->repair_id) }}" class="btn btn-warning">SelectEmployee</a>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
    
    @endsection
</body>

</html>
