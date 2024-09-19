<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Edit</title>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-[#EEEEEE] font-kanit">
    @extends('layouts.admin')

    @section('content')
        <div class="flex items-center justify-center h-[92vh] px-4 py-12 sm:px-6 lg:px-8 mt-[-30px]">
            <div class="p-6 sm:p-8 bg-white shadow-lg w-full max-w-md rounded-md border border-gray-300">
                <h1 class="text-center text-2xl font-bold mb-4 text-[#373A40]">แก้ไขสินค้า</h1>
                <form action="{{ route('product.update', $product->product_id) }}" method="POST" id="editProduct-form"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <div>
                            <label for="product_name" class="text-[#373A40] text-sm mb-2 block">ชื่อสินค้า</label>
                            <input type="text" name="product_name" id="product_name"
                                value="{{ old('product_name', $product->product_name) }}" required
                                class="w-full text-[#373A40] text-sm border border-gray-300 px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-[#DC5F00]">
                            @error('product_name')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="product_detail" class="text-[#373A40] text-sm mb-2 block">รายละเอียดสินค้า</label>
                            <textarea name="product_detail" id="product_detail" required
                                class="w-full text-[#373A40] text-sm border border-gray-300 px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-[#DC5F00]">{{ old('product_detail', $product->product_detail) }}</textarea>
                            @error('product_detail')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="product_qty" class="text-[#373A40] text-sm mb-2 block">จำนวนสินค้า</label>
                            <input type="number" name="product_qty" id="product_qty"
                                class="w-full text-[#373A40] text-sm border border-gray-300 px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-[#DC5F00]"
                                value="{{ old('product_qty', $product->product_qty) }}" required min="0">
                            @error('product_qty')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="product_price" class="text-[#373A40] text-sm mb-2 block">ราคาสินค้า</label>
                            <input type="number" name="product_price" id="product_price"
                                class="w-full text-[#373A40] text-sm border border-gray-300 px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-[#DC5F00]"
                                value="{{ old('product_price', $product->product_price) }}" required min="0"
                                step="0.01">
                            @error('product_price')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="image_product">Product Image</label>
                            <input type="file" name="image_product" id="image_product" accept="image/*">
                            @error('image_product')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="button" id="submit-btn"
                            class="mt-4 w-full bg-[#DC5F00] text-white py-3 rounded-md hover:bg-[#C44D00] focus:outline-none focus:ring-2 focus:ring-[#373A40] transition duration-300 ease-in-out">
                            บันทึก
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            document.getElementById('submit-btn').addEventListener('click', function(event) {
                event.preventDefault();

                Swal.fire({
                    title: "เลือกพนักงานคนนี้ใช้ไหม?",
                    text: "แน่ใจใช่ไหม?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DC5F00",
                    cancelButtonColor: "#373A40",
                    confirmButtonText: "ใช่, ฉันแน่ใจ!",
                    cancelButtonText: "ยกเลิก"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('editProduct-form').submit();
                    }
                });
            });
        </script>
    @endsection
</body>

</html>
