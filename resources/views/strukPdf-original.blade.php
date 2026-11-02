
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>


    .no-print {
        display: none;
    }


    </style>
</head>
<body>

                <div class="text-2xl text-center text-lime-600">{{ $toko->namaToko }}</div>
                <div class="text-sm text-center text-lime-600">{{ $toko->alamattoko }}</div>
                <div class="text-sm text-center text-lime-600">{{ $toko->telepon }}</div>


                <span class="text-sm"> Customer </span>

                <label>Name :</label>
                        {{ $customer->nama ?? ""}}
                <label>Alamat :</label>
                        {{ $customer->Alamat  ?? ""}}
                <label>Telepon :</label>
                        {{ $customer->telepon1  ?? ""}}

                <label>BatchId :</label>
                        #{{ $transaksi->batch_id ?? "" }}
                <label>Total Qty:</label>
                        #{{ $totalQty }}





                <table class="border-0 w-full" >
                    <thead>
                        <th class="px-2 py-2 text-xs text-left">Item</th>
                        <th class="px-4 py-2 text-xs">Total</th>
                    </thead>
                    <tbody>
                        @foreach ($menu as $index =>$menus )

                        <tr class="py-2">
                            <tr>
                                <td class="px-4 text-left text-xs">{{ $menus->qty }} x {{ $menus->description }}</td>
                                <td class="px-4 text-right text-xs">{{ number_format($menus->total,0,'.'.'.') ?? '0' }}</td>
                            </tr>
                        </tr>
                        @endforeach

                        <tr class="text-right">
                            <td class="text-xs">Total:</td>
                            <td class="px-2 text-right text-xs"> {{ number_format($sumtotal,0,'.'.'.') ?? '0' }}</td>
                        </tr>

                        <tr class="text-right">
                            <td class="text-xs">Discount:</td>
                            <td class="px-2 text-right text-xs">
                                @if(isset($diskon))
                                {{ number_format($diskon,0,'.'.'.')}}
                                @else
                                0
                                @endif
                            </td>
                        </tr>

                        <tr class="text-right">
                            <td class="text-xs">Ppn:</td>
                            <td class="px-2 text-right text-xs"> {{ number_format($Ppn,0,'.'.'.') ?? '0' }}</td>
                        </tr>

                         <tr class="text-right">
                            <td class="text-xs">Biaya Kirim:</td>
                            <td class="px-2 text-right text-xs">
                                @if(isset($biayaKirim))
                                {{ number_format($biayaKirim,0,'.'.'.') }}</td>
                                @else
                                0
                                @endif

                         </tr>
                         <tr class="text-right">
                            <td class="text-xs">Total Tagihan:</td>
                            <td class="px-2 text-right text-xs underline decoration-2 underline-offset-4"> {{ $totalTagihan ?? ''}}</td>
                        </tr>


                    </tbody>
                </table>
            </div>
            <div class="w-full flex-row justify-center text-center items-center mx-auto mt-2" >

                <a
                    href="{{ route('downloadPdf', ['batch_Id' => $transaksi->batch_id,'customer_id'=>$customer->id]) }}"
                    class="no-print inline-block bg-blue-500 px-6 py-2 rounded-lg">
                    Download pdf
                </a>
s            </div>
        </div>



</div>
</body>
</html>

