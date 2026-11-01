
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
{{-- <div id="divId" class="w-full flex flex-col justify-center items-center bg-white py-2 "> --}}
    <div id="divId" class="w-full flex flex-col items-stretch bg-white p-0 m-0">
        <div class="w-full p-0 pl-0 mx-auto">
            <div class="text-center border-b-2 text-sm py-2  mx-auto">

                <span class="text-2xl text-center">Invoice</span>
            </div>
            <div class="text-center border-b-2 text-sm py-2  mx-auto">

                <div class="text-4xl text-center text-lime-600">{{ $toko->namaToko }}</div>
                <div class="text-xl text-center text-lime-600">{{ $toko->alamattoko }}</div>
                <div class="text-sm text-center text-lime-600">{{ $toko->telepon }}</div>

            </div>
            <div class="w-auto flex flex-col justify-start items-center">
                <span class="text-sm"> Customer </span>

                <div>
                    <span class="text-sm">
                <label>Name :</label>
                        {{ $customer->nama ?? ""}}
                    </span>
                </div>
                <div class="max-w-[200px] break-words whitespace-normal">
                    <span class="text-sm">
                <label>Alamat :</label>
                        {{ $customer->Alamat  ?? ""}}
                    </span>
                </div>
                <div>
                    <span class="text-sm">
                <label>Telepon :</label>
                        {{ $customer->telepon1  ?? ""}}
                    </span>
                </div>
                <div>
                    <span class="text-sm">
                        <label>BatchId :</label>
                        #{{ $transaksi->batch_id ?? "" }}
                    </span>
                </div>
                <div>
                    <span class="text-sm">
                        <label>Total Qty:</label>
                        #{{ $totalQty }}

                    </span>
                </div>
            </div>

        </div>


        <div class="flex flex-col w-full">

            <div class="flex flex-col bg-white  justify-center items-center border-b-2">
                <table class="border-0" >
                    <thead>
                        {{-- <th class="px-4 py-2 text-sm">id.</th> --}}
                        <th class="px-2 py-2 text-sm text-left">Item</th>
                        {{-- <th class="px-4 py-2 text-sm">Description</th> --}}
                        {{-- <th class="px-2 py-2 text-sm">Qty</th> --}}
                        <th class="px-2 py-2 text-sm">Total</th>
                    </thead>
                    <tbody>
                        @foreach ($menu as $index =>$menus )

                        <tr class="py-2">
                            {{-- <td class="px-4 py-2 text-right text-sm">{{ $index+1 }}</td> --}}
                            {{-- <td class="px-2 text-left text-sm">{{ $menus->menu_id }}</td> --}}
                            <tr>
                                <td class="px-2 text-left text-sm">{{ $menus->qty }} x {{ $menus->description }}</td>
                            {{-- <td class="px-2 text-center text-sm">{{ $menus->qty }}</td> --}}
                                <td class="px-2 text-right text-sm">{{ number_format($menus->total,0,'.'.'.') }}</td>
                            </tr>
                        </tr>
                        @endforeach

                        <tr class="text-right">
                            {{-- <td></td> --}}
                            {{-- <td></td> --}}
                            {{-- <td></td> --}}
                            <td class="text-sm">Total:</td>
                            <td class="px-2 text-right text-sm"> {{ number_format($sumtotal,0,'.'.'.') ?? '' }}</td>
                        </tr>

                        <tr class="text-right">
                            {{-- <td></td> --}}
                            {{-- <td></td> --}}
                            {{-- <td></td> --}}
                            <td class="text-sm">Discount:</td>
                            <td class="px-2 text-right text-sm"> {{ number_format($diskon,0,'.'.'.') ?? '' }}</td>
                        </tr>

                        <tr class="text-right">
                            {{-- <td></td> --}}
                            {{-- <td></td> --}}
                            {{-- <td></td> --}}
                            <td class="text-sm">Ppn:</td>
                            <td class="px-2 text-right text-sm"> {{ number_format($Ppn,0,'.'.'.') ?? '' }}</td>
                        </tr>

                         <tr class="text-right">
                            {{-- <td></td> --}}
                            {{-- <td></td> --}}
                            {{-- <td></td> --}}
                            <td class="text-sm">Biaya Kirim:</td>
                            <td class="px-2 text-right text-sm"> {{ number_format($biayaKirim,0,'.'.'.') ?? '' }}</td>
                        </tr>
                         <tr class="text-right">
                            {{-- <td></td> --}}
                            {{-- <td></td> --}}
                            {{-- <td></td> --}}
                            <td class="text-sm">Total Tagihan:</td>
                            <td class="px-2 text-right text-sm underline decoration-2 underline-offset-4"> {{ $totalTagihan }}</td>
                        </tr>


                    </tbody>
                </table>
            </div>
            <div class="w-1/2 flex-row justify-center items-center" >
                <button
                onclick="printDiv('divId');"
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

