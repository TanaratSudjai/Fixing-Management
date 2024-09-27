<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
     <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<style>
    body {
        font-family: 'Kanit', sans-serif;
    }
</style>

<body>



    <nav class="bg-[#373A40]">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <button type="button"
                        class="inline-flex items-center justify-center p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                        aria-controls="mobile-menu" aria-expanded="false" id="mobile-menu-button">
                        <span class="sr-only">Open main menu</span>
                        <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="flex items-center">
                        <img src="{{ asset('images/logoo.png') }}" class="w-10 h-10">
                    </div>
                    <div class="hidden sm:ml-6 sm:block">
                        <div class="flex space-x-4 justify-center mt-1">
                            <a href="{{ route('admin.dashboard') }}"
                                class="px-3 py-2 text-[#EEEEEE] hover:text-[#DC5F00] hover:border-b-2 border-[#DC5F00] self-start sm:self-center">
                                แผงควบคุม
                            </a>
                            <a href="{{ route('customer.repir') }}"
                                class="px-3 py-2 text-[#EEEEEE] hover:text-[#DC5F00] hover:border-b-2 border-[#DC5F00] self-start sm:self-center">
                                รายการแจ้งซ่อม
                            </a>
                            <a onclick="toggleEmployeeModal()"
                                class="px-3 py-2 text-[#EEEEEE] hover:text-[#DC5F00] hover:border-b-2 border-[#DC5F00] self-start sm:self-center">
                                เพิ่มพนักงาน
                            </a>
                            <a onclick="toggleProductModal()"
                                class="px-3 py-2 text-[#EEEEEE] hover:text-[#DC5F00] hover:border-b-2 border-[#DC5F00] self-start sm:self-center">
                                เพิ่มสินค้า
                            </a>
                            <a href="{{ route('products.view') }}"
                                class="px-3 py-2 text-[#EEEEEE] hover:text-[#DC5F00] hover:border-b-2 border-[#DC5F00] self-start sm:self-center">
                                รายการสินค้า
                            </a>
                            <a href="{{ route('employee.list') }}"
                                class="px-3 py-2 text-[#EEEEEE] hover:text-[#DC5F00] hover:border-b-2 border-[#DC5F00] self-start sm:self-center">
                                รายชื่อพนักงาน
                            </a>
                        </div>
                    </div>
                </div>
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    <a href="{{ route('logout') }}"
                        class="text-[#EEEEEE] hover:text-[#DC5F00] hover:border-b-2 border-[#DC5F00]" role="menuitem">
                        <button type="button">ออกจากระบบ</button>
                    </a>
                </div>
            </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state. -->
        <div class="sm:hidden hidden" id="mobile-menu">
            <div class="space-y-1 px-2 pb-3 pt-2">
                <a href="{{ route('admin.dashboard') }}"
                    class="block rounded-md px-3 py-2 text-base font-medium text-[#EEEEEE] hover:bg-[#DC5F00] hover:text-white">
                    แผงควบคุม
                </a>
                <a href="{{ route('customer.repir') }}"
                    class="block rounded-md px-3 py-2 text-base font-medium text-[#EEEEEE] hover:bg-[#DC5F00] hover:text-white">
                    รายการแจ้งซ่อม
                </a>
                <a onclick="toggleEmployeeModal()"
                    class="block rounded-md px-3 py-2 text-base font-medium text-[#EEEEEE] hover:bg-[#DC5F00] hover:text-white">
                    เพิ่มพนักงาน
                </a>
                <a onclick="toggleProductModal()"
                    class="block rounded-md px-3 py-2 text-base font-medium text-[#EEEEEE] hover:bg-[#DC5F00] hover:text-white">
                    เพิ่มสินค้า
                </a>
                <a href="{{ route('products.view') }}"
                    class="block rounded-md px-3 py-2 text-base font-medium text-[#EEEEEE] hover:bg-[#DC5F00] hover:text-white">
                    รายการสินค้า
                </a>
                <a href="{{ route('employee.list') }}"
                    class="block rounded-md px-3 py-2 text-base font-medium text-[#EEEEEE] hover:bg-[#DC5F00] hover:text-white">
                    รายชื่อพนักงาน
                </a>
            </div>
        </div>
    </nav>

    <div id="addEmployeeModal" class="fixed hidden w-full bg-opacity-50 backdrop-blur-sm">
        <div class=" w-full h-[95vh]  flex justify-center items-center">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md space-y-4">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">เพิ่มพนักงาน</h2>
                    <button onclick="toggleEmployeeModal()" class="text-gray-400 hover:text-gray-600">
                        &times;
                    </button>
                </div>

                <!-- Employee Form -->
                <form id="employee-form" action="{{ route('admin.addEmployee') }}" method="POST"
                    enctype="multipart/form-data" class="space-y-4">

                    @csrf
                    <div>
                        <label for="name" class="text-gray-800 text-sm mb-2 block">ชื่อผู้ใช้</label>
                        <input type="text" name="name" id="name" placeholder="Username" required
                            class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                    </div>
                    <div>
                        <label for="email" class="text-gray-800 text-sm mb-2 block">อีเมล</label>
                        <input type="email" name="email" id="email" placeholder="Email" required
                            class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                    </div>
                    <div>
                        <label for="password" class="text-gray-800 text-sm mb-2 block">รหัสผ่าน</label>
                        <input type="password" name="password" id="password" placeholder="Password" required
                            class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                    </div>
                    <div>
                        <label for="password_confirmation"
                            class="text-gray-800 text-sm mb-2 block">ยืนยันรหัสผ่าน</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            placeholder="Confirm Password" required
                            class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                    </div>
                    <div class="mb-4">
                        <label for="profile_image"
                            class="text-gray-800 text-sm font-medium mb-2 block">โปรไฟล์พนักงาน</label>
                        <div class="flex items-center justify-center w-full">
                            <label
                                class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16l-4-4m0 0l4-4m-4 4h18m-8 4l4-4m0 0l-4-4m4 4H3"></path>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500"><span
                                            class="font-semibold">คลิกเพื่ออัปโหลด</span>
                                        หรือ ลากไฟล์มาที่นี่</p>
                                    <p class="text-xs text-gray-500">PNG, JPG หรือ GIF (ขนาดไม่เกิน 2MB)</p>
                                </div>
                                <input type="file" name="image" id="image" class="hidden" />
                            </label>
                        </div>
                    </div>
                    <button id="submit-btn" type="submit"
                        class="w-full py-3 px-4 text-sm font-semibold text-white bg-[#DC5F00] hover:bg-[#D0E4F4] focus:outline-none rounded-md transition duration-300">
                        เพิ่มพนักงาน
                    </button>
                </form>
            </div>
        </div>
    </div>


    <div id="addProductModal" class="fixed hidden w-full bg-opacity-50 backdrop-blur-sm">
        <div class=" w-full h-[95vh]  flex justify-center items-center">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md space-y-4">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">เพิ่มสินค้า</h2>
                    <button onclick="toggleProductModal()" class="text-gray-400 hover:text-gray-600">
                        &times;
                    </button>
                </div>

                <!-- Employee Form -->
                <form action="{{ route('admin.addProduct') }}" enctype="multipart/form-data" method="POST"
                    class="space-y-4" id="product-form">
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
                            min="0"
                            class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-[#DC5F00]">
                    </div>

                    <div>
                        <label for="product_price" class="text-gray-800 text-sm mb-2 block">ราคา</label>
                        <input placeholder="Product Price" type="number" name="product_price" id="product_price"
                            required min="0" step="0.01"
                            class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-[#DC5F00]">
                    </div>

                    <div class="mb-4">
                        <label for="profile_image" class="text-gray-800 text-sm font-medium mb-2 block">รูปสินค้า
                            (มีหรือไม่มีก็ได้)</label>
                        <div class="flex items-center justify-center w-full">
                            <label
                                class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16l-4-4m0 0l4-4m-4 4h18m-8 4l4-4m0 0l-4-4m4 4H3"></path>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500"><span
                                            class="font-semibold">คลิกเพื่ออัปโหลด</span> หรือ ลากไฟล์มาที่นี่</p>
                                    <p class="text-xs text-gray-500">PNG, JPG หรือ GIF (ขนาดไม่เกิน 2MB)</p>
                                </div>
                                <input type="file" name="image_product" id="image_product" class="hidden" />
                            </label>
                        </div>
                    </div>

                    <button id="submit-btn" type="submit"
                        class="w-full py-3 px-4 text-sm font-semibold text-white bg-[#DC5F00] hover:bg-[#D0E4F4] focus:outline-none rounded-md transition duration-300">
                        เพิ่มสินค้า
                    </button>
                </form>
            </div>
        </div>
    </div>


    {{--
    <script>
        document.getElementById('employee-form').addEventListener('submit', function (e) {
            e.preventDefault(); // ป้องกันการ submit แบบธรรมดา

            let email = document.getElementById('email').value;
            let password = document.getElementById('password').value;

            // ตรวจสอบว่ารหัสผ่านยาวน้อยกว่า 8 ตัวหรือไม่
            if (password.length < 8) {
                Swal.fire({
                    icon: 'error',
                    title: 'รหัสผ่านไม่เพียงพอ',
                    text: 'รหัสผ่านต้องมีความยาวอย่างน้อย 8 ตัวอักษร!',
                });
                return; // หยุดการ submit
            }

        });
    </script> --}}

    <!-- SweetAlert for Email Error -->


    @if (session('email'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'ข้อผิดพลาด',
                text: 'อีเมลนี้ถูกใช้ไปแล้ว',
                confirmButtonText: 'ตกลง'
            });
        </script>
    @endif

    @if (session('compass'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'ข้อผิดพลาด',
                text: 'รหัสผ่านไม่ตรงกัน',
                confirmButtonText: 'ตกลง'
            });
        </script>
    @endif

    @if (session('ePass'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'ข้อผิดพลาด',
                text: 'รหัสผ่านต้องมีอย่างน้อย 8 ตัว',
                confirmButtonText: 'ตกลง'
            });
        </script>
    @endif


    <!-- SweetAlert for Success -->
    @if (session('swal_success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'สำเร็จ',
                text: '{{ session('swal_success') }}',
                confirmButtonText: 'ตกลง'
            });
        </script>
    @endif

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'สำเร็จ!',
                text: '{{ session('success') }}',
                confirmButtonText: 'ตกลง',
                confirmButtonColor: '#DC5F00',  // Use the same orange color
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'สำเร็จ!',
                text: '{{ session('success') }}',
                confirmButtonText: 'ตกลง',
                confirmButtonColor: '#DC5F00',  // Use the same orange color
            });
        </script>

    @endif


    <script>
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');


        mobileMenuButton.addEventListener('click', () => {
            const isMenuOpen = mobileMenu.classList.contains('hidden');
            mobileMenu.classList.toggle('hidden', !isMenuOpen);
            mobileMenuButton.setAttribute('aria-expanded', !isMenuOpen);
        });


        function toggleEmployeeModal() {
            const modal = document.getElementById('addEmployeeModal');
            modal.style.display = modal.style.display === 'none' ? 'block' : 'none';
        }

        function toggleProductModal() {
            const modal = document.getElementById('addProductModal');
            modal.style.display = modal.style.display === 'none' ? 'block' : 'none';
        }
    </script>

</body>



</html>