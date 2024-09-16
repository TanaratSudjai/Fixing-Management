<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'THSarabun', sans-serif;
        }
    </style>



</head>

<body>
    <h1>รายงานสินค้า</h1>
    <table>
        <thead>
            <tr>
                <th>ชื่อสินค้า</th>
                <th>ราคา</th>
                <th>วันที่เพิ่ม</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($product_report as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
