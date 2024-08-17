<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Repair Service</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal flex items-center justify-center min-h-screen p-5">

    <!-- Main Content -->
    <div class="w-full max-w-sm mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Header -->
        <header class="bg-blue-600 text-white text-center py-4">
            <h1 class="text-xl font-bold">Repair Service Portal</h1>
        </header>

        <!-- Notification Message -->
        @if (session('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative m-4" role="alert">
                <span class="block sm:inline">{{ session('message') }}</span>
            </div>
        @endif

        <!-- Action Links -->
        <div class="p-4">
            <a href="{{ route('customer.addrepir') }}" class="block bg-blue-500 hover:bg-blue-600 text-white text-center font-bold py-4 px-6 mb-4 rounded-lg shadow-md transition duration-300">
                เเจ้งซ่อม
            </a>
            <a href="{{ route('repairs.list') }}" class="block bg-blue-500 hover:bg-blue-600 text-white text-center font-bold py-4 px-6 rounded-lg shadow-md transition duration-300">
                รายการเเจ้งซ่อม
            </a>
        </div>
    </div>

</body>

</html>
