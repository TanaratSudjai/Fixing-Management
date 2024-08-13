<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>product for admin</title>
</head>

<body>
    product for admin
    <div class="container">
        <h1>All Products</h1>

        @if ($products->isEmpty())
            <p>No products available.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Name</th>
                        <th>Details</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->product_id }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->product_detail }}</td>
                            <td>{{ $product->product_qty }}</td>
                            <td>${{ number_format($product->product_price) }}</td>
                            <td>
                           
                                <a href="{{ route('product.edit', $product->product_id) }}" class="btn btn-warning">Edit</a>

                      
                                <form action="{{ route('product.delete', $product->product_id) }}" method="POST"
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
</body>

</html>
