<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer Repair Request</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal flex items-center justify-center min-h-screen p-5">

    <!-- Main Container -->
    <div class="w-full max-w-md mx-auto bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-bold text-center text-blue-600 mb-6">เเจ้งซ่อมสำหรับลูกค้า</h2>

        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Repair Form -->
        <form action="{{ route('repairs.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="repair_detail" class="block text-sm font-medium text-gray-700">รายละเอียดการซ่อม</label>
                <textarea id="repair_detail" name="repair_detail" class="form-textarea mt-1 block w-full rounded-md border border-blue-500 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required></textarea>
            </div>
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300">
                ส่งคำขอ
            </button>
        </form>
    </div>

</body>

</html>
