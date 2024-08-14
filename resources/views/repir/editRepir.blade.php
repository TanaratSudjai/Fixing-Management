<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
    <div class="container">
        <h1>Edit Repair</h1>
    
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    
        <form action="{{ route('repairs.update', $repair->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="repair_detail">Repair Detail</label>
                <input type="text" class="form-control" id="repair_detail" name="repair_detail" value="{{ $repair->repair_detail }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Repair</button>
        </form>
    </div>
</body>
</html>