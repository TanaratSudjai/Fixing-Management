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
        nav{
            font-family: 'Kanit', sans-serif;
        }
    </style>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body>
    <nav class="bg-[#E1F7F5] ">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <button type="button"
                        class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-black"
                        aria-controls="mobile-menu" aria-expanded="false" id="mobile-menu-button">
                        <span class="absolute -inset-0.5"></span>
                        <span class="sr-only">เปิดเมนูหลัก</span>
                        <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="flex flex-shrink-0 items-center">
                        <img src="logo.png" alt="Logo" class="w-10 h-8" alt="Your Company">
                    </div>
                    <div class="hidden sm:ml-6 sm:block">
                        <div class="flex space-x-4 focus:outline-none justify-center mt-1">
                            
                            <a href="{{ route('employee.work') }}"
                                class="px-3 py-2 focus:outline-none self-start sm:self-center w-full sm:w-auto hover:text-[#0E46A3] hover:border-b-2 border-[#0E46A3]">
                                รายการแจ้งซ่อม
                            </a>
                            
                        </div>
                    </div>
                </div>
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    
                    <div class="relative flex justify-between items-center ml-3 gap-3">
                        <div>
                            <div class="relative flex rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                                id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="absolute -inset-1.5"></span>
                                <span class="sr-only">เปิดเมนูผู้ใช้</span>
                                @if (session('message'))
                                    <div class="alert alert-success text-black">
                                        <strong>{{ session('message') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <a href="{{ route('logout') }}" class="text-black ml-auto hover:text-[#FF0000]" role="menuitem" tabindex="-1"
                            id="user-menu-item-2">
                            <button type="button">ออกจากระบบ</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Mobile menu, show/hide based on menu state. -->
        <div class="sm:hidden hidden" id="mobile-menu">
            <div class="space-y-1 px-2 pb-3 pt-2">
                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                <a href="{{ route('employee.work') }}"
                    class="block rounded-md px-3 py-2 text-base font-medium text-black hover:bg-gray-700 hover:text-white">รายการแจ้งซ่อม</a>
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
