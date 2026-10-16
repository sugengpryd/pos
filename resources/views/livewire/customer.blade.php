<div class="py-4">
    {{-- <div >
        <header>Customer List</header>
    </div> --}}
    <div class="flex justify-between items-center p-2 gap-2 ">
        <div>
            <button
            {{-- wire:modal='modalOpen' --}}
            wire:click='openModal'
            class="bg-blue-400 shadow-xl shadow-gray-500 p-3 rounded-xl text-xs">Add New Customer
            </button>
        </div>
        <div class="flex flex-row ">
           <input class="rounded-xl" placeholder="Search Customer" type="text">
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

        <div class="w-full text-center max-h-screen px-2 pb-4 justify-center items-center overflow-y-auto">
            <table>
                <thead>
                    <th class=" text-xs sticky top-0 bg-gray-400 w-80 mx-auto p-2">Id</th>
                    <th class=" text-xs sticky top-0 bg-gray-400 w-80 mx-auto text-left p-2">Nama</th>
                    <th class=" text-xs sticky top-0 bg-gray-400 w-80 mx-auto p-2">Alamat </th>
                    <th class=" text-xs sticky top-0 bg-gray-400 w-80 mx-auto p-2">Kota </th>
                    <th class=" text-xs sticky top-0 bg-gray-400 w-80 mx-auto p-2">Telpon-1</th>
                    <th class=" text-xs sticky top-0 bg-gray-400 w-80 mx-auto p-2">Telpon-2</th>
                    <th class=" text-xs sticky top-0 bg-gray-400 w-80 mx-auto p-2">Action</th>
                </thead>
                <tbody>
                    @foreach ($customer as $index => $customers )

                    <tr class="border-b-black border ">
                        <td class="p-2 text-xs text-center">{{ $index+1 }}</td>
                        <td class="p-2 text-xs text-left border-b-black ">{{ $customers->nama }}</td>
                        <td class="p-2 text-xs">{{ $customers->Alamat }}</td>
                        <td class="p-2 text-xs">{{ $customers->kota }}</td>
                        <td class="p-2 text-xs">{{ $customers->telepon1 }}</td>
                        <td class="p-2 text-xs">{{ $customers->telepon2 }}</td>
                        <td
                        wire:click='editCustomer({{$customers->id}})'
                        class="p-2"

                        >
                        <button class=" bg-red-700 shadow-lg px-4 py-2 rounded-lg">Edit</button></td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    @if($showModal)
        <div class="fixed inset-0 z-50 w-full h-auto flex items-center justify-center bg-black bg-opacity-50">

            <div class="flex flex-col bg-white rounded-lg justify-center items-center shadow-lg w-full min-w-[400px] max-w-[600px] p-6 max-h-screen overflow-y-auto ">

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



                        <div class= "flex flex-row justify-end item-start ml-20 gap-3 mt-2 text-xs">
                            <button
                            type="button"
                            wire:click='closeOpenModal'
                            class="bg-gray-600 py-2 px-4 rounded-xl"
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
