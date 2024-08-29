<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>เพิ่มสินค้า</title>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
</head>
<body class="bg-[#EEEEEE] font-kanit">
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-md mx-4 my-2">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @extends('layouts.admin')
    @section('content')
        <div class="flex items-center justify-center h-[92vh] px-4 py-12 sm:px-6 lg:px-8">
            <div class="p-6 sm:p-8 bg-white shadow-xl w-full max-w-md rounded-lg">
                <h1 class="text-center text-2xl font-bold mb-6">เพิ่มสินค้า</h1>

                <form action="{{ route('admin.addProduct') }}" method="POST" class="space-y-4" id="product-form">
                    @csrf
                    <div>
                        <label for="product_name" class="text-gray-800 text-sm mb-2 block">ชื่อสินค้า</label>
                        <input placeholder="Product Name" type="text" name="product_name" id="product_name" required
                            class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-[#DC5F00]">
                    </div>

                    <div>
                        <label for="product_detail" class="text-gray-800 text-sm mb-2 block">รายละเอียดสินค้า</label>
                        <textarea placeholder="Product detail" name="product_detail" id="product_detail" required
                            class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-[#DC5F00]"></textarea>
                    </div>

                    <div>
                        <label for="product_qty" class="text-gray-800 text-sm mb-2 block">จำนวน</label>
                        <input placeholder="Product quantity" type="number" name="product_qty" id="product_qty" required
                            min="0" class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-[#DC5F00]">
                    </div>

                    <div>
                        <label for="product_price" class="text-gray-800 text-sm mb-2 block">ราคา</label>
                        <input placeholder="Product Price" type="number" name="product_price" id="product_price" required
                            min="0" step="0.01" class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-[#DC5F00]">
                    </div>

                    <button id="submit-btn" type="submit" class="w-full py-3 px-4 text-sm font-semibold text-white bg-[#DC5F00] hover:bg-[#D0E4F4] focus:outline-none rounded-md transition duration-300">
                        เพิ่มสินค้า
                    </button>
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
