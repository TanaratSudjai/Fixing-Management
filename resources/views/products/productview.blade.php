<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product for Admin</title>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
                        <div class="relative overflow-x-auto">
                            <table class="text-sm text-center text-black w-full">
                                <thead class="bg-gray-200 sticky top-0">
                                    <tr>
                                        <th class="p-2 px-2 border-b border-gray-300">รหัสสินค้า</th>
                                        <th class="p-2 px-2 border-b border-gray-300">ชื่อ</th>
                                        <th class="p-2 px-2 border-b border-gray-300">รายละเอียด</th>
                                        <th class="p-2 px-2 border-b border-gray-300">จำนวน</th>
                                        <th class="p-2 px-2 border-b border-gray-300">ราคา</th>
                                        <th class="p-2 px-2 border-b border-gray-300">ดำเนินการ</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($products as $product)
                                        <tr class="even:bg-gray-50">
                                            <td class="p-2 border-b border-gray-300">{{ $product->product_id }}</td>
                                            <td class="p-2 border-b border-gray-300">{{ $product->product_name }}</td>
                                            <td class="p-2 border-b border-gray-300">{{ $product->product_detail }}</td>
                                            <td class="p-2 border-b border-gray-300">{{ $product->product_qty }}</td>
                                            <td class="p-2 border-b border-gray-300">${{ number_format($product->product_price) }}</td>
                                            <td class="p-2 border-b border-gray-300">
                                                <div class="flex justify-center gap-3">
                                                    <a href="{{ route('product.edit', $product->product_id) }}"
                                                        class="text-[#EEEEEE] px-3 py-1 bg-[#373A40]  hover:bg-[#373A40]">แก้ไข</a>

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

        <script>
            document.querySelectorAll('button[id^="del_btn_"]').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent the form from submitting immediately

                    const product_id = this.id.split('_')[2]; // Extract the product ID from the button ID
                    const form = document.getElementById(`del_form_${product_id}`);

                    Swal.fire({
                        title: "คุณแน่ใจว่าจะลบสินค้านี้หรือไม่?",
                        text: "แน่ใจใช่ไหม?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DC5F00",
                        cancelButtonColor: "#373A40",
                        confirmButtonText: "ใช่, ฉันแน่ใจ!",
                        cancelButtonText: "ยกเลิก"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // Submit the form if confirmed
                        }
                    });
                });
            });
        </script>

    @endsection
</body>

</html>
