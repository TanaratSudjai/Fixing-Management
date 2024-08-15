<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @extends('layouts.admin')
    @section('content')
        <div class="flex items-center justify-center min-h-screen px-4 py-12 sm:px-6 lg:px-8 mt-[-100px]">
            <div class="p-6 sm:p-8 rounded-2xl bg-white shadow-xl w-full max-w-md">
                <h1 class="text-center text-2xl font-bold mb-3">เพิ่มสินค้า</h1>

                <form action="{{ route('admin.addProduct') }}" method="POST" class="mt-6 space-y-4" id="product-form">
                    @csrf
                    <div>
                        <label for="product_name" class="text-gray-800 text-sm mb-2 block">Product Name</label>
                        <div class="relative flex items-center">
                            <input placeholder="Product Name" type="text" name="product_name" id="product_name" required class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md outline-blue-600">
                        </div>
                    </div>

                    <div>
                        <label for="product_detail" class="text-gray-800 text-sm mb-2 block">Product Detail</label>
                        <div>
                            <textarea placeholder="Product detail" name="product_detail" id="product_detail" required
                                class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md outline-blue-600"></textarea>
                        </div>
                    </div>

                    <div>
                        <label for="product_qty" class="text-gray-800 text-sm mb-2 block">Quantity</label>
                        <div>
                            <input placeholder="Product quantity" type="number" name="product_qty" id="product_qty" required
                                min="0" class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md outline-blue-600">
                        </div>
                    </div>

                    <div>
                        <label for="product_price" class="text-gray-800 text-sm mb-2 block">Price</label>
                        <input placeholder="Product Price" type="number" name="product_price" id="product_price" required
                            min="0" step="0.01" class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md outline-blue-600">
                    </div>

                    <button id="submit-btn" type="submit" class="w-full py-3 px-4 text-sm tracking-wide rounded-lg text-white bg-blue-400 hover:bg-blue-500 focus:outline-none">Add Product</button>
                </form>
            </div>
        </div>

        <script>
            document.getElementById('submit-btn').addEventListener('click', function (event) {
                event.preventDefault(); // Prevent the form from submitting immediately

                Swal.fire({
                    title: "จะเพิ่มสินค้าชิ้นนี้ใช่ไหม?",
                    text: "แน่ใจใช่ไหม?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "ใช่, แน่นอน!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('product-form').submit(); // Submit the form if confirmed
                    }
                });
            });
        </script>
    @endsection
</body>

</html>
