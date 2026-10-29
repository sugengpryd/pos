<div class="py-4 w-full max-w-[1080px] mx-auto">
    <div class="flex flex-row px-4 ml-[5px] gap-3">
        <div clas="flex-row w-full justify-between items-center">
            <div
                x-data="{
                    show: false,
                    message: '',
                    type: 'success'
                }"
                x-on:notify.window="
                    message = $event.detail.message;
                    type = $event.detail.type ?? 'success';
                    show = true;
                    setTimeout(() => show = false, 3000);
                "
            >
                <div
                    x-show="show"
                    x-transition
                    x-cloak
                    class="fixed top-5 right-5 z-50 rounded-lg px-4 py-3 text-white shadow-lg"
                    :class="type === 'success' ? 'bg-green-600' : 'bg-red-600'"
                >
                    <span x-text="message"></span>
                </div>
            </div>
            {{-- <button
            wire:click="openModal"
            class=" text-sm bg-blue-300 p-2 hover:bg-blue-500 rounded-xl border border-spacing-2 border-blue-400">New Product</button> --}}
        </div>
        <div class="flex flex-col md:flex-row w-full justify-start items-start md:justify-end md:items-start gap-2 text-xs mb-2">

            <div class="flex flex-1 gap-4">
             <button
            wire:click="openModal"
            class=" text-xs bg-blue-300 p-2 hover:bg-blue-500 rounded-lg border border-spacing-2 border-blue-400">
            New Product
            </button>
            <button
            wire:click="openModalImport"
            wire:model="btnImport"
            class=" text-xs bg-blue-300 p-2 hover:bg-blue-500 rounded-lg border border-spacing-2 border-blue-400">
            Import Produk From excel
            </button>
            </div>


            <input type="text" placeholder="Search Produk"
                wire:model.live="filterSearch"
                class="p-2 rounded-lg text-xs">

            <select
                wire:model.live="filterUom"
                class="rounded-lg text-xs"
            >

                <option value="">Filter UOM </option>
                @foreach ($uom as $uoms )
                <option value="{{ $uoms->uom }}">{{ $uoms->uom }}</option>
                @endforeach
            </select>
            <select class="rounded-lg text-xs"
                wire:model.live="filterPricing"
            >
                <option value="">Filter Pricing </option>
                @foreach ($pricing as $prices )
                <option value="{{$prices->harga}}">{{$prices->harga}} </option>
                @endforeach

            </select>

            <select
                wire:model.live="filterFlaq"
                class="rounded-lg text-xs"
            >
                <option value="">Filter Flaq</option>
                <option value="1">1.Show</option>
                <option value="0">0.Hidden</option>


            </select>
        </div>


    </div>
    <div class="px-6" >
       Total: {{ $produk->count() }}
    </div>
    <div class="w-full max-w-[1080px] top-0 h-screen mx-auto mt-2 px-4 justify-start overflow-auto">

        <div class="flex flex-row justify-start items-center p-2">

        <table class=" py-2 w-full">
                <thead class="sticky py-0 top-0 bg-gray-400 z-55">
                    <tr>
                        <th class="text-xs sticky top-0 z-50 p-4 text-left">Id</th>
                        <th class="text-xs sticky top-0 z-50 p-4 text-left">Description</th>
                        <th class="text-xs sticky top-0 z-50 p-4 text-left">Uom</th>
                        <th class="text-xs sticky top-0 z-50 p-4 text-left">Base Price</th>
                        <th class="text-xs sticky top-0 z-50 p-4 text-center">Flaq</th>
                        <th class="text-xs sticky top-0 z-50 p-4 text-center">Action</th>
                    </tr>

                </thead>
            <tbody>
                <?php
                $flaq='';
                ?>
                @foreach ($produk as $produks )

                <tr class="border border-b-black">
                    <td
                    wire:model.live="id"
                    class="p-2 text-xs ">{{ $produks->id }}</td>
                    <td
                    wire:model.live="description"
                    class="p-2 text-xs ">{{ $produks->description}}</td>
                    <td
                    wire:model.live="uom"
                    class="p-2 text-xs ">{{ $produks->uom}}</td>
                    <td
                    wire:model.live="harga"
                    class="p-2 text-xs ">{{ $produks->harga}}</td>

                    <td class="p-2 text-xs text-center ">
                        {{ $produks->flaq == '1' ? 'Show':'Hidden' }}
                    </td>
                    <td class="p-2 text-xs text-center ">
                        <button
                            wire:click="editProduk({{ $produks->id }})"
                            class=" rounded-lg py-2  px-4 bg-blue-300 text-xs">Edit</button>
                        <button class=" rounded-lg py-2 px-4 bg-red-400 text-xs">Delete</button>

                    </td>

                </tr>
                 @endforeach

            </tbody>

        </table>
        </div>


    </div>

    {{-- Create / Edit Modal --}}
    @if($showModal)
    <div class="fixed inset-0 z-50 w-full h-auto flex items-center justify-center bg-black bg-opacity-50">

        <div class="bg-white rounded-lg shadow-lg w-full max-w-[700px] p-6 max-h-screen overflow-y-auto">

            <h3 class="text-lg font-semibold mb-4">
                {{ $produkId ? 'Edit Product' : 'Create New Produk' }}
            </h3>

            <form wire:submit.prevent="save" enctype="multipart/form-data">
                {{-- form fields --}}

                <div class="py-2 w-full gap-8">
                    <label  class="w-16">Product Description</label>
                    <input
                    wire:model="produk_description"
                    type="text"
                    class="w-full text-sm
                     rounded-xl p-2"
                    >
                </div>

                <div class="py-2 w-full gap-8">
                    <label class="w-16"> Uom</label>
                    <select
                    wire:model="produk_uom"
                    class="w-full text-sm
                     rounded-xl p-2"
                    >
                        <option value="">Select Uom</option>
                        @foreach ($master_uom as $index => $uom )
                        <option value="{{ $uom->uomkode}}" >{{ $uom->uomkode}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="py-2 w-full gap-8" >
                    <label class="w-16"> Base price</label>
                    <input
                    type="text"
                    wire:model="produk_harga"
                    class="w-full text-sm
                     rounded-xl p-2"
                    >
                </div>

                <div class="py-2 w-full gap-8">
                    <label class="w-16"> Visibility</label>
                    <select
                    wire:model.live="produk_visibility"
                    class="  text-sm rounded-xl py-2 px-4 "
                    >
                    <option value="1">Show</option>
                    <option value="0">Hidden</option>
                </select>
                </div>



                <div class="flex justify-end gap-2 mt-4">
                    <button
                        type="button"
                        wire:click="closeOpenModal"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded"
                    >
                        Cancel
                    </button>

                    <button
                        type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"
                    >
                        Save
                    </button>
                </div>

            </form>

        </div>
    </div>
    @endif
    {{-- Delete Confirmation Modal --}}
    @if ($showDeleteModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                <h3 class="text-lg font-semibold mb-4 text-red-600">Delete Expense</h3>
                <p class="text-sm text-gray-700 mb-6">
                    Are you sure you want to delete this expense? This action cannot be undone.
                </p>
                <div class="flex justify-end gap-2">
                    <button wire:click="closeDeleteModal"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                        Cancel
                    </button>
                    <button wire:click="delete"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    @endif

@if($modalImport)
    <div class="fixed inset-0 z-50 w-full h-auto flex items-center justify-center bg-black bg-opacity-50">

        <div class="bg-white rounded-lg shadow-lg w-full max-w-[700px] p-6 max-h-screen overflow-y-auto">

            <h3 class="text-lg font-semibold mb-4">
                 Import Data Produk
            </h3>

            <form wire:submit.prevent="importProduk" enctype="multipart/form-data">
                <input type="file"
                wire:model=file
                accept=".xlsx,.xls,.csv"
                class="block w-full border rounded p-2"
                >
                @error('file')
                <p class="text-red-600 text-sm">
                {{ $message }}
                </p>
                @enderror
                <div wire:loading wire:target="file">
                Uploading file...
                </div>
                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    wire:target="import"
                    class="bg-blue-600 text-white px-4 py-2 rounded
                   disabled:opacity-50"
                >
                   <span wire:loading.remove wire:target="import">
                    Import Excel
                   </span>

                    <span wire:loading wire:target="import">
                    Importing...
                    </span>
                </button>


                <div class="mt-2">
                    <button
                    type="button"
                    wire:click="closeModalImport"
                    class="rounded-lg p-2 bg-red-300"
                    >Exit</button>
                </div>

            </form>
        </div>
    </div>
@endif
</div>


<script>
document.addEventListener('livewire:init', () => {
    Livewire.on('focus-dp', () => {
        document.getElementById('dp').focus();
    });
});

function formatRupiah(el) {
    let angka = el.value.replace(/[^,\d]/g, '').toString();
    let split = angka.split(',');
    let sisa = split[0].length % 3;
    let rupiah = split[0].substr(0, sisa);
    let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        let separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    el.value = (split[1] != undefined ? rupiah + ',' + split[1] : rupiah);
}
</script>


</div>
