<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Customer Report</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<style>
    body {
        font-family: "Gill Sans", "Gill Sans MT", Calibri, "Trebuchet MS", sans-serif;
        text-align: center;
    }

    .table-re {
        padding-top: 5px;
        padding-bottom: 5px;
        display: flex;
        justify-content: center;
        gap: 15px;
        border: 1px solid black;
    }

    table {
        margin: 0 auto; /* Center the table itself */
        border-collapse: collapse;
        width: 80%; /* Adjust width as needed */
    }

    th, td {
        padding: 15px;
        text-align: center; /* Horizontal centering */
        vertical-align: middle; /* Vertical centering */
    }
    td {
        border-bottom: 1px solid black;
        padding-bottom: 5px;
    }

    th {
        font-weight: bold;
        background-color: #ffffff;
    }

    tbody tr:nth-child(even) {
        background-color: #ffffff; /* Optional: For alternating row colors */
    }
</style>

<body>
    <h1>Receipt</h1>
    <div class="table-re">
        <table>
            <thead>
                    <th>Receipt ID</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
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
        <strong> Total Amount {{ $productData['total_price'] }} </strong><br />
        <strong> Thank you {{ $productData['user'] }} </strong>
    </h1>
</body>

</html>
