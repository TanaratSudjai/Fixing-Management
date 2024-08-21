<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer Repair Request</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Main Container -->
    <div class="bg-gray-100 font-sans leading-normal tracking-normal flex items-center justify-center min-h-screen p-5"
        style="font-family: 'Kanit', sans-serif;">
        <div class="w-full max-w-md mx-auto bg-white  shadow-lg p-6">
            <h2 class="text-2xl font-bold text-center text-black mb-6">เเจ้งซ่อมสำหรับลูกค้า</h2>

            <!-- Success Message -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3  relative mb-6"
                    role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3  relative mb-6" role="alert">
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
                    <textarea id="repair_detail" name="repair_detail"
                        class="form-textarea mt-1 block w-full -md border border-blue-500 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 h-[300px] p-2"
                        required></textarea>
                </div>
                <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 -lg shadow-md transition duration-300">
                    ส่งคำขอ
                </button>
            </form>
        </div>
    </div>
    <div class="w-full flex justify-end relative">
        <div
            class="bg-blue-300 text-2xl w-[50px] h-[50px] flex items-center justify-center fixed top-[85%] right-5 m-4">
            <a href="{{ route('customer.dashboard') }}">X</a>
        </div>
    </div>

</body>

</html>
