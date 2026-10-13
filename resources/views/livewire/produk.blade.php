<div class="py-4 w-full max-w-[1080px] mx-auto">
    <div class="flex flex-row px-4 ml-[5px] gap-12">
        <div clas="flex-col w-auto justify-left">
            <button
            wire:click="openModal"
            class=" text-sm bg-blue-300 p-2 hover:bg-blue-500 rounded-xl border border-spacing-2 border-blue-400">New Product</button>
        </div>
        <div class="flex flex-row w-full justify-end items-end gap-8">
            <input type="text" placeholder="Search Produk"
                wire:model.live="filterSearch"
                class="p-2 rounded-xl">

            <select
                wire:model.live="filterUom"
                class="rounded-xl"
            >

                <option value="">Filter UOM </option>
                @foreach ($uom as $uoms )
                <option value="{{ $uoms->uom }}">{{ $uoms->uom }}</option>
                @endforeach
            </select>
            <select class="rounded-xl"
                wire:model.live="filterPricing"
            >
                <option value="">Filter Pricing </option>
                @foreach ($pricing as $prices )
                <option value="{{$prices->harga}}">{{$prices->harga}} </option>
                @endforeach

            </select>

            <select
                wire:model.live="filterFlaq"
                class="rounded-xl"
            >
                <option value="">Filter Flaq</option>
                <option value="1">1.Show</option>
                <option value="0">0.Hidden</option>


            </select>
        </div>


    </div>
    <div class="w-full max-w-[1080px] top-0 h-screen mx-auto mt-2 px-4 justify-start overflow-auto">
        <table class=" px-4 py-2 w-full">
            <p>Total: {{ $produk->count() }}</p>
                <thead class="sticky py-0 top-0 bg-gray-300 z-55">
                    <tr>
                        <th class=" sticky top-0 z-50 p-4 text-left">Id</th>
                        <th class=" sticky top-0 z-50 p-4 text-left">Description</th>
                        <th class=" sticky top-0 z-50 p-4 text-left">Uom</th>
                        <th class=" sticky top-0 z-50 p-4 text-left">Base Price</th>
                        <th class=" sticky top-0 z-50 p-4 text-center">Flaq</th>
                        <th class=" sticky top-0 z-50 p-4 text-center">Action</th>
                    </tr>

                </thead>
            <tbody>
                <?php
                $flaq='';
                ?>
                @foreach ($produk as $produks )

                <tr>
                    <td
                    wire:model.live="id"
                    class="p-2 text-sm ">{{ $produks->id }}</td>
                    <td
                    wire:model.live="description"
                    class="p-2 text-sm ">{{ $produks->description}}</td>
                    <td
                    wire:model.live="uom"
                    class="p-2 text-sm ">{{ $produks->uom}}</td>
                    <td
                    wire:model.live="harga"
                    class="p-2 text-sm ">{{ $produks->harga}}</td>

                     @if($produks->flaq == "1")
                        <?php $flaq = "Show" ?>

                    @else
                        <?php $flaq = "hidden" ?>
                    @endif
                    <td class="p-2 text-sm text-center ">{{ $flaq}}</td>
                    <td class="p-2 text-sm text-center ">
                        <button
                            wire:click="editProduk({{ $produks->id }})"
                            class=" rounded-xl py-2  px-4 bg-yellow-700">Edit</button>
                        <button class=" rounded-xl py-2 px-4 bg-red-700">Delete</button>

                    </td>

                </tr>
                 @endforeach

            </tbody>

        </table>


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
