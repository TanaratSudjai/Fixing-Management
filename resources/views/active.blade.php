<!DOCTYPE html>
<html>

<head>
    <title>Welcome</title>
</head>

<body>
    @extends('layouts.admin')

    @section('content')
        <div class="container-sm">
            <h1>Welcome to your active account</h1>
            <p>You have full access to the application.</p>

            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

        </div>
    @endsection
</body>

</html>
