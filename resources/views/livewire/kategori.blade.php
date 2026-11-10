<div class="py-4">
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
    <div class="w-full flex justify-center items-center text-lg text-bold">
        <header>Kategori Menu</header>
    </div>
    <div class= "w-full " >
        <div class= "flex flex-col md:flex-row  justify-center items-center gap-4 mb-2 p-4 mx-auto ">
             <button
                wire:click='openModal'
                class="bg-blue-400 py-2 px-4 rounded-lg"
                >
            Add Category

            </button>

            <input
             type="text"
             wire:model.live="filterSearch"
             placeholder="Search"
             class="border hover:border-blue-400 p-2 rounded-xl"
            >

            <select
             wire:model.live="filterFlaq"
             class="border hover:border-blue-400 py-2 px-4 w-44 rounded-xl mr-10"
            >
            <option value="">Filter Status</option>
            <option value="0">Hidden</option>
            <option value="1">Show</option>
            </select>





        </div>
        <div class="flex flex-col px-3 ml-[415px] w-44">

        </div>
        <div class="flex  w-full h-screen mt-0 mx-auto py-0 px-4 ">
            <div class="w-full mx-auto h-[400px] md:w-[600px] bg-white rounded-lg justify-center items-center overflow-auto">
              <div class="h-[600px] w-full" >
                <table class="w-full border mx-auto ">
                    <thead class="sticky top-0 z-50 p-6">
                        <th class="top-0 text-white bg-gray-600 sticky py-2 px-2  text-left">Id</th>
                        <th class="top-0 text-white bg-gray-600 sticky py-2 px-2  text-left">Description</th>
                        <th class="top-0 text-white bg-gray-600 sticky py-2 px-2 text-left">Flag</th>
                        <th class="top-0 text-white bg-gray-600 sticky py-2 px-2 text-left">Image</th>
                        <th class="top-0 text-white bg-gray-600 sticky py-2 px-2 text-center">Action</th>
                    </thead>
                    <tbody>
                        @foreach ($kategories as $index =>$kategories )

                        {{-- <tr class="odd:bg-gray-200 even:''"> --}}
                        <tr class="border border-b">
                            <td class="py-2 px-2 text-xs">{{ $index+1 }}</td>
                            <td class="py-2 px-2 text-xs">{{ $kategories->description }}</td>
                            <td class="py-2 px-2 text-xs">{{ $kategories->flaq == 1 ? 'Show' : 'Hidden' }}</td>
                            <td
                                wire:model.live="menuImages"
                                class="p-2 text-sm text-left"
                            >
                                @if(!empty($kategories->image))
                                <a href ="{{ 'storage/'.$kategories->image }}" target="_blank" >link</a>
                                @endif

                            </td>

                            <td class="py-2 px-2 text-xs text-center">
                                <button
                                wire:click="editKategori('{{ $kategories->id }}')"
                                class="bg-blue-400 py-2 px-4 rounded-xl text-xs"
                                >Edit</button>

                                <button
                                wire:click="deleteKategori('{{ $kategories->id }}')"
                                class="bg-red-400 p-2 px-4 rounded-xl text-xs"
                                >Delete</button>
                            </td>

                        </tr>
                        @endforeach

                    </tbody>
                </table>
              </div>

            </div>


        </div>

    </div>
     @if($showModal)
        <div class="fixed flex inset-0 z-50 w-full min-h-0 pt-20 justify-center item-center text-center bg-black bg-opacity-50">

            <div class=" flex flex-col w-full md:w-[400px] h-[400px] bg-gray-300 rounded-lg justify-center items-center shadow-lg p-4">

                    {{-- <h3 class="text-lg font-semibold mb-6">
                        {{ $editMode ? 'Edit Kategori' : 'Create New Kategori' }}
                    </h3> --}}
                        <div class="flex flex-col w-full h-600 p-4 rounded-lg justify-center items-center gap-2 bg-gray-300">
                            <h3 class="text-lg font-semibold mb-6">
                                {{ $editMode ? 'Edit Kategori' : 'Create New Kategori' }}
                            </h3>
                            <form wire:submit.prevent="save" enctype="multipart/form-data">
                                <div class=" w-full md:w-full flex flex-wrap justify-start items-center text-sm gap-2" >
                                    <label>Description</label>
                                    <input
                                    wire:model='kategoriDescription'
                                    placeholder="Kategori description"
                                    type="text"
                                    class=" w-full p-2 mt-2 rounded"
                                    >
                                </div>

                                <div class="w-full md:w-full flex flex-wrap justify-start items-center mt-2 text-sm gap-2" >
                                    <label>Status</label>
                                    <select
                                    wire:model='kategoriFlaq'
                                    class=" w-full p-2 mt-2 rounded"
                                    >
                                    <option value="">Select Status</option>
                                    <option value="0">Hidden/Sembunyikan</option>
                                    <option value="1">Show/Tampilkan </option>
                                    </select>
                                </div>

                                <div class="py-2 w-full gap-8 mt-auto text-left">
                                        <label
                                        class="w-16"
                                        > Image</label>
                                        <input
                                        type="file"
                                        wire:model.live="kategori_image"
                                        accept="image/*"
                                        class=" w-full text-sm rounded-xl py-2 px-4 "
                                        >
                                        @error('file')
                                            <p class="text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                        {{-- Preview gambar --}}
                                        @if ($kategori_image && str_starts_with($kategori_image->getMimeType(), 'image/'))
                                            <div class="mt-4">
                                                <p class="text-xs font-semibold mb-2">
                                                    Image Preview
                                                </p>

                                                <img
                                                    src="{{ $kategori_image->temporaryUrl() }}"
                                                    alt="Preview file"
                                                    class="max-w-full max-h-28 object-contain
                                                        rounded-lg border p-1"
                                                >
                                            </div>
                                        @endif
                                    </div>

                                <div class="flex w-full flex-wrap gap-4 mt-4 justify-start items-start">
                                    <button
                                    wire:click='closeopenModal'
                                    wire:loading.attr="disabled"
                                    type="button"
                                    class="bg-red-400 py-2 px-4 rounded-xl text-xs disabled:opacity-50 disabled:cursor-not-allowed">Cancel

                                    </button>

                                    <button
                                    {{-- wire:click='save' --}}
                                    wire:loading.attr="disabled"
                                    type="submit"
                                    class="bg-blue-400 py-2 px-4 rounded-xl text-xs disabled:opacity-50 disabled:cursor-not-allowed "
                                    >
                                    Save</button>
                                </div>

                            </form>
                        </div>

            </div>
        </div>
    @endif
</div>
