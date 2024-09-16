<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <style>
        @font-face {
            font-family: 'THSarabun';
            src: url('{{ storage_path('fonts/THSarabunNew.ttf') }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        body {
            font-family: 'THSarabun', sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
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
