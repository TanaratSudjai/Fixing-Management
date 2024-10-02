<!DOCTYPE html>
<html>

<head>
    <title>Welcome</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
</head>

<style>
    body {
        font-family: 'Kanit', sans-serif;
    }
</style>

<body>
    @extends('layouts.admin')

    @section('content')
        <div class="container-sm">
            <h1>ยินดีต้อนรับสู่บัญชีที่ใช้งานอยู่ของคุณ</h1>
            <p>คุณสามารถเข้าถึงแอปพลิเคชันได้อย่างสมบูรณ์</p>

            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

        </div>
    @endsection
</body>

</html>
