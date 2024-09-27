<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer Dashboard</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <style>
        nav {
            font-family: 'Kanit', sans-serif;
        }

        .active-menu {
            color: #DC5F00;
        }
    </style>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="bg-gray-100">

    <footer class="fixed bottom-0 w-full bg-white border-t shadow-md">
        <div class="flex justify-around items-center py-3 w-full max-w-md mx-auto gap-6">

            <a href="{{ route('customer.dashboard') }}"
                class="flex flex-col items-center transition-transform duration-300 {{ request()->routeIs('customer.dashboard') ? 'active-menu' : '' }} hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    class="bi bi-broadcast-pin" viewBox="0 0 16 16">
                    <path
                        d="M3.05 3.05a7 7 0 0 0 0 9.9.5.5 0 0 1-.707.707 8 8 0 0 1 0-11.314.5.5 0 0 1 .707.707m2.122 2.122a4 4 0 0 0 0 5.656.5.5 0 1 1-.708.708 5 5 0 0 1 0-7.072.5.5 0 0 1 .708.708m5.656-.708a.5.5 0 0 1 .708 0 5 5 0 0 1 0 7.072.5.5 0 1 1-.708-.708 4 4 0 0 0 0-5.656.5.5 0 0 1 0-.708m2.122-2.12a.5.5 0 0 1 .707 0 8 8 0 0 1 0 11.313.5.5 0 0 1-.707-.707 7 7 0 0 0 0-9.9.5.5 0 0 1 0-.707zM6 8a2 2 0 1 1 2.5 1.937V15.5a.5.5 0 0 1-1 0V9.937A2 2 0 0 1 6 8" />
                </svg>
                <span class="text-sm">เเจ้งซ่อม</span>
            </a>

            <a href="{{ route('repairs.list') }}"
                class="flex flex-col items-center transition-transform duration-300 {{ request()->routeIs('repairs.list') ? 'active-menu' : '' }} hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    class="bi bi-collection-fill" viewBox="0 0 16 16">
                    <path
                        d="M0 13a1.5 1.5 0 0 0 1.5 1.5h13A1.5 1.5 0 0 0 16 13V6a1.5 1.5 0 0 0-1.5-1.5h-13A1.5 1.5 0 0 0 0 6zM2 3a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 0-1h-11A.5.5 0 0 0 2 3m2-2a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7A.5.5 0 0 0 4 1" />
                </svg>
                <span class="text-sm">ประวิตการซ่อม</span>
            </a>

            <a href="{{ route('profileCustomer.view') }}"
                class="flex flex-col items-center transition-transform duration-300 {{ request()->routeIs('profileCustomer.view') ? 'active-menu' : '' }} hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    class="bi bi-person" viewBox="0 0 16 16">
                    <path
                        d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                </svg>
                <span class="text-sm">โปรไฟล์</span>
            </a>
        </div>
    </footer>


</body>

</html>
