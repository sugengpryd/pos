<div class="py-4 bg-white">
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
    @if(isset($status))
                <div class="w-full">
                    <div class="w-full flex justify-center items-center">
                        <form class=" justify-center items-center p-6 md:w-[600px] bg-slate-300 h-screen">
                            <div class="p-2 text-bold text-2xl underline underline-offset-2">Profile</div>
                            <div class="flex flex-col p-2" >
                                <label for="companyId">Profile Id</label>
                                    <input
                                    wire:model="companyId"
                                    class="rounded-lg p-2 bg-gray-200 cursor-not-allowed"
                                    id="companyId"
                                    type="text"
                                    readonly
                                    required
                                    disabled
                                    >
                            </div>
                            <div class="flex flex-col p-2">
                                    <label for="namaPT">Nama PT</label>
                                    <input
                                        wire:model="namaPT"
                                        {{-- class="rounded-lg p-2" --}}
                                        id="namaPT"
                                        type="text"
                                        @disabled(!$editMode)
                                        {{-- @disabled(!$newMode) --}}
                                        @class([
                                    //  'font-bold' => true,
                                     'cursor-not-allowed'=>!$editMode,
                                     'rounded-lg',
                                     'bg-gray-200'=>!$editMode,
                                     'bg-white'=>$newMode,


                                     'p-2','px-4','hover:shadow-lg'])



                                    >
                            </div>
                            <div class="flex flex-col p-2">
                                    <label for="namaToko"> Nama Toko</label>
                                    <input
                                    wire:model="namaToko"
                                    {{-- class="rounded-lg p-2" --}}
                                    id="namaToko"
                                    required
                                    type="text"
                                    @disabled(!$editMode)
                                    {{-- @disabled(!$newMode) --}}

                                    @class([
                                    //  'font-bold' => true,
                                     'cursor-not-allowed'=>!$editMode,
                                     'rounded-lg',
                                     'bg-gray-200'=>!$editMode,
                                     'p-2','px-4','hover:shadow-lg'])

                                    >
                            </div>
                            <div class="flex flex-col p-2">
                                <label for="alamatToko">Alamat Toko</label>
                                    <input
                                    wire:model="alamatToko"
                                    {{-- class="rounded-lg p-2" --}}
                                    id="alamatToko"
                                    type="text"
                                    @disabled(!$editMode)
                                    {{-- @disabled(!$newMode) --}}


                                    required
                                    @class([
                                    //  'font-bold' => true,
                                     'cursor-not-allowed'=>!$editMode,
                                     'rounded-lg',
                                     'bg-gray-200'=>!$editMode,
                                     'p-2','px-4','hover:shadow-lg'])
                                    >
                            </div>
                            <div class="flex flex-col p-2">
                                <label for="telepon">Telepon</label>
                                    <input
                                    wire:model="telepon"
                                    {{-- class="rounded-lg p-2" --}}
                                    id="telepon"
                                    @disabled(!$editMode)
                                    {{-- @disabled(!$newMode) --}}

                                    @class([
                                    //  'font-bold' => true,
                                     'cursor-not-allowed'=>!$editMode,
                                     'rounded-lg',
                                     'bg-gray-200'=>!$editMode,
                                     'p-2','px-4','hover:shadow-lg'])

                                    type="text"
                                    >
                            </div>
                            <div class="p-2">
                                <button
                                    type="button"
                                    wire:click="exitcompro"
                                    class="rounded-lg bg-gray-600 p-2 px-4 hover:shadow-lg"
                                >exit
                                </button>
                                <button
                                    type="button"
                                    wire:click="edit"
                                    class="rounded-lg bg-red-700 p-2 px-4 hover:shadow-lg"
                                >Edit
                                </button>
                                <button
                                    wire:click="save"
                                    type="button"
                                    @disabled(!$editMode)

                                    @class([
                                     'font-bold' => true,
                                     'cursor-not-allowed'=>!$editMode,
                                     'rounded-lg',
                                     'bg-blue-300',
                                     'p-2','px-4','hover:shadow-lg'])



                                >Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
    @endif

</div>
