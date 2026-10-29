<div class="py-4">
    <div class="w-full px-4">
        <div class="mb-4 " >
            <header>
                <h3 class="text-xl font-bold text-gray-800">Payment</h3>
            </header>

        </div>
    </div>
    <div class="flex flex-col justify-start items-start px-4  ">
        <div class="flex flex-row justify-start items-start mb-2 gap-4">
            <input type="text"
             class="rounded-lg text-xs"
            >
            <select class="rounded-lg text-xs">
                <option>Filter</option>
                <option></option>
            </select>
        </div>
        <div class="flex w-full flex-row justify-start items-center">
            <table class="w-full" >
                <thead class="sticky top-0 z-55 bg-gray-800 text-white" >
                    <th class="py-2">Id</th>
                    <th class="py-2">BatchId</th>
                    <th class="py-2">Total </th>
                    <th class="py-2">Discount</th>
                    <th class="py-2">Tax</th>
                    <th class="py-2">Grand Total</th>
                    <th class="py-2">Payment Type</th>
                    <th class="py-2">flaq</th>
                    <th>Created At</th>
                </thead>
                <tbody>
                    @foreach ($payment as $index => $payments )

                    <tr class="border border-b-gray-400 text-xs">
                        <td class="px-2 py-2 text-center">{{ $index+1 }}</td>
                        <td class="px-2 py-2 text-center">{{ $payments->batch_id }}</td>
                        <td class="px-2 py-2 text-center">{{ $payments->total}}</td>
                        <td class="px-2 py-2 text-center">{{ $payments->discount }}</td>
                        <td class="px-2 py-2 text-center">{{ $payments->pph }}</td>
                        <td class="px-2 py-2 text-center">{{ $payments->grandtotal }}</td>
                        <td class="px-2 py-2 text-center">{{ $payments->tipe_payment }}</td>
                        <td class="px-2 py-2 text-center">{{ $payments->flaq }}</td>
                        <td class="px-2 py-2 text-center">{{ $payments->created_at }}</td>

                    </tr>

                    @endforeach


                </tbody>
            </table>
        </div>

    </div>



</div>
