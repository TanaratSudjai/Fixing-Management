<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <style>
        nav {
            font-family: 'Kanit', sans-serif;
        }
    </style>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body>
    <nav class="bg-[#373A40] fixed w-full shadow-md">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">
                <!-- Mobile Menu Button -->
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <button type="button"
                        class="inline-flex items-center justify-center p-2 rounded-md text-[#EEEEEE] hover:bg-[#686D76] hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-[#DC5F00]"
                        aria-controls="mobile-menu" aria-expanded="false" id="mobile-menu-button">
                        <span class="sr-only">เปิดเมนูหลัก</span>
                        <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                </div>

                <!-- Logo Section -->
                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="flex-shrink-0 items-center">
                        <img src={{ asset('images/logoo.png') }} alt="Logo" class="w-10 h-8">
                    </div>
                    <!-- Main Navigation -->
                    <div class="hidden sm:ml-6 sm:flex space-x-4">
                        <a href="{{ route('employee.work') }}"
                            class="text-[#EEEEEE] px-3 py-2 rounded-md text-sm font-medium hover:text-[#DC5F00] hover:border-b-2 border-[#DC5F00]">
                            รายการแจ้งซ่อม
                        </a>
                    </div>

                    <div class="hidden sm:ml-6 sm:flex space-x-4">
                        <a href="{{ route('profile.view') }}"
                            class="text-[#EEEEEE] px-3 py-2 rounded-md text-sm font-medium hover:text-[#DC5F00] hover:border-b-2 border-[#DC5F00]">
                            โปรไฟล์
                        </a>
                    </div>
                </div>

                <!-- Right Section (User Menu & Logout) -->
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    <!-- User Menu -->
                    {{-- <div class="relative">
                        @if (session('message'))
                            <div class="alert alert-success text-black p-1 px-3 bg-[#DC5F00] rounded-full ">
                                <strong class="text-[#EEEEEE]">{{ session('message') }}</strong>
                            </div>
                        @endif
                    </div> --}}
                    <!-- Logout Button -->
                    <a href="{{ route('logout') }}" class="text-[#EEEEEE] ml-3 hover:text-[#DC5F00]" role="menuitem">
                        <button type="button" class="px-3 py-2 rounded-md text-sm font-medium">ออกจากระบบ</button>
                    </a>
                </div>
            </div>
        </div>

        <!-- Mobile menu, hidden by default -->
        <div class="sm:hidden hidden" id="mobile-menu">
            <div class="space-y-1 px-2 pb-3 pt-2">
                <a href="{{ route('employee.work') }}"
                    class="block rounded-md px-3 py-2 text-base font-medium text-[#EEEEEE] hover:bg-[#DC5F00] hover:text-white">
                    รายการแจ้งซ่อม
                </a>
            </div>
            <div class="space-y-1 px-2 pb-3 pt-2">
                <a href="{{ route('profile.view') }}"
                    class="text-[#EEEEEE] px-3 py-2 rounded-md text-sm font-medium hover:text-[#DC5F00] hover:border-b-2 border-[#DC5F00]">
                    โปรไฟล์
                </a>
            </div>
        </div>
    </nav>


    <script>
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            const isMenuOpen = mobileMenu.classList.contains('hidden');
            mobileMenu.classList.toggle('hidden', !isMenuOpen);
            mobileMenuButton.setAttribute('aria-expanded', isMenuOpen);
        });
    </script>
</body>

</html>
