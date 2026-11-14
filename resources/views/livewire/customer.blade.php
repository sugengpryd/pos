<div class="py-4 w-full" >
    <div class="w-screen md:max-w-[1280px] md:px-12 mx-auto" >
    {{-- <div >
        <header>Customer List</header>
    </div> --}}
            <div class="flex justify-between items-center p-2 gap-2 mb-2 ">
                <div>
                    <button
                    {{-- wire:modal='modalOpen' --}}
                    wire:click='openModal'
                    class="bg-blue-400 shadow-xl shadow-gray-500 p-3 rounded-xl text-xs">Add New Customer
                    </button>
                </div>
                <div class="flex flex-row ">
                <input
                wire:model.live="filterSearch"
                class="rounded-xl" placeholder="Search Customer" type="text">
                </div>
            </div>

            {{-- notifikasi --}}
            <div
                    x-data="{ show: false, message: '' }"
                    x-on:notify.window="
                        message = $event.detail.message;
                        show = true;
                        setTimeout(() => show = false, 3000);
                    "
                        >
                    <div
                        x-show="show"
                        x-transition
                        class="fixed top-5 right-5 z-50 bg-green-500 text-white px-5 py-3 rounded-lg shadow-lg"
                        >
                        <span x-text="message"></span>
                    </div>
            </div>
        <div class="w-full max-h-[90vh] overflow-y-auto px-4 py-2">
            <div class="w-full overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead class="sticky top-0 z-50 bg-gray-400">
                        <tr>
                            <th class="text-xs py-2 px-3 text-center">Id</th>
                            <th class="text-xs py-2 px-3 text-left">Nama</th>
                            <th class="text-xs py-2 px-3 text-left">Alamat</th>
                            <th class="text-xs py-2 px-3 text-left">Kota</th>
                            <th class="text-xs py-2 px-3 text-center">Telpon-1</th>
                            <th class="text-xs py-2 px-3 text-center">Telpon-2</th>
                            <th class="text-xs py-2 px-3 text-center">Status</th>
                            <th class="text-xs py-2 px-3 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customer as $index => $customers)
                            <tr class="border-b border-gray-300">
                                <td class="py-2 px-3 text-xs text-center">{{ $index + 1 }}</td>
                                <td class="py-2 px-3 border-b text-xs text-left">{{ $customers->nama }}</td>
                                <td class="py-2 px-3 border-b text-xs text-left">{{ $customers->Alamat }}</td>
                                <td class="py-2 px-3 border-b text-xs text-left">{{ $customers->kota }}</td>
                                <td class="py-2 px-3 border-b text-xs text-center">{{ $customers->telepon1 }}</td>
                                <td class="py-2 px-3 border-b text-xs text-center">{{ $customers->telepon2 }}</td>
                                <td class="py-2 px-3 border-b text-xs text-center">{{ $customers->flaq ? 'Show' : 'Hidden' }}</td>
                                <td class="py-2 px-3 border-b text-center">
                                    <button wire:click="editCustomer({{ $customers->id }})" class="bg-red-700 text-white shadow-lg px-3 py-1 rounded-lg text-xs">Edit</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @if($showModal)
        <div class="fixed inset-0 z-50 w-full h-auto flex items-center justify-center bg-black bg-opacity-50">

            <div class="flex flex-col w-full bg-white min-h-screen rounded-lg justify-center items-center shadow-lg min-w-[400px] max-w-[600px] p-6 overflow-y-auto ">

                    <h3 class="text-lg font-semibold mb-4">
                        {{ $editMode ? 'Edit Customer' : 'Create New Customer' }}
                    </h3>

                    <form wire:submit.prevent="save" enctype="multipart/form-data">
                        <div class=" w-80 flex flex-wrap justify-start items-start mt-2 gap-2 text-xs">
                                <label class="text-left" for="name">Nama Customer</label>
                                <input
                                id="name"
                                wire:model='namaCustomer'
                                placeholder="Input nama Customer"
                                type="text"
                                class="w-full px-2 rounded"
                                >
                        </div>
                        <div class="w-80 flex flex-wrap justify-start items-start mt-2  gap-2 text-xs">
                                <label class="text-left" for="alamat">Alamat</label>
                                <input
                                id="alamat"
                                wire:model='alamatCustomer'
                                placeholder="Input Alamat Customer"
                                type="text"
                                class="w-full px-2 rounded"
                                >
                        </div>

                        <div class="w-80  flex flex-wrap justify-start items-start mt-2  gap-2 text-xs">
                                <label class="text-left" for="kota">Kota</label>
                                <select
                                id="kota"
                                wire:model='pilihKota'
                                wire:change='selectKota'
                                class="w-full py-2  rounded"
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
                        <div class="w-80  flex flex-wrap justify-start items-start mt-2  gap-2 text-xs">
                                <label class="text-left" for="telepon-1">Telepon-1</label>
                                <input
                                id="telepon-1"
                                wire:Model='telepon1'
                                placeholder=""
                                type="text"
                                class="w-full px-2   rounded"
                                >
                        </div>
                        <div class="w-80  flex flex-wrap justify-start items-start mt-2  gap-2 text-xs">
                                <label class="text-left" for="telepon-2">Telepon-2</label>
                                <input
                                id="telepon-2"
                                wire:Model='telepon2'
                                placeholder=""
                                type="text"
                                class="w-full px-2  rounded"
                                >
                        </div>
                        <div class="w-80  flex flex-wrap justify-start items-start mt-2  gap-2 text-xs">
                                <label class="text-left" for="flaq">Status</label>
                                <select
                                    id="flaq"
                                    wire:Model='flaq'
                                    placeholder=""
                                    class="w-full px-2 rounded"
                                >
                                <option value="1">Show</option>
                                <option value="0">Hidden</option>
                                </select>

                        </div>



                        <div class= "flex flex-row justify-end item-start ml-20 gap-3 mt-2 text-xs">
                            <button
                            type="button"
                            wire:click='closeOpenModal'
                            class="bg-gray-300 py-2 px-4 rounded-xl"
                            >Cancel</button>

                            <button
                            type="button"
                            wire:click='save'
                            class="bg-blue-400 py-2 px-4 rounded-xl"
                            >Save</button>
                        </div>
                    </form>
            </div>

        </div>
    @endif
    </div>
</div>
