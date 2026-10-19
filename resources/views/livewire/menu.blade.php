<div class="py-4 w-full mx-auto max-w-[1280px]">
    <div class="flex flex-row justify-start items-start px-2 ml-[5px] gap-4">
        <div class="flex-col w-full justify-between items-center">
            <button
            wire:click="openModal"
            class="text-sm bg-blue-300 w-24 p-2 hover:bg-blue-500 rounded-xl border border-spacing-2 border-blue-400">New Menu</button>
        </div>
        <div class="flex w-full gap-4">
            <div class="flex flex-row w-full justify-end items-end">
                <input type="text" placeholder="Search Produk"
                    wire:model.live="filterSearch"
                    class="rounded-xl"
                    >
            </div>
        </div>
    </div>
    <div class="w-full max-w-[1280px] top-0 h-screen mx-auto mt-2 px-2 bg-gray-300 rounded-xl justify-start overflow-auto">
        <table class=" px-4 py-2 w-full">
            <p>Total: {{ $menu?->count() ?? '0' }}</p>
                <thead class="sticky py-0 top-0 bg-gray-400 z-55">
                    <tr>
                        <th class=" sticky top-0 z-50 p-4 text-left">Id</th>
                        {{-- <th class=" sticky top-0 z-50 p-4 text-left">Menu Id</th> --}}
                        <th class=" sticky top-0 z-50 p-4 text-left">Description</th>
                        {{-- <th class=" sticky top-0 z-50 p-4 text-left">Product name</th> --}}
                        <th class=" sticky top-0 z-50 p-4 text-left">Qty</th>
                        <th class=" sticky top-0 z-50  text-center">Uom</th>
                        <th class=" sticky top-0 z-50  text-center">Kategori</th>
                        <th class=" sticky top-0 z-50 p-4 text-right">Selling Price</th>
                        <th class=" sticky top-0 z-50 p-4 text-center">Image</th>
                        <th class=" sticky top-0 z-50 p-4 text-center">flaq</th>
                        <th class=" sticky top-0 z-50 p-4 text-center">Action</th>
                    </tr>

                </thead>
            <tbody class="bg-white">
                <?php
                $flaq='';
                ?>
                @foreach ($menu as $menus )

                <tr class="border-b-black border">
                    <td
                    wire:model.live="id"
                    class="p-2 text-sm ">{{ $menus->id }}</td>

                    <td
                    wire:model.live="description"
                    class="p-2 text-sm ">{{ $menus->description}}</td>

                    {{-- <td
                    wire:model.live="uom"
                    class="p-2 text-sm ">{{ App\Models\Produk::getprodukName($menus->produk_id)}}</td> --}}

                    <td
                    wire:model.live="item_qty"
                    class="p-2 text-sm  text-center ">{{ $menus->item_qty}}</td>

                    <td
                    wire:model.live="uom"
                    class="p-2 text-sm  text-xl-center ">{{ $menus->uom}}</td>

                    <td
                    wire:model.live="kategori"
                    class="p-2 text-sm text-xl-center ">{{ $menus->kategori}}</td>

                    <td
                    wire:model.live="harga"
                    class="p-2 text-sm text-right">{{ $menus->sellingPrice}}
                    </td>

                    <td
                    wire:model.live="menuImages"
                    class="p-2 text-sm text-right">
                    @if(!empty($menus->image))
                     <a href ="{{ 'storage/'.$menus->image }}" target="_blank" >1</a>
                     @endif
                    </td>

                    <td
                    wire:model="menu_visibility"
                    class="p-2 text-sm text-center "
                    >
                    {{ $menus->flaq == '1' ? 'Show' : 'Hidden' }}

                   </td>
                    <td class="p-2 text-sm text-center ">
                        <button
                            wire:click="editMenu({{ $menus->id }})"
                            class=" rounded-xl py-2  px-4 bg-blue-300">Edit</button>
                        <button class=" rounded-xl py-2 px-4 bg-red-300">Delete</button>

                    </td>

                </tr>
                 @endforeach

            </tbody>

        </table>


    </div>

    @if($showModal)
    <div class="fixed w-full flex justify-center  items-center inset-0 z-50 p-2 md:p-8 h-auto bg-black bg-opacity-50">
        <div class=" flex flex-col min-w-[360px] border-2 border-red-900 md:max-w-[1280px] w-[900px] justify-start items-start mt-4 mb-4 p-2 bg-white rounded-lg shadow-lg  md:justify-center md:items-center max-h-screen overflow-y-auto">

            <h3 class="text-lg font-semibold mb-4">
                {{ $editMode ? 'Edit Menu' : 'Create New Menu' }}
            </h3>

            <form wire:submit.prevent="save" enctype="multipart/form-data">
                {{-- form fields --}}

                <div class="flex flex-row py-2 w-full min-w-16 border">
                    <label  class="w-full text-xs border-2">Menu ID</label>
                    <input
                    wire:model="menuId"
                    x-on:dblclick="$wire.getRandomId()"
                    type="text"
                    placeholder="Click here to get Menu Id"
                    class="w-full text-xs rounded-xl  border-red-900 p-2 {{ $editMode ? 'bg-gray-200' : '' }}"
                     @disabled($menuId != '')
                    {{-- {{ $menuId ? 'disabled:disabled' : '' }}))" --}}
                    >
                </div>


                <div class=" flex flex-row py-2 w-full min-w-16">
                    <label  class="w-full text-xs">Menu Description</label>
                    <input
                    wire:model="menu_description"
                    type="text"
                    class="w-full text-xs
                     rounded-xl p-2"
                    >
                </div>

                <div class=" flex flex-row py-2 w-full min-w-16">
                    <label  class="w-full text-xs">Menu Kategori</label>
                    <select
                    wire:model.live="menu_kategori"
                    type="text"
                    class="w-full text-xs
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

                <div class=" flex flex-row py-2 w-full min-w-16">
                    <label class="w-full text-xs">Uom</label>
                    <select
                    wire:model="menu_uom"
                    class="w-full text-xs
                     rounded-xl p-2"
                    >
                        <option value="">Select Uom</option>
                    @foreach ($master_uom as $index => $uoms )
                        <option value="{{ $uoms->uomkode }}">{{ $uoms->uomkode }}</option>

                    @endforeach

                    </select>
                </div>

                <div class=" flex flex-row py-2 w-full min-w-16">
                    <label class="w-full text-xs">Qty</label>
                    <input
                    type="text"
                    wire:model.live="menu_qty"
                    class="w-full text-xs
                     rounded-xl p-2"
                    >
                </div>


                <div class=" flex flex-row py-2 w-full" >
                    <label class="w-full text-xs"> Selling Price</label>
                    <input
                    type="text"
                    wire:model="menu_harga"
                    class="w-full text-xs
                     rounded-xl p-2"
                    >
                </div>

                <div class="w-full">
                    <div class="flex flex-row min-w-[350px] justify-start items-start">
                        <select
                        wire:model.live="selectProduk"
                        wire:change="selectedProduk"
                        class="p-2 text-xs border-blue-400 rounded-xl"
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
                                <th class="bg-gray-400 p-2 text-xs">ProdukID</th>
                                <th class="bg-gray-400 p-2 text-xs ">Description</th>
                                <th class="bg-gray-400 p-2 text-xs">Uom</th>
                                <th class="bg-gray-400 p-2 text-xs">Qty</th>
                                <th class="bg-gray-400 p-2 text-xs">Base Price</th>
                                <th class="bg-gray-400 p-2 text-xs">Action</th>
                            </thead>
                            <tbody>
                                @if (empty($items))
                                    <tr>
                                        <td colspan="6"
                                        class="w-full text-center p-4 text-xs"
                                        >Belum ada item</td>
                                    </tr>
                                @else
                                @foreach ($items as $index => $item )
                               <tr
                               wire:key="item-{{ $index }}"

                               >

                                    <td class="text-center text-xs"
                                        wire:model.live="produk_id"
                                    >
                                    {{ $item['produk_id'] }}
                                    </td>
                                    <td class="text-center text-xs">{{ $item['description'] }}</td>
                                    <td class="text-center text-xs">{{ $item['uom'] }}</td>
                                    <td
                                        class="text-center text-xs"
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
                                    <td class="border-2 text-center text-xs">{{ $item['harga'] }}</td>
                                    <td class="text-center text-xs">
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
                    <label class="w-16"> Menu Image</label>
                    <input
                    type="file"
                    wire:model.live="menu_image"
                    accept="image/*"
                    class=" text-sm rounded-xl py-2 px-4 "
                    >
                    @error('file')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    {{-- Preview gambar --}}
                    @if ($menu_image && str_starts_with($menu_image->getMimeType(), 'image/'))
                        <div class="mt-4">
                            <p class="text-xs font-semibold mb-2">
                                Image Preview
                            </p>

                            <img
                                src="{{ $menu_image->temporaryUrl() }}"
                                alt="Preview file"
                                class="max-w-full max-h-28 object-contain
                                    rounded-lg border p-1"
                            >
                        </div>
                    @endif
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


                <div class="flex justify-start items-start gap-2 mt-4">
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
