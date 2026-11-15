<div class="py-4">
    <div
            x-data="{ show: false, message: '',type:'success',timer:null }"

            x-on:notify.window="
                console.log('Notify event received:', $event.detail);
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
