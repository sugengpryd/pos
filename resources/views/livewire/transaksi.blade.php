<div class="py-4">
    <div class="w-full mx-auto px-20 ">
        <div class="flex flex-row justify-wrap items-center gap-3 ">

            <div class="w-1/4">
                <select
                wire:model.live="FilterBatchId"
                class="w-full rounded-xl text-xs">
                    <option value="">Filter BatchId</option>
                    @foreach ($batchId as $batch )
                    <option value="{{ $batch }}">{{ $batch }}</option>
                    @endforeach

                </select>
            </div>

            <div class="w-1/4">
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

            <div class="w-1/4">
                <select
                wire:model.live="FilterCustomer"
                class="w-full rounded-xl text-xs">
                    <option value="">Filter Customer</option>
                    @foreach ($customerId as $customerids )

                    <option value="{{ $customerids }}">{{ App\Models\Customer::getCustomer($customerids) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-1/4">
                <select
                wire:model.live="FilterStatus"
                class="w-full rounded-xl text-xs">
                    <option value="">Filter Status</option>
                    @foreach ($status as $status )

                    <option value="{{ $status }}">{{ $status }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-1/4">
                <select
                wire:model.live="FilterDate"
                class="w-full rounded-xl text-xs">
                    <option value="">Filter Date</option>
                    @foreach ($created_at as $created_at )

                    <option value="{{ $created_at }}">{{ $created_at}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <button
                onclick="printDiv('printArea')"
                class="bg-blue-400 p-2 text-xs px-4 rounded-lg shadow-lg shadow-blue-400"
                >Print
            </button>
            </div>
        </div>
    </div>
    <div id="printArea" class="w-full md:w-full flex h-full justify-center items-center px-4 mx-auto pt-5 pb-10">
        <div class="printHeader flex flex-row ml-6" style="display: none">Data Trasaksi

        </div>
        <table class="h-600 overflow-auto">
            <thead>
                <th class="sticky top-0 bg-slate-300 py-1 px-4 text-sm">Id</th>
                <th class="sticky top-0 bg-slate-300 py-1 px-4 text-sm">Batch_id</th>
                <th class="sticky top-0 bg-slate-300 py-1 px-4 text-sm">Menu_id</th>
                <th class="sticky top-0 bg-slate-300 py-1 px-4 text-sm text-center">Qty
                    <br>
                    <span class="text-gray-500"> {{ $qty}}</span>
                </th>
                <th class="sticky top-0 bg-slate-300 py-1 px-4 text-sm">Selling Price</th>
                <th class="sticky top-0 bg-slate-300 py-1 px-4 text-right text-sm">Total
                    <br>
                    <span class="text-gray-500"> {{ number_format($total),0,'.'.'.' }}</span>
                </th>
                <th class="sticky top-0 bg-slate-300 py-1 px-4 text-sm">Customer Id</th>
                <th class="sticky top-0 bg-slate-300 py-1 px-4 text-sm">Status</th>
                <th class="sticky top-0 bg-slate-300 py-1 px-4 text-sm">Created At</th>
            </thead>
            <tbody>
                @foreach($transaksi as $index => $transaksis)
                <tr>
                    <td class="py-2 border-b-2 px-8 text-xs">{{ $index+1 }}</td>
                    <td class="py-2 border-b-2 px-8 text-xs">{{ $transaksis->batch_id }}</td>
                    <td class="py-2 border-b-2 px-8 text-xs">{{ App\Models\Menu::get_name($transaksis->menu_id) }}</td>
                    <td class="py-2 border-b-2 px-8 text-xs" text-center>{{ $transaksis->qty }}</td>
                    <td class="py-2 border-b-2 px-8 text-xs text-right">{{ $transaksis->sellingPrice }}</td>
                    <td class="py-2 border-b-2 px-8 text-xs text-right">{{ $transaksis->total }}</td>
                    <td class="py-2 border-b-2 px-8 text-xs">{{ App\Models\Customer::getCustomer($transaksis->customer_Id) }}</td>
                    <td class="py-2 border-b-2 px-8 text-xs">{{ $transaksis->flaq }}</td>
                    <td class="py-2 border-b-2 px-8 text-xs">{{ $transaksis->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
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

