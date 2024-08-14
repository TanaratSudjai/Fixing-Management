<!DOCTYPE html>
<html>

<head>
    <title>Repairs List</title>
</head>

<body>
    <h1>Repairs List</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Repair ID</th>
                <th>Customer</th>
                <th>Detail</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($repairs as $repair)
                <tr>
                    <td>{{ $repair->repair_id }}</td>
                    <td>{{ $repair->customer->name ?? 'N/A' }}</td>
                    <td>{{ $repair->repair_detail }}</td>
                    <td>{{ $repair->status->status_name ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
