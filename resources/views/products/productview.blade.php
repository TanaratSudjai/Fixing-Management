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
                                                    class="text-[#EEEEEE] px-3 py-1 bg-[#373A40] hover:bg-[#373A40] cursor-pointer">แก้ไข</a>

                                                <form id="del_form_{{ $product->product_id }}"
                                                    action="{{ route('product.delete', $product->product_id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button id="del_btn_{{ $product->product_id }}" type="submit"
                                                        class="text-[#EEEEEE] px-3 py-1 bg-[#DC5F00] hover:bg-[#DC5F00]">
                                                        ลบ
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </div>
                    </table>
                    <div id="pagination-controls" class="bottom-0 left-0 flex justify-center items-center mt-4 ">
                            <button onclick="previousPage()"
                                class="bg-[#686D76] text-white py-2 px-2 rounded-lg mr-2">ก่อนหน้า</button>
                            <span id="current-page" class="text-gray-800">1</span> /
                            <span id="total-pages" class="text-gray-800">1</span>
                            <button onclick="nextPage()"
                                class="bg-[#DC5F00] text-white py-2 px-2 rounded-lg ml-2">ถัดไป</button>
                        </div>
                    </div>
                @endif
        </div>
    </div>

    <script>
        // Handle delete confirmation for each delete button
        document.querySelectorAll('button[id^="del_btn_"]').forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();  // Prevent form submission

                const productId = this.id.split('_')[2];  // Extract product ID
                const form = document.getElementById(`del_form_${productId}`);  // Get form associated with the button

                // Show SweetAlert confirmation with custom colors
                Swal.fire({
                    title: "คุณแน่ใจว่าจะลบพนักงานคนนี้?",
                    text: "แน่ใจใช่ไหม?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DC5F00",  // Orange button (ใช่, ฉันแน่ใจ!)
                    cancelButtonColor: "#373A40",   // Dark gray button (ยกเลิก)
                    confirmButtonText: "ใช่, ฉันแน่ใจ!",
                    cancelButtonText: "ยกเลิก"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If the user confirms, submit the form to delete the product
                        form.submit();

                        // Show success message after the form submission
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                        });
                    }
                });
            });
        });
    </script>


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


                            <div class="mb-4">
                                <label for="profile_image" class="text-gray-800 text-sm font-medium mb-2 block">รูปสินค้า
                                    (มีหรือไม่มีก็ได้)</label>
                                <div class="flex items-center justify-center w-full">
                                    <label
                                        class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 16l-4-4m0 0l4-4m-4 4h18m-8 4l4-4m0 0l-4-4m4 4H3"></path>
                                            </svg>
                                            <p class="mb-2 text-sm text-gray-500"><span
                                                    class="font-semibold">คลิกเพื่ออัปโหลด</span> หรือ ลากไฟล์มาที่นี่</p>
                                            <p class="text-xs text-gray-500">PNG, JPG หรือ GIF (ขนาดไม่เกิน 2MB)</p>
                                        </div>
                                        <input type="file" name="image" id="image" class="hidden" accept="image/*" />
                                    </label>
                                </div>
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

        document.addEventListener('DOMContentLoaded', function(){
            toggleEditProductModal();
            searchRepairs();
            paginate(Array.from(rows));
        });

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
        
        let currentPage = 0;
        const rowsPerPage = 8;

        function searchRepairs() {

            const rows = document.querySelectorAll('tbody tr');
            paginate(Array.from(rows));
        }

        function paginate(rows) {
            const totalPages = Math.ceil(rows.length / rowsPerPage);
            document.getElementById('total-pages').textContent = totalPages;

            if (currentPage > totalPages) currentPage = totalPages;
            if (currentPage < 1) currentPage = 1;

            const start = (currentPage - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            const rowsToShow = rows.slice(start, end);

            document.querySelectorAll('tbody tr').forEach(row => row.style.display = 'none');

            // Show the rows for the current page
            rowsToShow.forEach(row => row.style.display = '');

            // Update current page display
            document.getElementById('current-page').textContent = currentPage;

            // Disable/enable pagination buttons based on the page
            document.querySelector('button[onclick="previousPage()"]').disabled = currentPage === 1;
            document.querySelector('button[onclick="nextPage()"]').disabled = currentPage === totalPages || totalPages ===
                0;
        }

        function previousPage() {
            if (currentPage > 1) {
                currentPage--;
                searchRepairs();
            }
        }

        function nextPage() {
            const totalPages = parseInt(document.getElementById('total-pages').textContent);
            if (currentPage < totalPages) {
                currentPage++;
                searchRepairs();
            }
        }

        function submitSearch() {
            currentPage = 1; // Reset to first page on a new search
            searchRepairs();
        }
    </script>



</body>

</html>