<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Repair Service</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-100 font-['Kanit']">
@extends('layouts.customer')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <header class="text-center mb-8">
            <h1 class="text-4xl font-bold text-blue-600 mb-2 transform hover:scale-105 transition duration-300">เเจ้งซ่อมสำหรับลูกค้า</h1>
            <div class="w-24 h-1 bg-blue-500 mx-auto rounded-full"></div>
        </header>
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg p-8">
            <!-- Success Message -->
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded" role="alert">
                    <p class="font-bold">สำเร็จ!</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded" role="alert">
                    <p class="font-bold">เกิดข้อผิดพลาด</p>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Repair Form -->
            <form action="{{ route('repairs.store') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="repair_detail" class="block text-sm font-medium text-gray-700 mb-2">รายละเอียดการซ่อม</label>
                    <textarea id="repair_detail" name="repair_detail" rows="4"
                        class="w-full h-[40vh] px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:border-blue-500 transition duration-300"
                        required></textarea>
                </div>
                <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg transform hover:scale-105 transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    ส่งคำขอ
                </button>
            </form>
        </div>
    </div>
@endsection
</body>
</html>