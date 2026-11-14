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
                <div class="w-full max-h-[100vh] overflow-y-auto px-4 py-2 border border-gray-200 rounded-lg shadow-sm">
    <!-- Explicit height wrapper to prevent webview collapse -->
                    <div style="height: 500px; max-height: 90vh;" class="w-full overflow-y-auto overflow-x-auto border border-gray-200 rounded-lg bg-white shadow-sm">
                        <table class="w-full border-collapse">
                            <thead class="sticky top-0 z-50 bg-gray-700 text-white">
                                <tr>
                                    <th class="py-3 px-3 text-xs font-semibold text-center">Id</th>
                                    <th class="py-3 px-3 text-xs font-semibold text-left">Nama</th>
                                    <th class="py-3 px-3 text-xs font-semibold text-left">Alamat</th>
                                    <th class="py-3 px-3 text-xs font-semibold text-left">Kota</th>
                                    <th class="py-3 px-3 text-xs font-semibold text-center">Telpon-1</th>
                                    <th class="py-3 px-3 text-xs font-semibold text-center">Telpon-2</th>
                                    <th class="py-3 px-3 text-xs font-semibold text-center">Status</th>
                                    <th class="py-3 px-3 text-xs font-semibold text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach ($customer as $index => $customers)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="py-2.5 px-3 text-xs text-center text-gray-700">{{ $index + 1 }}</td>
                                        <td class="py-2.5 px-3 text-xs text-left text-gray-900 font-medium">{{ $customers->nama }}</td>
                                        <td class="py-2.5 px-3 text-xs text-left text-gray-700">{{ $customers->Alamat }}</td>
                                        <td class="py-2.5 px-3 text-xs text-left text-gray-700">{{ $customers->kota }}</td>
                                        <td class="py-2.5 px-3 text-xs text-center text-gray-700">{{ $customers->telepon1 }}</td>
                                        <td class="py-2.5 px-3 text-xs text-center text-gray-700">{{ $customers->telepon2 }}</td>
                                        <td class="py-2.5 px-3 text-xs text-center">
                                            <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold {{ $customers->flaq ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                                {{ $customers->flaq ? 'Show' : 'Hidden' }}
                                            </span>
                                        </td>
                                        <td class="py-2.5 px-3 text-center">
                                            <button wire:click="editCustomer({{ $customers->id }})" class="bg-red-600 hover:bg-red-700 text-white shadow px-3 py-1 rounded-md text-xs transition">Edit</button>
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
