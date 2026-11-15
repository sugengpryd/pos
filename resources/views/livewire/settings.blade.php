<div class="py-4">
<div class="w-full h-[600px] p-6">
    {{-- <div class="flex flex-start justify-between items-center"> --}}
        <div class="flex flex-row justify-center items-center p-2">
            <form class="bg-slate-300">

                <div class="flex flex-col mb-4 justify-between items-center bg-gray-400 py-4 px-4 rounded-lg hover:shadow-xl hover:underline underline-offset-8 shadow-gray-700" >
                    <a href="{{ route('companyProfile', ['status' => 1]) }}">
                       👉 Setup Profile Toko
                    </a>
                </div>

                <div class="flex flex-col mb-4 justify-between items-center bg-gray-400 py-4 px-4 rounded-lg hover:shadow-xl hover:underline underline-offset-8 shadow-gray-700">
                    <label

                    wire:model="inputTimezone"
                    class="p-4"
                    >TimeZone</label>
                    <select
                        wire:model="timezone"
                        wire:change="getTimezone()"
                        class="rounded-lg"
                    >
                        <option value="">Select Time Zone</option>
                        <option value="+1">GMT +1</option>
                        <option value="+2">GMT +2</option>
                        <option value="+3">GMT +3</option>
                        <option value="+4">GMT +4</option>
                        <option value="+5">GMT +5</option>
                        <option value="+6">GMT +6</option>
                        <option value="+7">GMT +7</option>
                        <option value="+8">GMT +8</option>
                        <option value="+9">GMT +9</option>
                        <option value="+10">GMT +10</option>
                        <option value="+11">GMT +11</option>
                        <option value="+12">GMT +12</option>
                        <option value="+13">GMT +13</option>
                        <option value="+14">GMT +14</option>
                        <option value="-1">GMT -1</option>
                        <option value="-2">GMT -2</option>
                        <option value="-3">GMT -3</option>
                        <option value="-4">GMT -4</option>
                        <option value="-5">GMT -5</option>
                        <option value="-6">GMT -6</option>
                        <option value="-7">GMT -7</option>
                        <option value="-8">GMT -8</option>
                        <option value="-9">GMT -9</option>
                        <option value="-10">GMT -10</option>
                        <option value="-11">GMT -11</option>
                        <option value="-12">GMT -12</option>

                    </select>
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
