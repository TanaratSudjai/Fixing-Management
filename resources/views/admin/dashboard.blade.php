<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
</head>

<style>
    body,
    html {
        overflow: hidden;
        height: 100%;
    }

    .custom-scroll {
        max-height: calc(100vh - 140px);
        overflow-y: auto;
    }

    .custom-scroll::-webkit-scrollbar {
        width: 8px;
    }

    .custom-scroll::-webkit-scrollbar-thumb {
        background-color: #DC5F00;
        border-radius: 8px;
    }

    .custom-scroll::-webkit-scrollbar-track {
        background-color: #f1f1f1;
    }

    .custom-scroll div:hover {
        background-color: #f5f5f5;
    }
</style>

<body class="bg-[#EEEEEE] font-kanit">
    @extends('layouts.admin')
    @section('content')
        <div class="space-y-4 px-4 pb-20 custom-scroll">
            <div class="container mx-auto mt-5 flex flex-col gap-3 md:flex-row md:flex-wrap md:justify-between p-5">
                <div class="flex-1 p-8 bg-[#fff] rounded-md shadow-md hover:shadow-lg transition-shadow duration-300">
                    <h3 class="text-[#DC5F00] text-3xl font-semibold">{{ $data['countCustomer'] }}</h3>
                    <p class="text-[#373A40]">จำนวนลูกค้า</p>
                </div>
                <div class="flex-1 p-8 bg-[#fff] rounded-md shadow-md hover:shadow-lg transition-shadow duration-300">
                    <h3 class="text-[#DC5F00] text-3xl font-semibold">{{ $data['countEmployee'] }}</h3>
                    <p class="text-[#373A40]">จำนวนพนักงาน</p>
                </div>
                <div class="flex-1 p-8 bg-[#fff] rounded-md shadow-md hover:shadow-lg transition-shadow duration-300">
                    <h3 class="text-[#DC5F00] text-3xl font-semibold">{{ $data['countProduct'] }}</h3>
                    <p class="text-[#373A40]">สินค้า</p>
                </div>
            </div>

            <div class="container mx-auto gap-4 p-5 flex flex-col md:flex-row md:flex-wrap md:justify-between">
                <div class="chart-box bg-white h-[50vh] p-5 rounded-md shadow-md flex-1">
                    <canvas id="lineChart"></canvas>
                </div>
                <div class="chart-box bg-white h-[50vh] p-5 rounded-md shadow-md flex-1 mt-4 md:mt-0">
                    <canvas id="pieChart"></canvas>
                </div>
            </div>

            <div class="container mx-auto flex flex-col gap-3 md:flex-row md:flex-wrap md:justify-between p-5">
                <div class="flex-1 p-8 bg-[#fff] rounded-md shadow-md hover:shadow-lg transition-shadow duration-300">
                    <h3 class="text-[#DC5F00] text-3xl font-semibold">{{ $data['countRepair_done'] }}</h3>
                    <p class="text-[#373A40]">งานซ่อมที่เสร็จสิ้น</p>
                </div>
                <div class="flex-1 p-8 bg-[#fff] rounded-md shadow-md hover:shadow-lg transition-shadow duration-300">
                    <h3 class="text-[#DC5F00] text-3xl font-semibold">{{ $data['countRepair_inprogress'] }}</h3>
                    <p class="text-[#373A40]">งานซ่อมที่กำลังดำเนินการ</p>
                </div>
                <div class="flex-1 p-8 bg-[#fff] rounded-md shadow-md hover:shadow-lg transition-shadow duration-300">
                    <h3 class="text-[#DC5F00] text-3xl font-semibold">{{ $data['countRepair_pending'] }}</h3>
                    <p class="text-[#373A40]">งานซ่อมที่รอดำเนินการ</p>
                </div>
            </div>

            <script>
                const data = @json($data);

                const ctxLine = document.getElementById('lineChart').getContext('2d');
                const lineChart = new Chart(ctxLine, {
                    type: 'line',
                    data: {
                        labels: ['ลูกค้า', 'พนักงาน', 'สินค้า', 'รายงานเเจ้งซ่อม', 'กำลังซ่อม', 'ซ้อมเสร็จเเล้ว'],
                        datasets: [{
                            label: 'จำนวน',
                            data: [data.countCustomer, data.countEmployee, data.countProduct, data
                                .countRepair_pending, data.countRepair_inprogress, data.countRepair_done
                            ],
                            borderColor: '#DC5F00', // Line color
                            borderWidth: 2,
                            fill: true,
                            backgroundColor: 'rgba(220, 95, 0, 0.2)', // Line fill color with transparency
                            tension: 0.4,
                            pointBackgroundColor: '#373A40', // Points background color
                            pointBorderColor: '#EEEEEE', // Points border color
                            pointHoverBackgroundColor: '#EEEEEE', // Points background color on hover
                            pointHoverBorderColor: '#DC5F00', // Points border color on hover
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            x: {
                                ticks: {
                                    font: {
                                        family: 'Kanit',
                                        size: 14,
                                        color: '#DC5F00' // X-axis labels color
                                    }
                                }
                            },
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    font: {
                                        family: 'Kanit',
                                        size: 14,
                                        color: '#DC5F00' // Y-axis labels color
                                    }
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                labels: {
                                    font: {
                                        family: 'Kanit',
                                        size: 14,
                                        color: '#DC5F00' // Legend labels color
                                    }
                                }
                            }
                        }
                    }
                });

                // Pie Chart
                const ctxPie = document.getElementById('pieChart').getContext('2d');
                const pieChart = new Chart(ctxPie, {
                    type: 'pie',
                    data: {
                        labels: ['งานซ่อมที่เสร็จสิ้น', 'กำลังดำเนินการ', 'รอดำเนินการ'],
                        datasets: [{
                            label: 'Repair Status',
                            data: [data.countRepair_done, data.countRepair_inprogress, data.countRepair_pending],
                            backgroundColor: [
                                '#DC5F00', // Segment 1 (งานซ่อมที่เสร็จสิ้น)
                                '#686D76', // Segment 2 (กำลังดำเนินการ)
                                '#373A40' // Segment 3 (รอดำเนินการ)
                            ],
                            hoverOffset: 10,
                            borderWidth: 2,
                            borderColor: '#EEEEEE', // White border
                            hoverBorderColor: '#000' // Black border on hover
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                labels: {
                                    font: {
                                        family: 'Kanit',
                                        size: 14
                                    },
                                    color: '#DC5F00' // Legend label color
                                }
                            }
                        }
                    }
                });
            </script>
        </div>
    @endsection
</body>

</html>
