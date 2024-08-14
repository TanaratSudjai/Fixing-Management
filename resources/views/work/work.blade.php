<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work Repair List</title>
    <!-- Include any CSS files here -->
</head>

<body>
    <h1>Work Repair List</h1>

    @if ($workrepair->isEmpty())
        <p>No repairs found.</p>
    @else
        <table border="1">
            <thead>
                <tr>
                    <th>Repair ID</th>
                    <th>Customer ID</th>
                    <th>Repair Detail</th>
                    <th>Employee ID</th>
                    <th>Product ID</th>
                    <th>Status ID</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($workrepair as $repair)
                    <tr>
                        <td>{{ $repair->repair_id }}</td>
                        <td>{{ $repair->customer_id }}</td>
                        <td>{{ $repair->repair_detail }}</td>
                        <td>{{ $repair->employee_id }}</td>
                        <td>{{ $repair->product_id }}</td>
                        <td>{{ $repair->status_id }}</td>
                        <td>{{ $repair->created_at }}</td>
                        <td>{{ $repair->updated_at }}</td>
                        <td>
                            เบิกอะไหล่
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>

</html>
