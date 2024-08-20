<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Repair</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal min-h-screen flex items-center justify-center" style="font-family: 'Kanit', sans-serif;">
    <div class="w-full max-w-lg bg-white  shadow-md p-6 mx-4 sm:mx-6 lg:mx-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-4 text-center">แก้ไขการซ่อม</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3  relative mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('repairs.update', $repair->repair_id) }}" method="POST">
            @csrf
            @method('PUT')
            <textarea class="w-full h-[150px] px-4 py-3 border border-gray-300  shadow-sm text-lg focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                name="repair_detail" id="" cols="30" rows="10"  required >{{ $repair->repair_detail }}</textarea>
            <div class="flex flex-col gap-4">
                <button type="submit" 
                        class="w-full bg-blue-500 text-white font-bold py-2 px-4  hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    อัปเดตการซ่อม
                </button>
                <a href="{{ route('customer.dashboard') }}"
                   class="w-full bg-red-500 text-white font-bold py-2 px-4  hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 text-center">
                    ยกเลิก
                </a>
            </div>
        </form>
    </div>
</body>

</html>
