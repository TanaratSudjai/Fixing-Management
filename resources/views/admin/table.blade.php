<table class="text-sm text-center text-black w-full">
    <thead class="bg-gray-200 top-0">
        <tr>
            <th class="text-center p-2 px-2 gap-2 w-1/12">รหัสแจ้งซ่อม</th>
            <th class="text-center p-2 px-2 gap-2 w-1/12">ชื่อลูกค้า</th>
            <th class="text-center p-2 px-2 gap-2 w-1/12">รายละเอียด</th>
            <th class="text-center p-2 px-2 gap-2 w-1/12">พนักงาน</th>
            <th class="text-center p-2 px-2 gap-2 w-1/12">สถานะ</th>
            <th class="text-center p-2 px-2 gap-2 w-1/12">ดำเนินการ</th>
        </tr>
    </thead>
    <tbody class="text-center space-y-2">
        @foreach ($repairs as $repair)
            <tr class="even:bg-gray-50">
                <td class="p-2">{{ $repair->repair_id }}</td>
                <td class="p-2">{{ $repair->customer->name }}</td>
                <td class="p-2">{{ $repair->repair_detail }}</td>
                <td class="p-2">{{ $repair->employee->name ?? 'กรุณาเลือกพนักงาน' }}</td>
                <td class="p-2">{{ $repair->status->status_name ?? 'N/A' }}</td>
                <td class="p-2">
                    @if ($repair->status_id == 4)
                        <a href="" class="text-[#EEEEEE] px-3 bg-[#686D76]">เรียบร้อย</a>
                    @elseif($repair->status_id == 3)
                        <a href="" class="text-[#EEEEEE] px-3 bg-[#DC5F00]">กำลังซ่อม</a>
                    @elseif($repair->status_id == 2)
                        <a onclick="toggleEditEmployeeModal({{ $repair->repair_id }}, '{{ $repair->repair_detail }}', {{ $repair->employee_id ?? 'null' }})"
                            class="text-[#DC5F00] bg-[#EEEEEE]">เปลี่ยนพนักงาน</a>
                    @else
                        <a onclick="toggleEditEmployeeModal({{ $repair->repair_id }},'{{ $repair->repair_detail }}')"
                            class="text-[#DC5F00] bg-[#EEEEEE]">เลือกพนักงาน</a>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
