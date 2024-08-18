<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        
        }
        .dashboard-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
            margin-top: 10px;
        }
        .box {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }
        .box h3 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }
        .box p {
            margin: 10px 0 0;
            font-size: 18px;
            color: #777;
        }
        .chart-container {
            display: flex;
            justify-content: space-around;
            margin-top: 30px;
            gap: 15px;
        }
        .chart-box {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 48%;
        }
        canvas {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    @extends('layouts.admin')
    @section('content')
    <div class="dashboard-container px-5">
        <div class="box">
            <h3>{{ $data['countCustomer'] }}</h3>
            <p>Customers</p>
        </div>
        <div class="box">
            <h3>{{ $data['countEmployee'] }}</h3>
            <p>Employees</p>
        </div>
        <div class="box">
            <h3>{{ $data['countProduct'] }}</h3>
            <p>Products</p>
        </div>
        <div class="box">
            <h3>{{ $data['countRepair_done'] }}</h3>
            <p>Repairs Done</p>
        </div>
        <div class="box">
            <h3>{{ $data['countRepair_inprogress'] }}</h3>
            <p>Repairs In Progress</p>
        </div>
        <div class="box">
            <h3>{{ $data['countRepair_pending'] }}</h3>
            <p>Repairs Pending</p>
        </div>
    </div>

    <div class="chart-container">
        <div class="chart-box">
            <canvas id="lineChart"></canvas>
        </div>
        <div class="chart-box">
            <canvas id="pieChart"></canvas>
        </div>
    </div>

    <script>
        const data = @json($data);

        // Line Chart
        const ctxLine = document.getElementById('lineChart').getContext('2d');
        const lineChart = new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: ['Customers', 'Employees', 'Products'],
                datasets: [{
                    label: 'Counts',
                    data: [data.countCustomer, data.countEmployee, data.countProduct],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: false,
                    pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                    pointBorderColor: 'rgba(75, 192, 192, 1)',
                    pointHoverBackgroundColor: 'rgba(75, 192, 192, 1)',
                    pointHoverBorderColor: 'rgba(75, 192, 192, 1)',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Pie Chart
        const ctxPie = document.getElementById('pieChart').getContext('2d');
        const pieChart = new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: ['Repairs Done', 'In Progress', 'Pending'],
                datasets: [{
                    label: 'Repair Status',
                    data: [data.countRepair_done, data.countRepair_inprogress, data.countRepair_pending],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(255, 99, 132, 0.6)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
    @endsection
</body>
</html>
