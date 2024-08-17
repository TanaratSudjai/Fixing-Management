<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work Repair List</title>
    @vite('resources/css/app.css')
</head>

<body>
    <h1 class="p-5 bg-blue-600 text-xl text-white">Work Repair List</h1>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Repair ID
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer
                        Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Repair
                        Detail</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status ID
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unit fix
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created
                        At</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Updated
                        At</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($workrepair as $repair)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $repair->repair_id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $repair->customer->name }}</td>
                        <td class="px-6 py-4">{{ $repair->repair_detail }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $repair->status->status_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $repair->product->product_name ?? 'ยังไม่เบิกสินค้า' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $repair->unit_amount ?? 'ยังไม่เบิกสินค้า' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $repair->created_at }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $repair->updated_at }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($repair->product != null)
                                <form action="{{ route('repair.updateStatus', $repair->repair_id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status_id" value="2">
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                                        เเจ้งลูกค้า
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('repair.selectproduct', $repair->repair_id) }}"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                                    เบิกอะไหล่
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <br>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
          <thead class="bg-gray-100">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Repair ID</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer Name</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Repair Detail</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status ID</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created At</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Updated At</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
            @foreach ($inprogress as $repairInpogress)
              <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap">{{ $repairInpogress->repair_id }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $repairInpogress->customer->name }}</td>
                <td class="px-6 py-4">{{ $repairInpogress->repair_detail }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $repairInpogress->status->status_name }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $repairInpogress->product->product_name ?? 'ยังไม่เบิกสินค้า' }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $repairInpogress->created_at }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $repairInpogress->updated_at }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <form action="{{ route('repair.done', $repairInpogress->repair_id) }}" method="POST" class="inline">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status_id" value="3">
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                      ซ่อมสำเร็จ
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
</body>

</html>
