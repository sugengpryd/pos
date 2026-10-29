<div class="py-4">
    <div class="w-full flex-col p-2 ">
        <div class="flex flex-col md:flex-row w-full justify-center items-start gap-2 ">

            <div class="flex flex-col w-25 justify-center items-center">
                <select
                wire:model.live="FilterBatchId"
                class="w-full rounded-xl text-xs">
                    <option value="">Filter BatchId</option>
                    @foreach ($batchId as $batch )
                    <option value="{{ $batch }}">{{ $batch }}</option>
                    @endforeach

                </select>
            </div>

            <div class="flex flex-col w-25 justify-center items-center">
                <select
                wire:model.live="FilterMenu"
                class="w-full rounded-xl text-xs"
                >
                    <option value="">Filter Menu</option>
                    @foreach ($menuId as $menu )
                    <option value="{{ $menu }}">{{App\Models\Menu::get_name($menu)}}</option>
                    {{-- <option value="{{ $menu }}">{{$menu}}</option> --}}
                    @endforeach
                </select>
            </div>

            <div class="flex flex-col w-25 justify-center items-center">
                <select
                wire:model.live="FilterCustomer"
                class="w-full rounded-xl text-xs">
                    <option value="">Filter Customer</option>
                    @foreach ($customerId as $customerids )

                    <option value="{{ $customerids }}">{{ App\Models\Customer::getCustomer($customerids) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col w-25 justify-center items-center">
                <select
                wire:model.live="FilterStatus"
                class="w-full rounded-xl text-xs">
                    <option value="">Filter Status</option>
                    @foreach ($status as $status )

                    <option value="{{ $status }}">{{ $status }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col w-25 justify-center items-center">
                <select
                wire:model.live="FilterDate"
                class="w-full rounded-xl text-xs">
                    <option value="">Filter Date</option>
                    @foreach ($created_at as $created_at )

                    <option value="{{ $created_at }}">{{ $created_at}}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col w-20 justify-end items-wrap" >
                    <button
                    onclick="printDiv('printArea')"
                    class="bg-blue-400  p-2 text-xs px-4 rounded-lg shadow-lg shadow-blue-400"
                    >Print
                </button>
            </div>

        </div>

    </div>

    <div id="printArea" class="w-full p-2">
                {{-- <div class="flex flex-col min-w-[350px] top-0 md:flex-col h-screen justify-start items-start md:justify-center md:items-center px-2 mt-2 pb-10 overflow-auto"> --}}
                <div class="flex flex-col h-[600px] px-8 min-w-[350px] top-0 overflow-auto">
                    <table class="w-full ">
                        <thead class="sticky py-0 top-0 bg-gray-400 z-55">
                            <th class="sticky top-0 bg-gray-400 py-1 px-4 text-sm">Id</th>
                            <th class="sticky top-0 bg-gray-400 py-1 px-4 text-sm">Batch_id</th>
                            <th class="sticky top-0 bg-gray-400 py-1 px-4 text-sm text-left">Menu Description</th>
                            <th class="sticky top-0 bg-gray-400 py-1 px-4 text-sm text-center">Qty
                                <br>
                                <span class="text-gray-500"> {{ $qty}}</span>
                            </th>
                            <th class="sticky top-0 bg-gray-400 py-1 px-4 text-sm text-right">Selling Price</th>
                            <th class="sticky top-0 bg-gray-400 py-1 px-4 text-right text-sm">Total
                                <br>
                                <span class="text-gray-500"> {{ number_format($total),0,'.'.'.' }}</span>
                            </th>
                            <th class="sticky top-0 bg-gray-400 py-1 px-4 text-sm text-left">Customer</th>
                            <th class="sticky top-0 bg-gray-400 py-1 px-4 text-sm text-center">Status</th>
                            <th class="sticky top-0 bg-gray-400 py-1 px-4 text-sm">Created At</th>
                        </thead>
                        <tbody>
                            @foreach($transaksi as $index => $transaksis)
                            <tr class="border border-b-black">
                                <td class="py-2 px-2 text-xs">{{ $index+1 }}</td>
                                <td class="py-2 px-2 text-xs">{{ $transaksis->batch_id }}</td>
                                <td class="py-2 px-2 text-xs">{{ App\Models\Menu::get_name($transaksis->menu_id) }}</td>
                                <td class="py-2 px-2 text-xs text-center">{{ $transaksis->qty }}</td>
                                <td class="py-2 px-2 text-xs text-right">{{ $transaksis->sellingPrice }}</td>
                                <td class="py-2 px-2 text-xs text-right">{{ $transaksis->total }}</td>
                                <td class="py-2 px-2 text-xs text-left">
                                    {{ App\Models\Customer::getCustomer($transaksis->customer_Id,'customer_sqlite') }}
                                </td>
                                <td class="py-2 px-2 text-xs text-center">{{ $transaksis->flaq }}</td>
                                <td class="py-2 px-2 text-xs text-center">{{ $transaksis->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        </div>

    <script>
        function printDiv(divId) {
            let printContents = document.getElementById(divId).innerHTML;
            let originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;

            // Optional: reload page to restore original JS bindings/listeners
            location.reload();
        }
</script>

</div>

