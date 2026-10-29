
<div class="py-4">
    <div class="w-full bg-gray-300 p-4 rounded-lg">

        <!-- Header -->
        <div class="mb-4">
            <h3 class="text-xl font-bold text-gray-800">
                Discount Transaksi
            </h3>
        </div>

        <!-- Search and Filter -->
        <div class="w-full p-4 rounded-lg">

            <div class="flex flex-col sm:flex-row w-full gap-4">
                <input
                    type="text"
                    class=" min-w-0 rounded-lg border border-gray-300 p-2"
                    placeholder="Search Batch ID..."
                >

                <select class="w-full sm:w-48 shrink-0 rounded-lg border border-gray-300 p-2">
                    <option value="">Select Status</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>

            <!-- Discount Table -->
            <div class=" w-full max-h-[400px] mt-4 py-2 rounded-lg overflow-auto">

                <table class="w-full border-collapse text-sm text-left">
                    <thead class="sticky top-0 z-55 bg-gray-800 text-white">
                        <tr>
                            <th class="border p-3">Id</th>
                            <th class="border p-3">Batch Id</th>
                            <th class="border p-3 text-right">Total</th>
                            <th class="border p-3 text-right">Discount</th>
                            <th class="border p-3">Flaq</th>
                            <th class="border p-3">Created At</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white">
                        @forelse ($Discount as $index => $diskon)
                            <tr class="hover:bg-gray-100">
                                <td class="border p-3">
                                    {{ $index + 1 }}
                                </td>

                                <td class="border p-3 whitespace-nowrap">
                                    {{ $diskon->batch_id }}
                                </td>

                                <td class="border p-3 text-right whitespace-nowrap">
                                    {{ number_format($diskon->sellingPrice, 0, ',', '.') }}
                                </td>

                                <td class="border p-3 text-right whitespace-nowrap">
                                    {{ number_format($diskon->discount, 0, ',', '.') }}
                                </td>

                                <td class="border p-3">
                                    {{ $diskon->flaq }}
                                </td>

                                <td class="border p-3 whitespace-nowrap">
                                    {{ $diskon->created_at }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="border p-4 text-center text-gray-500">
                                    No discount transactions found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
