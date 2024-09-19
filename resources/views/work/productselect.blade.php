<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Product for Repair</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Kanit', sans-serif;
            background-color: #f3f4f6;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .card {
            border: 2px solid #e2e8f0;
            padding: 20px;
            width: 100%;
            max-width: 280px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
        }

        .card.selected {
            border-color: #3b82f6;
            background-color: #eff6ff;
            transform: scale(1.05);
        }

        .card h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: #1f2937;
        }

        .card p {
            margin-bottom: 8px;
            color: #4b5563;
        }

        .card input[type="number"] {
            margin-top: 10px;
            width: 100%;
            padding: 8px;
            border: 1px solid #e5e7eb;
            text-align: center;
        }

        .submit-btn {
            width: 100%;
            max-width: 300px;
            background-color: #3b82f6;
            color: white;
            padding: 15px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            text-align: center;
            margin-top: 30px;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #2563eb;
        }

        .hidden {
            display: none;
        }

        @media (max-width: 640px) {
            .card {
                padding: 15px;
                max-width: 200px;
            }

            .submit-btn {
                padding: 12px;
                font-size: 16px;
                margin-top: 20px;
            }
        }
    </style>
</head>

<body>
    @extends('layouts.employ')

    @section('content')
        <div class="p-20 h-[100vh] flex justify-center w-full">
            <div class="container mx-5">
                <div class="px-4 md:p-8 mb-6 h-[80vh] text-center">
                    <h1 class="text-2xl font-bold mb-6 text-[#373A40]">เลือกสินค้าสำหรับการซ่อม</h1>

                    <p class="mb-4 text-[#686D76]"><strong>รหัสการซ่อม:</strong> {{ $repair->repair_id }}</p>
                    <p class="mb-6 text-[#686D76]"><strong>รายละเอียดการซ่อม:</strong> {{ $repair->repair_detail }}</p>

                    <form action="{{ route('repair.updateProduct', $repair->repair_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="card-container grid gap-4 grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
                            @foreach ($product as $item)
                                <div class="card p-4 border border-[#686D76] rounded-md shadow-md text-[#373A40] bg-[#EEEEEE]"
                                    data-id="{{ $item->product_id }}">
                                    <div class="flex justify-center">
                                        @if ($item->product_image)
                                            <img src="{{ asset('/' . $item->product_image) }}" alt="Product Image"
                                                class="w-16 h-16 object-cover rounded-full">
                                        @else
                                            <span>No Image</span>
                                        @endif
                                    </div>
                                    <h3 class="font-bold text-lg mb-1">{{ $item->product_name }}</h3>
                                    <p class="mb-1">รหัสสินค้า: {{ $item->product_id }}</p>
                                    <p class="mb-2">จำนวนที่มีอยู่: {{ $item->product_qty }}</p>
                                    <input type="radio" name="product_id" value="{{ $item->product_id }}" class="hidden"
                                        {{ $repair->product_id == $item->product_id ? 'checked' : '' }}>
                                    <input type="number" name="unit_amount[{{ $item->product_id }}]"
                                        class="border border-[#686D76] rounded-md p-1 focus:ring-[#DC5F00]"
                                        placeholder="จำนวนที่ต้องการเบิก" min="1" max="{{ $item->product_qty }}">
                                </div>
                            @endforeach
                        </div>

                        <button type="submit"
                            class="submit-btn w-[100px] fixed top-[85%] right-2 bg-[#DC5F00] text-[#EEEEEE] font-bold py-2 px-4 rounded-md hover:bg-[#373A40] focus:outline-none focus:ring-2 focus:ring-[#DC5F00]">
                            ยืนยัน
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const cards = document.querySelectorAll('.card');
                const hiddenInputs = document.querySelectorAll('.hidden');

                cards.forEach(card => {
                    card.addEventListener('click', function() {
                        // Deselect all cards
                        cards.forEach(c => c.classList.remove('selected'));
                        hiddenInputs.forEach(input => input.checked = false);

                        // Select the clicked card
                        this.classList.add('selected');
                        this.querySelector('input[type="radio"]').checked = true;
                    });
                });

                // Automatically select the card if the radio button is already checked
                hiddenInputs.forEach(input => {
                    if (input.checked) {
                        input.closest('.card').classList.add('selected');
                    }
                });
            });
        </script>
    @endsection
</body>

</html>
