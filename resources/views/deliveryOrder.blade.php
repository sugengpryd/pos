
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
    @media print {
        .no-print {
            display: none !important;
        }
    }

    </style>
</head>
<div id="divId" class="w-full flex flex-row bg-white py-2 border-2 ml-5 ">
        <div class=" w-auto p-1  pl-4">
            <div class="text-left border-b-2 text-sm py-2  mr-['65%']">

                <span class="text-xl text-left">Delivery Orders</span>
            </div>
            <div class="text-left border-b-2 text-sm py-2  mr-['65%']">

                <span class="text-xl text-left text-lime-600">Nazta Pudding</span>
            </div>
            <span class="text-sm font-bold"> Customer : </span>
                <div>
                    <span class="text-xs">
                        <label>BatchId :</label>
                        #{{ $transaksi->batch_id ?? "" }}
                    </span>
                </div>

                <div>
                    <span class="text-xs bold">
                <label>Name :</label>
                        {{ $customer->nama ?? ""}}
                    </span>
                </div>
                <div class="max-w-[200px] break-words whitespace-normal">
                    <span class="text-xs">
                <label>Alamat :</label>
                        {{ $customer->Alamat  ?? ""}}
                    </span>
                </div>
                <div>
                    <span class="text-xs">
                <label>Telepon :</label>
                        {{ $customer->telepon1  ?? ""}}
                    </span>
                </div>

                <div>
                    <span class="text-xs">
                        <label>Total Qty:</label>
                        #{{ $totalQty ?? ""}}

                    </span>
                </div>
                <div>
                    <span class="text-xs">
                        <label>Order Date:</label>
                        #{{ $transaksi->updated_at ?? "" }}

                    </span>
                </div>

                @if($pengiriman)

                    <div class="text-xs mt-2">
                        <span class="text-sm font-bold">Penerima :</span><br>
                        Nama:{{ $pengiriman->toName }}<br>
                        Alamat:{{ $pengiriman->toAlamat }}<br>
                        Kota: {{ $pengiriman->toKota }}<br>
                        Telpon: {{ $pengiriman->toNumber }}<br>

                        {{-- {{ $penerima->BiayaKirim }}  --}}
                        {{-- {{ $penerima->flaq }}   --}}
                        {{-- {{ $penerima->created_at }}  --}}
                        {{-- {{ $penerima->updated_at }}  --}}

                    </div>

                @endif

        </div>
        <div class="w-1/4 pl-8  text-sm m-0">


            {{-- <div class="text-left text-sm py-2  mr-['65%']">

                <span class="text-lg text-left text-lime-600">Nazta Pudding</span>
            </div> --}}
        </div>
</div>
<div>
        {{-- @foreach ($menu as $index =>$menus ) --}}
        <div class="w-full bg-white  px-2 py-1 ml-5 ">
            <div class=" bg-white border-b-2">
                <table class="border-0" >
                    <thead>
                        {{-- <th class="px-4 py-2 text-xs">id.</th> --}}
                        <th class="px-4 py-2 text-xs text-left">Item</th>
                        {{-- <th class="px-4 py-2 text-xs">Description</th> --}}
                        <th class="px-4 py-2 text-xs">Qty</th>
                        {{-- <th class="px-4 py-2 text-xs">Total</th> --}}
                    </thead>
                    <tbody>
                        @foreach ($menu as $index =>$menus )

                        <tr class="px-2 py-4 ">
                            {{-- <td class="px-4 py-2 text-right text-xs">{{ $index+1 }}</td> --}}
                            <td class="px-4 text-left text-xs">{{ $index+1 }}.{{ $menus->menu_id }}</td>
                                <tr class="border-b border-gray-400">
                                    <td class="px-4 text-left text-xs">{{ $menus->description }}</td>
                                    <td class="px-4 text-right text-xs">{{ $menus->qty }}</td>
                            {{-- <td class="px-2 py-2 text-right text-xs">{{ number_format($menus->total,0,'.'.'.') }}</td> --}}
                                </tr>
                        </tr>
                        @endforeach
                        <tr class="text-right">
                            <td></td>
                            {{-- <td></td> --}}
                            {{-- <td></td> --}}
                            {{-- <td>Total:</td> --}}
                            {{-- <td class="px-2 py-2 text-right text-xs"> {{ number_format($sumtotal,0,'.'.'.') }}</td> --}}

                        </tr>


                    </tbody>
                </table>
            </div>
            <div class="w-1/2 flex-row justify-center items-center" >
                <button
                onclick="window.print();"
                class="no-print bg-blue-400 py-2 px-6 rounded-lg">
                Print

                </button>
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
</html>

