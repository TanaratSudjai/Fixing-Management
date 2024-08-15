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
                    <td>

                        @if ($repair->status_id == 1)
                            <a href="{{ route('repairs.edit', $repair->repair_id) }}">แก้ไข</a>
                        @elseif ($repair->status_id == 2)
                            <a href="#">รายการนี้กำลังดำเนินการ</a>
                        @else
                            <a href="#">รายการนี้ซ่อมเรียบร้อยเเล้ว</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
