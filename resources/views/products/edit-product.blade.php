<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>form edit</title>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    @extends('layouts.admin')

    @section('content')
        <div class="flex items-center justify-center min-h-screen px-4 py-12 sm:px-6 lg:px-8 mt-[-100px]">
            <div class="p-6 sm:p-8 rounded-2xl bg-white shadow-xl w-full max-w-md">
                <h1 class="text-center text-2xl font-bold mb-3">Edit Product</h1>
                <form action="{{ route('product.update', $product->product_id) }}" method="POST" id="editProduct-form">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <div>
                            <label for="product_name" class="text-gray-800 text-sm mb-2 block">Product Name</label>
                            <div>
                                <input type="text" name="product_name" id="product_name"
                                    value="{{ old('product_name', $product->product_name) }}" required
                                    class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md outline-blue-600">
                                @error('product_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="product_detail" class="text-gray-800 text-sm mb-2 block">Product Detail</label>
                            <textarea name="product_detail" id="product_detail" required
                                class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md outline-blue-600">{{ old('product_detail', $product->product_detail) }}</textarea>
                            @error('product_detail')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="product_qty" class="text-gray-800 text-sm mb-2 block">Product Quantity</label>
                            <input type="number" name="product_qty" id="product_qty"
                                class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md outline-blue-600"
                                value="{{ old('product_qty', $product->product_qty) }}" required min="0">
                            @error('product_qty')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="product_price" class="text-gray-800 text-sm mb-2 block">Product Price</label>
                            <input type="number" name="product_price" id="product_price"
                                class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md outline-blue-600"
                                value="{{ old('product_price', $product->product_price) }}" required min="0"
                                step="0.01">
                            @error('product_price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="button" id="submit-btn" class="mt-4 w-full bg-[#17a2b8] hover:bg-[#107584] text-white py-3 rounded-md transition duration-300 ease-in-out">
                            บันทึก
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            document.getElementById('submit-btn').addEventListener('click', function (event) {
                event.preventDefault(); // Prevent the form from submitting immediately

                Swal.fire({
                    title: "เลือกพนักงานคนนี้ใช้ไหม?",
                    text: "แน่ใจใช่ไหม?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "ใช่, แน่นอน!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('editProduct-form').submit(); // Submit the form if confirmed
                    }
                });
            });
        </script>
    @endsection
</body>

</html>
