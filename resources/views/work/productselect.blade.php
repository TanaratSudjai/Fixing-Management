<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Product for Repair</title>
    <style>
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
        }

        .card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            width: 200px;
            cursor: pointer;
            text-align: center;
            transition: transform 0.2s ease-in-out;
        }

        .card.selected {
            border-color: #007bff;
            background-color: #e9f7ff;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .hidden {
            display: none;
        }
    </style>
</head>

<body>
    <h1>Select Product for Repair</h1>

    <p><strong>Repair ID:</strong> {{ $repair->repair_id }}</p>
    <p><strong>Repair Detail:</strong> {{ $repair->repair_detail }}</p>
    <p><strong>Current Product ID:</strong> {{ $repair->product_id }}</p>

    <form action="{{ route('repair.updateProduct', $repair->repair_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card-container">
            @foreach ($product as $item)
                <div class="card" data-id="{{ $item->product_id }}">
                    <h3>{{ $item->product_name }}</h3>
                    <p>Product ID: {{ $item->product_id }}</p>
                    <input type="radio" name="product_id" value="{{ $item->product_id }}" class="hidden"
                        {{ $repair->product_id == $item->product_id ? 'checked' : '' }}>
                    <p>{{ $item->product_qty }}</p>
                </div>
                <input type="number" name="unit_amount[{{ $item->product_id }}]" placeholder="จำนวนต้องการเบิก">            @endforeach
        </div>

        <button type="submit">Update Product</button>
    </form>

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
</body>

</html>
