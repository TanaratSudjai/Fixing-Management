<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Customer Report</title>
</head>
<style>
    body {
        font-family: "Gill Sans", "Gill Sans MT", Calibri, "Trebuchet MS",
            sans-serif;
        text-align: center;
    }

    .table-re {
        display: flex;
        justify-content: center;
        gap: 15px;
        border: 1px solid black;
    }

    strong {
        font-size: 25px;
    }

    td {
        border-bottom: 1px solid black;
        padding: 15px;
    }
</style>

<body>
    <h1>Receipt</h1>
    <div class="table-re">
        <table>
            <thead>
                <tr>
                    <th>Receipt ID</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $receipt->repair_id }}</td>
                    <td>{{ $productData['product_name'] }}</td>
                    <td>{{ $productData['product_qty'] }}</td>
                    <td>{{ $productData['product_price'] }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <h1>
        {{ $productData['total_price'] }} <br />
        <strong> Thank you {{ $productData['user'] }} </strong>
    </h1>
</body>

</html>
