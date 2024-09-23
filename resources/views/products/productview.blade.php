<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product for Admin</title>

    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Kanit', sans-serif;
        }
    </style>
</head>

<body class="bg-[#EEEEEE]">
    @extends('layouts.admin')
    @section('content')
        <div class="p-6 bg-[#EEEEEE] border h-[92vh] flex justify-center w-full">
            <div class="container mx-auto">
                <div class="bg-white p-4 px-4 md:p-8 mb-6 h-full rounded-md shadow-md">
                    <h1 class="text-center text-[#373A40] text-2xl font-bold mb-3">สินค้าทั้งหมด</h1>

                    @if ($products->isEmpty())
                        <p class="text-center text-2xl font-bold mb-3">ไม่มีรายการสินค้า</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="text-sm text-center text-black w-full">
                                <thead class="bg-gray-200 top-0">
                                    <tr>
                                        <th class="p-2 px-2 border-b border-gray-300">รหัสสินค้า</th>
                                        <th class="p-2 px-2 border-b border-gray-300">รูปภาพ</th>
                                        <th class="p-2 px-2 border-b border-gray-300">ชื่อ</th>
                                        <th class="p-2 px-2 border-b border-gray-300">รายละเอียด</th>
                                        <th class="p-2 px-2 border-b border-gray-300">จำนวน</th>
                                        <th class="p-2 px-2 border-b border-gray-300">ราคา</th>
                                        <th class="p-2 px-2 border-b border-gray-300">ดำเนินการ</th>
                                    </tr>
                                </thead>
                                <tbody class=" text-center">
                                    @foreach ($products as $product)
                                        <tr class="even:bg-gray-50">
                                            <td class="p-2 ">{{ $product->product_id }}</td>
                                            <td class="p-2 flex justify-center">
                                                @if ($product->product_image)
                                                    <img src="{{ asset($product->product_image) }}" alt="Product Image"
                                                        class="w-16 h-16 object-cover rounded-full">
                                                @else
                                                    <img src="{{ asset('images/profile.png') }}" alt="Profile Image"
                                                        class="w-16 h-16 object-cover rounded-full">
                                                @endif
                                            </td>

                                            <td class="p-2 ">{{ $product->product_name }}</td>
                                            <td class="p-2 ">{{ $product->product_detail }}</td>
                                            <td class="p-2 ">{{ $product->product_qty }}</td>
                                            <td class="p-2 ">
                                                ${{ number_format($product->product_price) }}</td>
                                            <td class="p-2 ">
                                                <div class="flex justify-center gap-3">
                                                    <a onclick="toggleEditProductModal(
    {{ $product->product_id }},
    '{{ $product->product_name }}',
    '{{ $product->product_detail }}',
    {{ $product->product_qty }},
    {{ $product->product_price }}
)"
                                                        class="text-[#EEEEEE] px-3 py-1 bg-[#373A40] hover:bg-[#373A40]">แก้ไข</a>

                                                    <form id="del_form_{{ $product->product_id }}"
                                                        action="{{ route('product.delete', $product->product_id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button id="del_btn_{{ $product->product_id }}" type="submit"
                                                            class="text-[#EEEEEE] px-3 py-1 bg-[#DC5F00]  hover:bg-[#DC5F00]">ลบ</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        @if (session('success'))
        <script>
            showSuccessAlert();
        </script>
    @endif
    @endsection

    <div id="editProductModal" class="fixed hidden w-full bg-opacity-50 backdrop-blur-sm">
        <div class=" w-full h-[95vh]  flex justify-center items-center">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md space-y-4">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">แก้ไขสินค้า</h2>
                    <button onclick="toggleEditProductModal()" class="text-gray-400 hover:text-gray-600">
                        &times;
                    </button>
                </div>
                @if(isset($product)) 
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

                        </div>

                        <div>
                            <label for="product_detail"
                                class="text-[#373A40] text-sm mb-2 block">รายละเอียดสินค้า</label>
                            <textarea name="product_detail" id="product_detail" required
                                class="w-full text-[#373A40] text-sm border border-gray-300 px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-[#DC5F00]">{{ old('product_detail', $product->product_detail) }}</textarea>

                        </div>

                        <div>
                            <label for="product_qty" class="text-[#373A40] text-sm mb-2 block">จำนวนสินค้า</label>
                            <input type="number" name="product_qty" id="product_qty"
                                class="w-full text-[#373A40] text-sm border border-gray-300 px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-[#DC5F00]"
                                value="{{ old('product_qty', $product->product_qty) }}" required min="0">

                        </div>

                        <div>
                            <label for="product_price" class="text-[#373A40] text-sm mb-2 block">ราคาสินค้า</label>
                            <input type="number" name="product_price" id="product_price"
                                class="w-full text-[#373A40] text-sm border border-gray-300 px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-[#DC5F00]"
                                value="{{ old('product_price', $product->product_price) }}" required min="0"
                                step="0.01">

                        </div>

                        <div>
                            <label for="image" class="text-[#373A40] text-sm mb-2 block">รูปสินค้า</label>
                            <input type="file" name="image" id="image" accept="image/*"
                                class="w-full text-sm text-[#373A40] file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:bg-[#F3F4F6] hover:file:bg-[#F1F3F5]">

                        </div>
                        <button type="submit" id="submit-btn"
                            class="mt-4 w-full bg-[#DC5F00] text-white py-3 rounded-md hover:bg-[#C44D00] focus:outline-none focus:ring-2 focus:ring-[#373A40] transition duration-300 ease-in-out">
                            บันทึก
                        </button>
                    </div>
                </form>
                @else
                <!-- If $repair data is not available -->
                <div class="text-center text-gray-500">
                    ไม่มีข้อมูลที่จะแสดง
                </div>
                @endif
            </div>
        </div>
    </div>

    

    <script>
        function showSuccessAlert() {
            Swal.fire({
                icon: 'success',
                title: 'แก้ไขสำเร็จ!',
                text: 'สินค้าถูกแก้ไขเรียบร้อยแล้ว',
                confirmButtonText: 'ตกลง'
            });
        }

        function toggleEditProductModal(productId, productName, productDetail, productQty, productPrice) {
            const modal = document.getElementById('editProductModal');
            const form = document.getElementById('editProduct-form');

            // Toggle modal visibility using hidden class
            modal.style.display = modal.style.display === 'none' ? 'block' : 'none';

            // Update form action with productId
            if (productId) {
                form.action = `/product/update/${productId}`;
            }

            // Update form fields with product data
            document.getElementById('product_name').value = productName;
            document.getElementById('product_detail').value = productDetail;
            document.getElementById('product_qty').value = productQty;
            document.getElementById('product_price').value = productPrice;
        }
    </script>
</body>

</html>
