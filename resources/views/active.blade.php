<!DOCTYPE html>
<html>

<head>
    <title>Welcome</title>
</head>

<body>
    <h1>Welcome to your active account</h1>
    <p>You have full access to the application.</p>
    <h1>
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </h1>
    <a href="{{ route('employee.add') }}" class="btn-yellow">Go Add Employee</a>
    <a href="{{ route('product.add') }}" class="btn-yellow">Go Add Product</a>
</body>

</html>
