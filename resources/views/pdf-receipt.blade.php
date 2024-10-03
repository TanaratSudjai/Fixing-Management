<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Report</title>
    <style>
        body {
            font-family: 'TH Sarabun', 'THSarabunNew', sans-serif, Arial, Helvetica;
            line-height: 1.6;
            color: #333;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 30px;
        }
        table {
            font-family: 'TH Sarabun', 'THSarabunNew', sans-serif;
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #3498db;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #e0e0e0;
        }
    </style>
</head>
<body>
    <h1>Receipt</h1>
    
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
                <td>{{ $receipt->repair_id }}</td> <!-- Assuming product ID is needed -->
                <td>{{ $productData['product_name'] }}</td>
                <td>{{ $productData['product_qty'] }}</td>
                <td>{{ $productData['product_price'] }}</td>
            </tr>
        </tbody>
    </table>
    <div class="flex justify-between">

        <h1>Total Amount {{ $productData['total_price'] }}</h1>
        
    </div>
    <h1 class="justify">Thank you : {{ $productData['user'] }}</h1>
</body>
</html>