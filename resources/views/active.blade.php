<!DOCTYPE html>
<html>

<head>
    <title>Welcome</title>
</head>

<body>
    @extends('layouts.app')

    @section('content')
        <div class="container-sm">
            <h1>Welcome to your active account</h1>
            <p>You have full access to the application.</p>

            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <a href="{{ route('customer.repir') }}" class="btn-yellow">List req repair!</a>
            <a href="{{ route('employee.add') }}" class="btn-yellow">Go Add Employee</a>
            <a href="{{ route('product.add') }}" class="btn-yellow">Go Add Product</a>
            <a href="{{ route('products.view') }}" class="btn-yellow">Go view Product</a>
            <a href="{{ route('employee.list') }}" class="btn-yellow">Go view Employee</a>
        </div>
    @endsection
</body>

</html>
