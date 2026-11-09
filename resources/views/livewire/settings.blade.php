<div class="py-4">
<div class="w-full h-[600px] p-6">
    {{-- <div class="flex flex-start justify-between items-center"> --}}
        <div class="flex flex-row justify-center items-center p-2">
            <form class="bg-slate-300">

                <div class=" flex flex-col mb-4 justify-between items-center bg-gray-400 py-4 px-4 rounded-lg hover:shadow-xl hover:underline underline-offset-8 shadow-gray-700" >
                    <a href="{{ route('companyProfile', ['status' => 1]) }}">
                       👉 Setup Profile Toko
                    </a>
                </div>

                <div

                    {{-- class="bg-gray-400 py-4 px-4 rounded-lg hover:shadow-xl hover:underline underline-offset-8 shadow-gray-700" --}}

                    @class([
                        'bg-gray-400 px-4 py-4 text-center rounded rounded-lg hover:shadow-xl hover:underline underline-offset-8 shadow-gray-700',
                        'animate-pulse' => $notif,
                        'bg-green-600' => $notif,
                        'bg-red-600' => $notif,
                    ])
                    >
                    <a href="{{ route('CreatedbPage') }}">
                       👉 New Updates
                    </a>

                    {{-- http://localhost:8000/createdDb --}}
                </div>

            </form>
        </div>

    {{-- </div> --}}

</div>

</div>
