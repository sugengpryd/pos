{{-- <div class="py-2 bg-slate-300 h-[768px]"> --}}
<div class="pb-4 w-full max-w-full h-full bg-transparent">
    <div class="w-full p-4 mt-0 pl-8 bg-slate-500">
        <header class="ml-8">
            Point Of Sales
        </header>
    </div>
    {{-- notifikasi --}}
        <div
            x-data="{ show: false, message: '',type:'success',timer:null }"

            x-on:notify.window="
                message = $event.detail.message;
                type = $event.detail.type || 'success';
                {{-- bgColor = $event.detail.color ?? 'bg-green-500'; --}}
                show = true;
                clearTimeout(timer);
                timer = setTimeout(() => show = false, 2000);
                {{-- setTimeout(() => show = false, 2000); --}}
            "
            >
            <div
                x-show="show"
                x-transition
                :class="{
                    'bg-green-500': type === 'success',
                    'bg-red-600': type === 'error',
                    'bg-yellow-500': type === 'warning',
                    'bg-blue-500': type === 'info'
                }"
                class="fixed top-5 right-5 z-50 bg-green-500 text-white px-5 py-3 rounded-lg shadow-lg"
            >
                <span x-text="message"></span>
            </div>
        </div>
    {{-- POS Kategori --}}
    <div class="w-full h-auto mx-auto py-4">
        {{-- <span class="ml-20 text-center">Kategori</span> --}}

        <div class="
        flex
        justify-start
        items-center
        mt-2
        py-2
        h-50
        px-4
        gap-4
        overflow-x-auto
        bg-slate-300
        mx-auto
        outline
        outline-2
        outline-gray-400"
        >

            @foreach ($kategori as $index => $kategoris )
            <div class="flex flex-row ml-4" >
              <div class="p-2 bg-blue-400 text-center rounded-xl text-xs">
                <button
                    type="button"
                    style="background-image: url({{ asset('storage/' . $kategoris->image) }});"
                    wire:model.live='btnKategori.{{ $kategoris->id }}'
                    wire:click="getMenu('{{ trim($kategoris->description) }}')"
                    {{-- class="{{ $this->getItemColor($kategoris->id) }} w-[250px] h-[150px] p-4 text-white mx-auto rounded-xl" --}}
                    class="bg-center bg-cover bg-gray-600 w-[130px] min-h-[130px] p-2 text-white mx-auto rounded-xl break-words"
                    >
                </button>
                <br>
                    {{ $kategoris->description }}
            </div>


            </div>
            @endforeach

        </div>
    </div>

        <div class="grid md:grid-cols-2 md:max-h-[500px] gap-4 p-2 ">

            {{-- COLUMN 1 --}}
            {{-- <div class="px-2 ml-5 md:h-[600px] "> --}}
            <div class="px-2 ml-5 md:h-[600px] ">
                {{-- <div class="grid grid-cols-4 py-2 pr-2 gap-2 max-h-[450px] overflow-y-auto"> --}}
                {{-- <div class="flex flex-row py-2 pr-2 gap-2"> --}}
                <div class="w-full flex flex-row flex-wrap py-2 items-start pr-2 gap-2">

                    @foreach ($menus as $index => $menu)
                        <div class="flex flex-col items-center gap-3
                                     w-[120px] h-[160px] mb-2 px-2 py-2 bg-gray-400 rounded-xl
                                    text-black text-center text-xs shadow-xl">

                            <button
                                type="button"
                                style="background-image: url({{ asset('storage/' . $menu['image']) }});"
                                wire:click="btnadd(
                                    {{ Js::from($menu['menu_id']) }},
                                    {{ Js::from($menu['description']) }}
                                )"
                                class="shrink-0
                                    h-[100px] w-[100px] bg-yellow-700
                                    items-center justify-center text-center
                                    p-2 rounded-xl text-xs text-white bg-center bg-cover"
                                >
                                +
                            </button>

                            <span class="w-[120px] px-2 text-center text-xs
                                   text-black whitespace-normal break-words">
                             {{ $menu['description'] }}
                            </span>

                        </div>
                    @endforeach

                </div>
            </div>

            {{-- COLUMN 2 --}}
            {{-- <div class="bg-gray-200 flex flex-col  md:max-h-[550px] pt-0 pb-2 md:w-[96%] items-center text-xs"> --}}
            <div class="bg-gray-200 w-full min-w-full md:max-h-[900px] pt-0 pb-2 md:w-full items-center text-xs">
                    <div class="flex flex-row flex-wrap items-center p-2 gap-2 w-full">

                            {{-- Customer --}}
                            <button
                                wire:loading.attr="disabled"
                                wire:click="openModal('customer')"
                                class="bg-blue-700 text-white text-xs md:text-sm
                                    px-2 py-3 rounded shadow-lg
                                    hover:shadow-xl hover:shadow-teal-600
                                    {{ $openTransaksi ? 'underline decoration-white decoration-2 underline-offset-8' : '' }}
                                    ">
                                🧑‍🤝‍🧑 Customer
                            </button>

                            {{-- Delivery --}}
                            <button
                                wire:loading.attr="disabled"
                                wire:click="openmodaldelivery"
                                @disabled($voidMode)
                                @disabled(!$openTransaksi)
                                class="bg-blue-700 text-white text-xs md:text-sm
                                    px-2 py-3 rounded shadow-lg
                                    disabled:opacity-50 disabled:cursor-not-allowed
                                    disabled:hover:shadow-none
                                    hover:shadow-xl hover:shadow-teal-600">
                                🛵 Delivery
                            </button>
                            {{-- Discount --}}
                            <button
                                {{-- wire:modal.live="showmodalDiscount" --}}
                                wire:loading.attr="disabled"
                                wire:click="openmodaldiscount"
                                @disabled($voidMode)
                                @disabled(!$openTransaksi)

                                class="bg-blue-700 text-white text-xs md:text-sm
                                    px-2 py-3 rounded shadow-lg
                                    disabled:opacity-50 disabled:cursor-not-allowed
                                    disabled:hover:shadow-none
                                    hover:shadow-xl hover:shadow-teal-600">
                                🏷️ Discount
                            </button>

                            {{-- Simpan --}}
                            <button
                                wire:loading.attr="disabled"
                                wire:click="save()"
                                @disabled($voidMode)
                                @disabled(!$openTransaksi)

                                class="bg-blue-700 text-white text-xs md:text-sm
                                    px-2 py-3 rounded shadow-lg
                                    disabled:opacity-50 disabled:cursor-not-allowed
                                    disabled:hover:shadow-none
                                    hover:shadow-xl hover:shadow-teal-600">
                                💾 Simpan
                            </button>

                            {{-- DO --}}
                            <button
                                onclick="window.open('{{ route('Do', ['batch_Id'=>$transaksiBatchId,'customer_id'=>$customerid]) }}','_blank')"
                                 @disabled($voidMode)
                                 @disabled(!$openTransaksi)

                                class="bg-blue-700 text-white text-xs md:text-sm
                                    px-2 py-3 rounded shadow-lg
                                    disabled:opacity-50 disabled:cursor-not-allowed
                                    disabled:hover:shadow-none
                                    hover:shadow-xl hover:shadow-teal-600">
                                🖨️ DO
                            </button>

                            {{-- Invoice --}}
                            <button
                            onclick="window.open('{{ route('Struk', ['batch_Id'=>$transaksiBatchId,'customer_id'=>$customerid,'biayaKirim'=>$this->biayaKirim,'totalTagihan'=>$this->totalTagihan])}}','_blank')"
                                 @disabled($voidMode)
                                 @disabled(!$openTransaksi)

                                class="bg-blue-700 text-white text-xs md:text-sm
                                    px-2 py-3 rounded shadow-lg
                                    disabled:opacity-50 disabled:cursor-not-allowed
                                    disabled:hover:shadow-none
                                    hover:shadow-xl hover:shadow-teal-600">
                                🖨️ Invoice
                            </button>

                            {{-- Bayar --}}
                            <button
                                wire:loading.attr="disabled"
                                wire:click="openformBayar()"
                                 @disabled($voidMode)
                                @disabled(!$openTransaksi)

                                class="bg-lime-700 text-white text-xs md:text-sm
                                    px-2 py-3 rounded shadow-lg
                                    disabled:opacity-50 disabled:cursor-not-allowed
                                    disabled:hover:shadow-none
                                    hover:shadow-xl hover:shadow-lime-600">
                                💵 Bayar
                            </button>

                            {{-- Void --}}
                            <button
                                wire:click="openformVoid()"
                                class=" bg-lime-700 text-white text-xs md:text-sm
                                    px-2 py-3 rounded shadow-lg
                                    hover:shadow-xl hover:shadow-lime-600
                                    {{ $voidMode ? 'underline decoration-white decoration-2 underline-offset-8' : '' }}">
                                🧾❌ Void
                            </button>
                        </div>


                    <div id="printableArea" class=" w-full top-0 mr-0 max-h-60 overflow-y-auto text-center">
                        Daftar Pesanan

                        <table class="w-full top-0 mt-0">
                            <thead>
                                <th class="bg-white top-0 sticky z-20 text-center p-2 border-b-2 border-gray-700">Id</th>
                                <th class="bg-white top-0 sticky z-20 text-center p-2 border-b-2 border-gray-700">Menu Id </th>
                                <th class="bg-white top-0 sticky z-20 text-left p-2 border-b-2 border-gray-700">Description</th>
                                <th class="bg-white top-0 sticky z-20 text-center p-2 border-b-2 border-gray-700">
                                    Qty<br>
                                {{-- <span class="text-[10px] text-gray-700">{{ $this->itemQty ?? '0' }}</span> --}}
                                </th>
                                <th class="bg-white top-0 sticky z-20 text-center p-2 border-b-2 border-gray-700">Price</th>
                                <th class="bg-white top-0 sticky z-20 text-center p-2 border-b-2 border-gray-700">Total</th>
                                <th class="bg-white top-0 sticky z-20 text-center p-2 border-b-2 border-gray-700">Action</th>
                            </thead>
                            <tbody>
                                @foreach ($menustransaksi as $index =>$menu )

                                <tr
                                wire:key="item-{{ $index }}"
                                class="p-2"
                                >
                                    <td class="text-center border-b border-gray-400 text-xs">{{ $index+1}}</td>
                                    <td class="text-left border-b border-gray-400 text-xs">{{ $menu['menu_id'] }}</td>
                                    <td class="text-left border-b border-gray-400 text-xs">{{ $menu['description'] }}</td>
                                    <td class="text-center border-b border-gray-400 text-xs">{{ $menu['item_qty'] }}</td>
                                    <td class="text-right border-b border-gray-400 text-xs">{{ $menu['sellingPrice'] }}</td>
                                    <td class="text-right border-b border-gray-400 text-xs">{{ $menu['total']}}</td>
                                    {{-- <td class="text-right">{{ $menu['item_qty'] * $menu['sellingPrice']}}</td> --}}
                                    <td class="text-center py-2">
                                    @if(!$voidMode)
                                    <button
                                        wire:click="removeItem({{ $index }},'{{ $menu['menu_id'] }}')"
                                        class="text-right bg-red-400 py-2 px-2 rounded-xl text-xs"
                                        >
                                            Remove
                                    </button>
                                    @else
                                    <button
                                        wire:click="voidItem({{ $index }},'{{ $menu['menu_id'] }}','{{$this->transaksiBatchId}}')"
                                        class="text-right bg-red-400 py-2 px-2 rounded-xl text-xs"
                                        >
                                            Void
                                    </button>


                                    @endif
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>
                    {{-- <div class="flex flex-row justify-between items-center"> --}}
                    <div class="w-full">
                        <div class=" grid grid-cols-[58%_42%]"  mt-0 pt-4 text-[12px] ml-[5%] border-gray-900">

                            <div
                                 wire:model="selectCustomer"
                                 class="p-2 "
                                >
                                Customer : <br>
                                <span class="flex-col p-4 text-gray-600" >#{{ $customerid }}
                                    <span>{{$transaksiBatchId ? 'Batch:' . $transaksiBatchId :''  }}</span>
                                    <span
                                    wire:model.live='flaqTransaksi'
                                    >
                                    {{-- {{ $this->createBatch ? '' : 'in_' . $flaqTransaksi }} --}}
                                    @if($this->createBatch != '1')
                                        {{ '-' . $flaqTransaksi }}
                                    {{-- @else {{ '-', 'paid' }} --}}
                                    @endif
                                    </span>
                                </span><br>
                                <span class="flex-col p-4">{{ $selectCustomer }} </span><br>
                                <span class="flex-col p-4 text-wrap">{{ $alamat }} </span><br>
                                <span class="flex-col p-4">{{ $kota }} </span><br>
                                <span class="flex-col p-4">{{ $telepon1 }} </span><br>
                                <span class="flex-col p-4">{{ $telepon2 }} </span><br>
                            </div>

                                {{-- <div class=" flex flex-row justify-end items-center py-2 text-[12px] mr-2 border-t-2 border-gray-900"> --}}

                              {{-- {{ $this->itemQty ?? '0' }} --}}
                               <div class="py-2 pl-10 items-end justify-end text-xs mr-2 border-t-2 border-gray-900">
                                <span
                                wire:model='itemQty'
                                class="md:p-2 text-right"
                                    >
                                Qty.
                                    <span class="p-2 py-4 text-right"> {{ $this->itemQty}}</span>
                                </span><br>

                               {{-- <div class="py-2 pl-10 items-end justify-end text-xs mr-2 "> --}}
                                <span
                                wire:model='total'
                                class="md:p-2 text-right"
                                    >
                                Total.
                                    <span class="p-2 py-4 text-right"> {{'Rp.' . $total}}</span>
                                </span><br>

                                <span
                                wire:model='ppn'
                                class="md:p-2 text-right"
                                >
                                Tax.
                                <span class="p-2 text-right" > {{'Rp.' . $ppn }} </span>
                                </span><br>

                                <span
                                wire:model='diskon'
                                class="md:p-2 text-right"
                                >
                                Discount.
                                <span class="p-2 text-right">  {{'Rp.' . $diskon }}</span>
                                </span><br>

                                <span
                                wire:model.live="biayaKirim"
                                class="md:p-2 text-right">
                                Delivery
                                    <span
                                        class="p-2 text-right"
                                        >
                                         {{ 'Rp.' . number_format( (float) $biayaKirim,0,',','.') ?? '' }}

                                            <span
                                                wire:model="totaTagihan"
                                                class="p-2 text-right"
                                                >
                                                {{-- <span class="w-full h-px bg-blacks"></span><br> --}}
                                                <hr class="border-gray-400 my-2">
                                                <span class="md:p-2 text-right">
                                                Total Tagihan.
                                                    {{-- Rp. {{ number_format( (float) $totalTagihan,0,',','.') ?? '' }} --}}
                                                    {{ 'Rp '. $totalTagihan ?? '0' }}
                                                </span>
                                            </span>
                                        </span><br>

                              </div>
                            {{-- ======================================= --}}
                                @if(!empty($this->namaPenerima))
                                    <div class="grid-cols-1 p-2 text-xs -mt-5">
                                        Tujuan Pengiriman:

                                        <div class="pl-3">
                                            <label>Nama.</label>
                                            {{ $this->namaPenerima }}
                                        </div>

                                        <div class="pl-3">
                                            <label>Alamat.</label>
                                            {{ $this->alamatPenerima }}
                                        </div>

                                        <div class="pl-3">
                                            <label>Kota</label>
                                            {{ $this->kotaPenerima }}
                                        </div>

                                        <div class="pl-3">
                                        <label>Telepon</label>
                                            {{ $this->teleponPenerima }}
                                        </div>
                                    </div>
                                @endif
                        </div>

                    </div>
        </div>

    {{-- </div> --}}
</div>
     @if($showModal)
    <div class="fixed inset-0 z-50 w-full h-auto flex items-center justify-center bg-black bg-opacity-50">

        <div class="bg-white rounded-lg shadow-lg w-1/2 min-w-[360px] max-w-[900px] p-6 max-h-[400px] overflow-y-auto">

            <h3 class="text-lg font-semibold mb-4">
                {{ $customerMode ? 'Customer List' : 'Customer List' }}
            </h3>

            <form wire:submit.prevent="save" enctype="multipart/form-data">
                {{-- form fields --}}
                {{-- <div>{{ $Resultcustomers }}</div> --}}
                <div class="py-2 w-full gap-8">
                    <label  class="w-16">Customer ID</label>
                    <select
                    wire:model="selectedcustomer"
                    wire:change='pilihCustomer'
                    placeholder="Click here to get Menu Id"
                    class="w-full rounded-xl p-2 text-xs"
                    >
                    <option value="">Pilih Customer Name</option>
                    @foreach ($Resultcustomers as $index => $Resultcustomer )
                        {{-- @foreach ($cekTransaksi as $key => $cekTransaksis ) --}}
                             {{-- @if ( $Resultcustomer->id == $cekTransaksis->customer_Id) --}}
                    {{-- <option value="{{ $Resultcustomer->id }}">{{ $Resultcustomer->nama }} - {{ $cekTransaksis ? $cekTransaksis->count() :'' }}</option> --}}
                             {{-- @else --}}
                    <option class="text-xs" value="{{ $Resultcustomer->id }}">{{ $Resultcustomer->id }}.{{ $Resultcustomer->nama }}.#{{App\Models\Transaksi::get_batchId($Resultcustomer->id)}} . 🛒 {{ App\Models\Transaksi::basket($Resultcustomer->id) }}

                    </option>
                            {{-- @endif --}}

                            {{-- @endforeach --}}

                    @endforeach
                    </select>
                </div>
                <div class="flex flex-row gap-4 justify-center items-center">
                {{-- //====================this if customerAlamat --}}
                @if(filled($this->alamat))
                <button
                    type="button"
                    {{-- wire:click='closeopenModal' --}}
                    onclick="window.location.href='{{ route('Do', ['batch_Id'=>$transaksiBatchId,'customer_id'=>$customerid]) }}'"

                    class="bg-blue-400 px-4 py-2 shadow-lg hoevr:shadow-red-400 rounded-lg"
                    >
                    Print Delivery Order
                </button>
                @endif




                <button
                    type="button"
                    wire:click='closeopenModal'
                    class="bg-blue-400 px-4 py-2 shadow-lg hoevr:shadow-red-400 rounded-lg"
                    >
                    Confirm
                </button>

                </div>
            </form>
        </div>
    </div>
    @endif

    @if($formBayar)

        <div class="py-4 fixed inset-0 z-50 w-full h-auto flex items-center justify-center bg-black bg-opacity-50"
        {{-- <div  wire:ignore id="dragDiv" --}}
        {{-- class="cursor-move select-none fixed inset-0 z-50 w-full h-auto flex items-center justify-center bg-black bg-opacity-50" --}}
                {{-- style="left:50%; top:50%; transform:translate(-50%,-50%);" --}}
                >

            <div class="bg-white rounded-lg  shadow-lg w-1/2 min-w-[300px] max-w-[900px] p-4 overflow-y-auto">
              <div class="text-xl text-center underline">Pembayaran</div>
                <form wire:submit.prevent="bayar" enctype="multipart/form-data">
                <div>
                    <div  class="flex gap-4 py-2 border-b-red-400">
                        <Label class="w-[200px] mb-2">BatchID</Label><br>
                        <span class="bg-gray-400 w-full text-right  p-2 mt-2">{{ $transaksiBatchId  }}</span>
                    </div>
                    <div class="flex gap-4 py-2 border-b-red-400">
                        <label  class="w-[200px] mb-2">Total Tagihan:</label><br>
                        <span class="bg-gray-400 w-full text-right p-2 mt-2">Rp.{{ $totalTagihan }}</span>
                    </div>
                    <div class="flex gap-4 py-2 border-b-red-400">
                        <label class="w-[200px]">Nominal Pembayaran</label><br>
                        <span class="w-full">
                            {{-- <input type="text" class="text-xl w-full rounded-lg p-2"> --}}
                        <input
                            type="text"
                            x-data
                            x-on:input="
                                let value = $el.value.replace(/\D/g, '');
                                $el.value = value
                                    ? new Intl.NumberFormat('id-ID').format(value)
                                    : '';

                                $wire.set('nominalPembayaran', value);
                            "
                            class="w-full rounded-lg p-2 text-right"
                            placeholder="0"
                            value="{{ $totalTagihan }}"
                            >
                        </span>
                    </div>
                    <div class="flex gap-4 py-2 border-b-red-400">
                        <label class="w-[200px]">Tipe Pembayaran</label><br>
                        <span class="w-full">
                            <select
                            wire:model.live='tipePembayaran'
                            required
                            class="w-full rounded-lg p-2">
                            <option value="">Pilih Pembayaran</option>
                            <option value="cash">Cash</option>
                            <option value="transfer">Transfer</option>
                            <option value="qris">Qris</option>
                            </select>

                        </span>
                    </div>
                    <div class="mt-2">
                        <button
                            type="button"
                            wire:click="closeformBayar()" class="bg-gray-300 rounded-lg p-4"
                            >
                            Close
                        </button>
                        <button
                         {{-- wire:click="bayar" --}}
                         class="bg-blue-400 rounded-lg p-4">
                         Bayar
                        </button>
                    </div>

                </div>
              </form>
            </div>
        </div>
    @endif

    @if($openDelivery)
        <div class="py-8 fixed inset-0 z-50 w-full h-auto flex items-center justify-center bg-black bg-opacity-50"
        {{-- <div  wire:ignore id="dragDiv" --}}
        {{-- class="cursor-move select-none fixed inset-0 z-50 w-full h-auto flex items-center justify-center bg-black bg-opacity-50" --}}
                {{-- style="left:50%; top:50%; transform:translate(-50%,-50%);" --}}
                >
            <div class=" flex flex-col w-96 justify-start items-start text-left bg-white rounded-lg max-h-[90vh] shadow-lg min-w-[300px] max-w-[900px] p-2 overflow-y-auto ">
                <h3 class="text-lg font-semibold mb-4">Delivery</h3>

                <div class="h-full w-full bg-slate-300 p-4 ">

                {{-- <form wire:submit.prevent="bayar" enctype="multipart/form-data"> --}}
                <form enctype="multipart/form-data">
                {{-- <div class="flex flex-col">
                    <select
                    wire:model.live='pengirim'
                    class="p-2 text-xs rounded px-8 mx-auto m-2"

                    >
                        <option value='default'>Pengirim Default</option>
                        <option value='new'>Pengirim Custom</option>
                    </select>

                    @if ($this->pengirim == 'new')
                            <div class="w-full space-y-4 rounded-xl border-2 border-gray-300 bg-white p-4">

                                <div class="w-full">
                                    <label for="namaPengirim"
                                        class="mb-1 block text-sm font-semibold text-gray-700">
                                        Nama Pengirim
                                    </label>

                                    <input
                                        id="namaPengirim"
                                        type="text"
                                        wire:model.live="namaPengirim"
                                        placeholder="Masukkan nama pengirim"
                                        class="w-full rounded-lg text-xs border border-gray-300 px-3 py-2
                                            focus:border-blue-500 focus:outline-none focus:ring-2
                                            focus:ring-blue-200"
                                    >
                                </div>

                                <div class="w-full">
                                    <label for="alamatPengirim"
                                        class="mb-1 block text-xs font-semibold text-gray-700">
                                        Alamat Pengirim
                                    </label>

                                    <input
                                        id="alamatPengirim"
                                        type="text"
                                        wire:model.live="alamatPengirim"
                                        placeholder="Masukkan alamat pengirim"
                                        class="w-full rounded-lg border border-gray-300 px-3 py-2
                                            focus:border-blue-500 focus:outline-none focus:ring-2
                                            focus:ring-blue-200 text-xs"
                                    >
                                </div>
                                <div>
                                    <button
                                    type="button"
                                    wire:click="simpanPengirim"
                                    class="bg-blue-400 py-2 px-4 rounded">Save</button>
                                </div>

                            </div>
                        @else
                        @endif


                </div> --}}
                <div class="flex flex-col w-full justify-center items-center p-4">
                    <select
                    wire:model.live='penerima'
                    wire:change='Penerima()'
                    class=" rounded px-8 mx-auto m-2 text-xs"
                    >
                        <option value='default' class="px-2">Penerima Default</option>
                        <option value='new' class="px-2">Penerima Custom</option>
                    </select>


                        @if ($this->penerima == 'new')
                            <div class="w-full space-y-4 rounded-xl border-2 border-gray-300 bg-white p-4">

                                        <div class="w-full">
                                            <label for="namaPenerima"
                                                class="mb-1 block font-semibold text-gray-700 text-xs">
                                                ->Nama Penerima
                                            </label>

                                            <input
                                                id="namaPenerima"
                                                type="text"
                                                wire:model.live="namaPenerima"
                                                placeholder="Masukkan nama penerima"
                                                class="w-full rounded-lg border border-gray-300 px-3 py-2
                                                    focus:border-blue-500 focus:outline-none focus:ring-2
                                                    focus:ring-blue-200 text-xs"
                                            >
                                        </div>

                                        <div class="w-full">
                                            <label for="alamatPenerima"
                                                class="mb-1 block font-semibold text-gray-700 text-xs">
                                                ->Alamat Penerima
                                            </label>

                                            <input
                                                id="alamatPenerima"
                                                type="text"
                                                wire:model.live="alamatPenerima"
                                                placeholder="Masukkan alamat penerima"
                                                class="w-full rounded-lg border border-gray-300 px-3 py-2
                                                    focus:border-blue-500 focus:outline-none focus:ring-2
                                                    focus:ring-blue-200 text-xs"
                                            >
                                        </div>

                                        <div class="w-full">
                                            <label for="KotaPenerima"
                                                class="mb-1 block font-semibold text-gray-700 text-xs">
                                                ->Kota Penerima
                                            </label>

                                            <select
                                                id="KotaPenerima"
                                                {{-- type="text" --}}
                                                wire:model.live="kotaPenerima"
                                                wire:click="KotaPenerima"
                                                {{-- placeholder="Masukkan kota penerima" --}}
                                                class="w-full rounded-lg border border-gray-300 px-3 py-2
                                                    focus:border-blue-500 focus:outline-none focus:ring-2
                                                    focus:ring-blue-200 text-xs"
                                            >
                                            <option value="">Pilih Kota</option>
                                            <option value="JakSel">Jakarta Selatan</option>
                                            <option value="JakTim">Jakarta Timur</option>
                                            <option value="JakBar">Jakarta Barat</option>
                                            <option value="JakUt">Jakarta Utara</option>
                                            <option value="Bogor">Bogor</option>
                                            <option value="Depok">Depok</option>
                                            <option value="Tanggerang">Tanggerang</option>
                                            <option value="Bekasi">Bekasi</option>
                                        </select>
                                        </div>
                                        <div class="w-full">
                                                <label for="teleponPenerima"
                                                class="mb-1 block font-semibold text-gray-700 text-xs">

                                                ->Telepon Pengirim
                                                </label>
                                                <input
                                                id="teleponPenerima"
                                                type="text"
                                                wire:model.live='teleponPenerima'
                                                placeholder="Input Telepon Penerima"
                                                type="text"
                                                 class="w-full rounded-lg border border-gray-300 px-3 py-2
                                                    focus:border-blue-500 focus:outline-none focus:ring-2
                                                    focus:ring-blue-200 text-xs"
                                                >
                                        </div>
                                <div>
                                    <button
                                    type="button"
                                    wire:click="simpanPenerima"
                                    class="bg-blue-400 py-2 px-4 rounded text-xs">Save</button>
                                    <button></button>
                                </div>

                            </div>
                        @else

                        @endif

                </div>
                <div class="w-full">
                    <label for="BiayaKirim"
                        class="mb-1 block font-semibold text-gray-700 text-xs">
                        Biaya Kirim
                    </label>
                    <input
                        id="biayaKirim"
                        type="text"
                        wire:model.live="biayaKirim"
                        placeholder="Nominal Biaya Kirim"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2
                            focus:border-blue-500 focus:outline-none focus:ring-2
                            focus:ring-blue-200 text-xs"
                    >
                </div>

                    <button
                        type="button"
                        wire:click="closeopenDelivery()"
                        class="bg-red-400 p-2 rounded mt-2 text-xs"
                        >
                        Close
                        </button>
              </form>
              </div>
            </div>
        </div>


    @endif

    @if($showmodalDiscount)
    <div class="fixed inset-0 z-50 w-full h-screen flex items-center justify-center bg-black bg-opacity-50">

        <div class="bg-white w-full rounded-lg shadow-lg min-w-[350px] md:max-w-[400px] p-2 max-h-[600px]">

            <h3 class="text-lg font-semibold mb-4">
                {{ $discountMode ? 'Discount' : '' }}
            </h3>
            <div class="flex flex-row w-full bg-slate-300 p-4 min-w-[350px] justify-start items-center md:justify-between md:items-start ">
                <form wire:submit.prevent="save_discount" enctype="multipart/form-data">
                        <div class="flex-col w-full p-2 gap-1 text-xs">
                                <label class="text-bold" for="batchId">BatchId</label>
                                    <input
                                    wire:model.live="batchidDiscount"
                                    id="batchId" type="text"
                                    class="flex flex-col w-full flex-wrap rounded-lg text-xs p-2"
                                    >

                                <label class=" text-bold" for="customer">Customer</label>
                                    <input
                                    wire:model.live="customerDiscount"
                                    id="diskon" type="text"
                                    class="flex flex-col w-full flex-wrap rounded-lg text-xs p-2"
                                    >


                                <label class=" text-bold" for="totalTagihan">Total Tagihan</label>
                                    <input
                                    wire:model.live="totaltagihanDiscount"
                                    id="totalTagihan" type="text"
                                    class="flex flex-col w-full flex-wrap rounded-lg text-xs p-2"
                                    >
                        </div>
                            <div class="flex flex-col gap-2 mt-1 p-2 text-xs">
                                <label for="discountPersen">Discount %</label>
                                    <input
                                        {{-- wire:model.live="discountpersenDiscount" --}}
                                        {{-- wire:click="discount({{$this->discountpersenDiscount}})" --}}
                                        id="discountPersen"
                                        type="radio"
                                        wire:model.live="discounttype"
                                        value="persen"

                                        >
                                @if($divPersen)

                                <div wire:model.live="divPersen" class="">
                                <input type="text"
                                    wire:model.live="discountPersen"
                                    class=" p-2 rounded-lg text-xs"
                                    @focus="$el.select()"
                                    placeholder="Masukan persen Discount"
                                    >&nbsp%
                                </div>
                                @endif
                                <label for="discountNominal">Discount Rp</label>
                                    <input
                                    {{-- wire:model.live="discountnominalDiscount" --}}
                                    {{-- wire:click="discount({{$this->discountnominalDiscount}})" --}}
                                    id="discountNominal"
                                    type="radio"
                                    wire:model.live="discounttype"
                                    value="nominal"
                                    >
                                @if($divNominal)
                                <div wire:model.live="divNominal" class="">
                                    <input type="text"
                                    wire:model.live="discountNominal"
                                    class=" p-2 rounded-lg text-xs"
                                    @focus="$el.select()"
                                    placeholder="Masukan Nominal Discount"
                                    >&nbsprupiah
                                </div>
                                @endif

                            </div>

                                <div class="flex flex-col justify-start items-start">
                                <label for="discountAmount">Total Amount</label>
                                    <input
                                        wire:model.live="discountAmount"
                                        id="discountAmount"
                                        type="text"
                                        class="rounded-lg text-right"


                                >
                                </div>
                                 <div
                                    class="flex flex-row p-2 gap-4"
                                    >
                                    <button
                                    type="button"
                                    wire:click="closemodalDiscount"
                                    class="bg-slate-400 rounded-lg flex flex-col mt-2 w-1/4 text-xs text-center hover:bg-blue-700 p-2"
                                    >
                                        Exit
                                    </button>
                                    <button
                                    wire:click="applyDiscount"
                                    type="button"
                                    class="bg-blue-400 rounded-lg flex flex-col mt-2 w-1/4 text-xs text-center hover:bg-blue-700 p-2"
                                    >
                                        Apply
                                    </button>
                                </div>
                </form>
        </div>
    </div>
    @endif
@if($showmodalVoid)
    <div class="fixed inset-0 z-50 w-full h-screen flex items-center justify-center bg-black bg-opacity-50">

        <div class="bg-white rounded-lg shadow-lg w-1/2 min-w-[300px] max-w-[900px] p-6 max-h-[600px] overflow-y-auto">

            <h3 class="text-lg font-semibold mb-4">
                {{ $voidMode ? 'Void Paid Transaksi' : '' }}
            </h3>
            <div class="flex flex-row w-full min-w-[350px] justify-between items-center md:justify-between md:items-start ">
                <form wire:submit.prevent="" enctype="multipart/form-data">
                    <div class="flex flex-col w-full h-1/2">
                        <select
                        wire:change="select_voidBatchId()"
                        wire:model="selectedBatchId"
                        >
                            <option value="">Pilih Batch Id</option>
                            @foreach($this->voidBatchId as $batchid)
                            <option value="{{ trim($batchid->batch_id) }}">{{ trim($batchid->batch_id) }}</option>
                            @endforeach
                        </select>



                    </div>
                    <div class="flex flex-1">
                        <button
                        type="button"
                        wire:click="closeformVoid()"
                        class="bg-blue-300 rounded-lg mt-2 p-2"
                        > Exit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endif


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
<script>
document.addEventListener('DOMContentLoaded', () => {

    const box = document.getElementById('dragDiv');
    const header = document.getElementById('dragHeader');

    let dragging = false;
    let startX = 0;
    let startY = 0;
    let startLeft = 0;
    let startTop = 0;

    header.addEventListener('mousedown', (e) => {
        dragging = true;

        startX = e.clientX;
        startY = e.clientY;

        startLeft = box.offsetLeft;
        startTop = box.offsetTop;

        e.preventDefault();
    });

    document.addEventListener('mousemove', (e) => {
        if (!dragging) return;

        const x = startLeft + (e.clientX - startX);
        const y = startTop + (e.clientY - startY);

        box.style.left = `${x}px`;
        box.style.top = `${y}px`;
    });

    document.addEventListener('mouseup', () => {
        dragging = false;
    });

});
</script>
</div>
