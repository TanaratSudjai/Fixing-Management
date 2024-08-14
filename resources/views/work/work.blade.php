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
                    <th>Customer Name</th>
                    <th>Repair Detail</th>
                    <th>Status ID</th>
                    <th>Product</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($workrepair as $repair)
                    <tr>
                        <td>{{ $repair->repair_id }}</td>
                        <td>{{ $repair->customer->name }}</td>
                        <td>{{ $repair->repair_detail }}</td>
                        <td>{{ $repair->status->status_name }}</td>
                        <td>{{ $repair->product->product_name ?? 'ยังไม่เบิกสินค้า'  }}</td>
                        <td>{{ $repair->created_at }}</td>
                        <td>{{ $repair->updated_at }}</td>
                        <td>
                            <a href="{{ route('repair.selectproduct', $repair->repair_id) }}" class="btn btn-warning">เบิกอะไหล่</a>
                            <a href="{{ route('repair.updateStatus', $repair->repair_id) }}" class="btn btn-warning">เเจ้งลูกค้า</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>

</html>
