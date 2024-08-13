<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>form edit</title>
</head>

<body>
    <div class="container">
        <h1>Edit Product</h1>

        <form action="{{ route('product.update', $product->product_id) }}" method="POST">
            @csrf
            @method('PUT') 

            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" name="product_name" id="product_name" class="form-control"
                    value="{{ old('product_name', $product->product_name) }}" required>
                @error('product_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="product_detail">Product Detail</label>
                <textarea name="product_detail" id="product_detail" class="form-control" required>{{ old('product_detail', $product->product_detail) }}</textarea>
                @error('product_detail')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="product_qty">Product Quantity</label>
                <input type="number" name="product_qty" id="product_qty" class="form-control"
                    value="{{ old('product_qty', $product->product_qty) }}" required min="0">
                @error('product_qty')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="product_price">Product Price</label>
                <input type="number" name="product_price" id="product_price" class="form-control"
                    value="{{ old('product_price', $product->product_price) }}" required min="0" step="0.01">
                @error('product_price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
    </div>
</body>

</html>
