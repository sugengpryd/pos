<div class="py-4">
    <div class="ml-12">
        <header>Kategori Menu</header>
    </div>
    <div class= "w-full " >
        <div class= "flex justify-between items-center p-4 ml-8">
            <input
             type="text"
             wire:model.live="filterSearch"
             placeholder="Search"
             class="border hover:border-blue-400 p-2 rounded-xl"
            >

            <select
             wire:model.live="filterFlaq"
             class="border hover:border-blue-400 py-2 px-8 rounded-xl mr-10"
            >
            <option value="">Filter Status</option>
            <option value="0">Hidden</option>
            <option value="1">Show</option>
            </select>

        </div>
        <button
        wire:click='openModal'
        class="bg-blue-400 ml-12 py-2 px-4 rounded-xl"
        >
        Add New Kategori

        </button>
        <div class="flex h-screen mt-0 mx-auto py-4 px-12 ">
            <div class="w-full mx-auto bg-white rounded-lg justify-center items-center overflow-y-auto">
        {{-- {{-- <div class="flex mt-0 mx-auto py-4 px-12"> --}}
            {{-- <div class="w-full bg-white rounded-lg max-h-[calc(100vh-2rem)] overflow-y-auto">  --}}

                <table class="w-full border mx-auto">
                    <thead>
                        <th class="top-0 text-white bg-gray-600 sticky py-2 px-6 text-left">Id</th>
                        <th class="top-0 text-white bg-gray-600 sticky py-2 px-6 text-left">Description</th>
                        <th class="top-0 text-white bg-gray-600 sticky py-2 px-6 text-left">Flag</th>
                        <th class="top-0 text-white bg-gray-600 sticky py-2 px-6 text-center">Action</th>
                    </thead>
                    <tbody>
                        @foreach ($kategories as $index =>$kategories )

                        <tr class="odd:bg-gray-200 even:''">
                            <td class="py-2 pl-4 text-xs">{{ $index+1 }}</td>
                            <td class="py-2 pl-4 text-xs">{{ $kategories->description }}</td>
                            <td class="py-2 pl-4 text-xs">{{ $kategories->flaq == 1 ? 'Show' : 'Hidden' }}</td>
                            <td class="py-2 pl-4 text-xs text-center">
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
     @if($showModal)
        <div class="fixed inset-0 z-50 w-full h-auto flex items-center justify-center bg-black bg-opacity-50">

            <div class=" flex flex-col ml-2 bg-white rounded-lg justify-start items-center shadow-lg w-1/2 p-2 max-h-screen overflow-y-auto ">

                    <h3 class="text-lg font-semibold mb-4">
                        {{ $editMode ? 'Edit Kategori' : 'Create New Kategori' }}
                    </h3>

                    <form wire:submit.prevent="save" enctype="multipart/form-data">
                        <div>
                            <div class=" min-w-40 max-w-full md:w-full flex flex-wrap justify-start items-center text-xs gap-2" >
                                <label>Description</label>
                                <input
                                wire:model='kategoriDescription'
                                placeholder="Input Description"
                                type="text"
                                class=" w-full p-2 mt-2 rounded"
                                >
                            </div>


                            <div class=" min-w-40 max-w-full md:w-full flex flex-wrap justify-start items-center mt-2 text-xs gap-2" >
                                <label>Status</label>
                                <select
                                wire:model='kategoriFlaq'
                                class=" w-full p-2 mt-2 rounded"
                                >
                                <option value="">Select Status</option>
                                <option value="0">Hidden</option>
                                <option value="1">Show</option>
                                </select>
                            </div>

                            <div class="flex flex-wrap gap-4 mt-4 justify-start items-start">
                                <button
                                wire:click='closeopenModal'
                                type="button"
                                class="bg-red-400 py-2 px-4 rounded-xl text-xs">Cancel

                                </button>

                                <button
                                {{-- wire:click='save' --}}
                                type="submit"
                                class="bg-blue-400 py-2 px-4 rounded-xl text-xs "
                                >
                                Save</button>
                            </div>
                        </div>

                    </form>
            </div>
        </div>
    @endif
</div>
