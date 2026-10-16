<div class="py-4 w-full max-w-[1080px] mx-auto">
    <div class="flex flex-row px-2 ml-[5px] gap-8">
        <div class="flex-col w-full justify-left">
            <button
            wire:click="openModal"
            class="text-sm bg-blue-300 w-24 p-2 hover:bg-blue-500 rounded-xl border border-spacing-2 border-blue-400">New Menu</button>
        </div>
        <div class="flex w-full gap-8">
            <div class="flex flex-row w-full justify-end items-end">
                <input type="text" placeholder="Search Produk"
                    wire:model.live="filterSearch"
                    class="rounded-xl"
                    >
            </div>
        </div>
    </div>
    <div class="w-full max-w-[1080px] top-0 h-screen mx-auto mt-2 px-4 justify-start overflow-auto">
        <table class=" px-4 py-2 w-full">
            <p>Total: {{ $menu?->count() ?? '0' }}</p>
                <thead class="sticky py-0 top-0 bg-gray-300 z-55">
                    <tr>
                        <th class=" sticky top-0 z-50 p-4 text-left">Id</th>
                        {{-- <th class=" sticky top-0 z-50 p-4 text-left">Menu Id</th> --}}
                        <th class=" sticky top-0 z-50 p-4 text-left">Description</th>
                        {{-- <th class=" sticky top-0 z-50 p-4 text-left">Product name</th> --}}
                        <th class=" sticky top-0 z-50 p-4 text-left">Qty</th>
                        <th class=" sticky top-0 z-50  text-center">Uom</th>
                        <th class=" sticky top-0 z-50  text-center">Kategori</th>
                        <th class=" sticky top-0 z-50 p-4 text-right">Selling Price</th>
                        <th class=" sticky top-0 z-50 p-4 text-center">flaq</th>
                        <th class=" sticky top-0 z-50 p-4 text-center">Action</th>
                    </tr>

                </thead>
            <tbody>
                <?php
                $flaq='';
                ?>
                @foreach ($menu as $menus )

                <tr>
                    <td
                    wire:model.live="id"
                    class="p-2 text-sm border-b-2 ">{{ $menus->id }}</td>

                    <td
                    wire:model.live="description"
                    class="p-2 text-sm border-b-2 ">{{ $menus->description}}</td>

                    {{-- <td
                    wire:model.live="uom"
                    class="p-2 text-sm ">{{ App\Models\Produk::getprodukName($menus->produk_id)}}</td> --}}

                    <td
                    wire:model.live="item_qty"
                    class="p-2 text-sm  border-b-2text-center ">{{ $menus->item_qty}}</td>

                    <td
                    wire:model.live="uom"
                    class="p-2 text-sm  border-b-2text-xl-center ">{{ $menus->uom}}</td>

                    <td
                    wire:model.live="kategori"
                    class="p-2 text-sm border-b-2 text-xl-center ">{{ $menus->kategori}}</td>

                    <td
                    wire:model.live="harga"
                    class="p-2 text-sm border-b-2 text-right">{{ $menus->sellingPrice}}</td>

                     if($menus->flaq == "1")
                        <?php $flaq = "Show" ?>

                    else
                        <?php $flaq = "hidden" ?>
                    endif
                    <td
                    wire:model="menu_visibility"
                    class="p-2 text-sm border-b-2 text-center ">{{ $flaq}}</td>
                    <td class="p-2 text-sm border-b-2 text-center ">
                        <button
                            wire:click="editMenu({{ $menus->id }})"
                            class=" rounded-xl py-2  px-4 bg-yellow-700">Edit</button>
                        <button class=" rounded-xl py-2 px-4 bg-red-700">Delete</button>

                    </td>

                </tr>
                 @endforeach

            </tbody>

        </table>


    </div>

    @if($showModal)
    <div class="fixed inset-0 z-50 w-full h-auto flex items-center justify-center bg-black bg-opacity-50">

        <div class="bg-white rounded-lg shadow-lg w-full min-w-[600px] max-w-[900px] p-6 max-h-screen overflow-y-auto">

            <h3 class="text-lg font-semibold mb-4">
                {{ $editMode ? 'Edit Menu' : 'Create New Menu' }}
            </h3>

            <form wire:submit.prevent="save" enctype="multipart/form-data">
                {{-- form fields --}}

                <div class="py-2 w-full gap-8">
                    <label  class="w-16">Menu ID</label>
                    <input
                    wire:model="menuId"
                    x-on:dblclick="$wire.getRandomId()"
                    type="text"
                    placeholder="Click here to get Menu Id"
                    class="w-full text-sm rounded-xl p-2 {{ $editMode ? 'bg-gray-200' : '' }}"

                     @disabled($menuId != '')
                    {{-- {{ $menuId ? 'disabled:disabled' : '' }}))" --}}
                    >
                </div>


                <div class="py-2 w-full gap-8">
                    <label  class="w-16">Menu Description</label>
                    <input
                    wire:model="menu_description"
                    type="text"
                    class="w-full text-sm
                     rounded-xl p-2"
                    >
                </div>

                <div class="py-2 w-full gap-8">
                    <label  class="w-16">Menu Kategori</label>
                    <select
                    wire:model.live="menu_kategori"
                    type="text"
                    class="w-full text-sm
                     rounded-xl p-2"
                     required
                    >
                    <option value="">Pilih Menu kategori</option>
                    @foreach ($kategori as $kategoris )

                    <option value="{{ $kategoris->description }}">{{ $kategoris->description }}</option>
                    {{-- <option value="pasta">Pasta</option> --}}
                    {{-- <option value="camilan">Camilan</option> --}}
                    @endforeach

                </select>

                </div>

                <div class="py-2 w-full gap-8">
                    <label class="w-16">Uom</label>
                    <select
                    wire:model="menu_uom"
                    class="w-full text-sm
                     rounded-xl p-2"
                    >
                        <option value="">Select Uom</option>
                    @foreach ($master_uom as $index => $uoms )
                        <option value="{{ $uoms->uomkode }}">{{ $uoms->uomkode }}</option>

                    @endforeach

                    </select>
                </div>

                <div class="py-2 w-full gap-8">
                    <label class="w-16">Qty</label>
                    <input
                    type="text"
                    wire:model.live="menu_qty"
                    class="w-full text-sm
                     rounded-xl p-2"
                    >
                </div>


                <div class="py-2 w-full gap-8" >
                    <label class="w-16"> Selling Price</label>
                    <input
                    type="text"
                    wire:model="menu_harga"
                    class="w-full text-sm
                     rounded-xl p-2"
                    >
                </div>

                <div class="flex gap-4">
                    <div class="flex flex-row justify-start items-start">
                        <select
                        wire:model.live="selectProduk"
                        wire:change="selectedProduk"
                        class="p-2 rpunded-xl border-blue-400 rounded-xl"
                        >
                            <option value=""> Pilih Produk</option>
                            @foreach ($produk as $produks )
                            <option value="{{ $produks->id }}">{{ $produks->description }}</option>

                            @endforeach
                        </select>

                    </div>
                    <div class="flex flex-row w-full h-auto justify-end">
                        <table class="w-full">
                            <thead class="bg-gray-400">
                                {{-- <th class="p-2 ">id</th> --}}
                                <th class="bg-gray-400 p-2 text-sm">ProdukID</th>
                                <th class="bg-gray-400 p-2 text-sm ">Description</th>
                                <th class="bg-gray-400 p-2 text-sm">Uom</th>
                                <th class="bg-gray-400 p-2 text-sm">Qty</th>
                                <th class="bg-gray-400 p-2 text-sm">Base Price</th>
                                <th class="bg-gray-400 p-2 text-sm">Action</th>
                            </thead>
                            <tbody>
                                @if (empty($items))
                                    <tr>
                                        <td colspan="6"
                                        class="w-full text-center p-4"
                                        >Belum ada item</td>
                                    </tr>
                                @else
                                @foreach ($items as $index => $item )
                               <tr
                               wire:key="item-{{ $index }}"

                               >

                                    <td class="text-center text-sm">{{ $item['produk_id'] }}</td>
                                    <td class="text-center text-sm">{{ $item['description'] }}</td>
                                    <td class="text-center text-sm">{{ $item['uom'] }}</td>
                                    <td
                                        class="text-center text-sm"
                                        >
                                        <select
                                        wire:model="itemQty.{{ $index }}"
                                        wire:change='changeitemQty({{ $index }})'
                                        required
                                        >
                                            <option value="">qty</option>
                                            @for ($x=0;$x<=100;$x++)
                                            <option value="{{$x}}">{{ $x }}</option>
                                            @endfor
                                        </select>

                                    </td>
                                    <td class="border-2 text-center text-sm">{{ $item['harga'] }}</td>
                                    <td class="text-center text-sm">
                                        <button
                                        wire:click="removeItem({{ $index }},{{ $item['produk_id'] }})"
                                        type="button"
                                        class="text-red-700 hover:text-red-900"
                                        >
                                        Remove
                                        </button>
                                    </td>
                                </tr>

                               @endforeach

                                @endif
                            </tbody>
                        </table>
                    </div>


                </div>

                <div class="py-2 w-full gap-8 mt-auto">
                    <label class="w-16"> Visibility</label>
                    <select
                    wire:model.live="menu_visibility"
                    class="  text-sm rounded-xl py-2 px-4 "
                    >
                    <option value="1" selected>Show</option>
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

</div>
