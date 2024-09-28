<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Repair</title>
     <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
</head>

<body class="bg-[#EEEEEE] font-sans leading-normal tracking-normal min-h-screen flex items-center justify-center"
    style="font-family: 'Kanit', sans-serif;">
    @extends('layouts.customer')

    @section('content')
        <div class="bg-white bg-cover bg-center h-20 shadow-md flex justify-center items-center fixed top-0 w-full z-10">
            <img src="{{ asset('images/logoo.png') }}" class="w-10 h-10">
        </div>
        <div class="w-full max-w-lg  rounded-lg p-6 mx-4 sm:mx-6 lg:mx-8 mt-20"> <!-- Added margin-top -->
            <h1 class="text-2xl font-bold text-[#373A40] mb-4 text-center">แก้ไขการซ่อม</h1>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mb-4 rounded-lg">
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
                <textarea
                    class="w-full h-[150px] px-4 py-3 border border-[#686D76] rounded-lg shadow-sm text-lg text-[#373A40] focus:outline-none focus:ring-2 focus:ring-[#DC5F00] focus:border-[#DC5F00] sm:text-sm"
                    name="repair_detail" id="" cols="30" rows="10" required>{{ $repair->repair_detail }}</textarea>
                <div class="flex flex-col gap-4 mt-6">
                    <button type="submit"
                        class="w-full bg-[#DC5F00] text-white font-bold py-2 px-4 rounded-lg hover:bg-[#FF6F00] transition duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#DC5F00]">
                        อัปเดตการซ่อม
                    </button>
                    <a href="{{ route('repairs.list') }}"
                        class="w-full bg-[#686D76] text-white font-bold py-2 px-4 rounded-lg hover:bg-[#575B60] transition duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#686D76] text-center">
                        ยกเลิก
                    </a>
                </div>
            </form>
        </div>
    @endsection

</body>

</html>
