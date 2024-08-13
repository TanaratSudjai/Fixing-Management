<!DOCTYPE html>
<html>

<head>
    <title>Edit Repair</title>
</head>

<body>
    <h1>Edit Repair</h1>
    <form action="{{ route('repair.update', $repair->repair_id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="repair_detail">Repair Detail:</label>
        <input type="text" name="repair_detail" id="repair_detail"
            value="{{ old('repair_detail', $repair->repair_detail) }}" required>

        <label for="employee_id">Assign Employee:</label>
        <select name="employee_id" id="employee_id">
            <option value="">Select Employee</option>
            @foreach ($employees as $employee)
                <option value="{{ $employee->id }}" {{ $repair->employee_id == $employee->id ? 'selected' : '' }}>
                    {{ $employee->name }}
                </option>
            @endforeach
        </select>

        <button type="submit">Update Repair</button>
    </form>

    <a href="{{ route('customer.repir') }}">Back to Repair List</a>
</body>

</html>
