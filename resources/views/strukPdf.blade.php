
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>

    @page{
        width: 210mm;

    }


    .no-print {
        display: none;
    }
   .straight-line {
    border: none;
    border-top: 1px solid gray;
    width: 100%;
    margin: 8px 0;
    }
    .tableClass{
        width:100%;
        margin-left: 10px;

        align-items: center;
        align-content: center;

        border:red 2px !important;
        border:2px !important;
    }
    #td{
        padding-left: 5px;
        padding-right: 5px;
    }
    .textAlign{
        text-align: right;
    }
    .divTable{
        width:100%;
    }
    .watermark {
    position: fixed;
    top: 40%;
    left: 50%;
    transform: translate(-50%, -50%) rotate(-45deg);

    font-size: 60px;
    font-weight: bold;
    color: rgba(128, 128, 128, 0.15);

    white-space: nowrap;
    z-index: -1;
}


    </style>
</head>
<body>
<div>


    <div style="color: green;font-size:36px">
        {{ $toko->namaToko }}
    </div>

    <div class="text-sm text-center text-lime-600">
                    {{ $toko->alamattoko }}
    </div>
    <div class="text-sm text-center text-lime-600">
                    {{ $toko->telepon }}
    </div>

        <hr  class="straight-line">

    <div class="text-sm">
            Customer
    </div>

    <div>
                <label>Name :</label>
                {{ $customer->nama ?? ""}}
    </div>
    <div>
            <label>Alamat :</label>
                {{ $customer->Alamat  ?? ""}}
    </div>
    <div>
                <label>Telepon :</label>
                        {{ $customer->telepon1  ?? ""}}
    </div>


    <div>
                <label>BatchId :</label>
                        #{{ $transaksi->batch_id ?? "" }}
    </div>
    <div>
                <label>Total Qty:</label>
                        #{{ $totalQty }}
    </div>


    <div class="divTable straight-line">


        <table class="tableClass" >
        <thead>
            <tr>
                <th style="text-align: left">Item</th>
                <th style="text-align: right">Total</th>
            </tr>
        </thead>

        <tbody>
            <div class="watermark">Invoice</div>
            @foreach ($menu as $menus)
                <tr">
                    <td class="straight-line" style="text-align: left">
                        {{ $menus->qty }} x {{ $menus->description }}
                    </td>
                    <td style="text-align: right">
                        {{ number_format($menus->total, 0, ',', '.') }}
                    </td>

                </tr>
            @endforeach
            <tr>
            <td colspan="2" style="margin-left: 0;">
              <hr class="straight-line">

            </td>
            </tr>

                    <tr>
                <td style="text-align: right">Total:</td>
                <td style="text-align: right">
                    {{ number_format($sumtotal, 0, ',', '.') }}
                </td>

            </tr>

            <tr>
                <td style="text-align: right">Discount:</td>
                <td style="text-align: right">
                    {{ number_format($diskon ?? 0, 0, ',', '.') }}
                </td>

            </tr>

             <td style="text-align: right">PPN:</td>
             <td style="text-align: right">
                    {{ number_format($Ppn ?? 0, 0, ',', '.') }}
                </td>

            </tr>

            <tr>
                <td style="text-align: right">Biaya Kirim:</td>
                <td style="text-align: right">
                    {{ number_format($biayaKirim ?? 0, 0, ',', '.') }}
                </td>

            </tr>

            <tr>
                <td style="text-align: right">
                    Total Tagihan:
                </td>
                <td style="text-align: right">
                    {{ $totalTagihan }}
                </td>

            </tr>
        </tbody>
        </table>
    </div>
</div>

</body>
</html>

