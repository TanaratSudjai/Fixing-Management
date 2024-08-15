<body>
    @extends('layouts.admin')
    
    @section('content')
    <div class="container">

            <h1>Employees List</h1>

            @if ($employees->isEmpty())
                <p>No employees found.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Employee ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr>
                                <td>{{ $employee->id }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>
                                    <a href="{{ route('employee.edit', $employee->id) }}" class="btn btn-warning">Edit</a>

                                    <form action="{{ route('employee.delete', $employee->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    @endsection
</body>
