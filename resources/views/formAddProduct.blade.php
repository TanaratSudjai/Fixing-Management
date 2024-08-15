<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @extends('layouts.admin')


    @section('content')
    <div class="container">
        <h1>Add New Product</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.addProduct') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" name="product_name" id="product_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="product_detail">Product Detail</label>
                <textarea name="product_detail" id="product_detail" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="product_qty">Quantity</label>
                <input type="number" name="product_qty" id="product_qty" class="form-control" required min="0">
            </div>

            <div class="form-group">
                <label for="product_price">Price</label>
                <input type="number" name="product_price" id="product_price" class="form-control" required
                    min="0" step="0.01">
            </div>

            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
    </div>
    @endsection
</body>

</html>
