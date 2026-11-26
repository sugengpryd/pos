<div class="py-4">

    <div class="w-full h-[600px] p-6">
        {{-- <div class="flex flex-start justify-between items-center"> --}}

        {{-- notifikasi --}}
        <div
            x-data="{
                show: false,
                message: '',
                type: 'success',
                timer: null
            }"
            x-on:notify.window="
                message = $event.detail.message;
                type = $event.detail.type || 'success';

                show = true;

                clearTimeout(timer);

                timer = setTimeout(() => {
                    show = false;
                }, 2000);
            "
        >
            <div
                x-cloak
                x-show="show"
                x-transition
                :class="{
                    'bg-green-500': type === 'success',
                    'bg-red-600': type === 'error',
                    'bg-yellow-500': type === 'warning',
                    'bg-blue-500': type === 'info'
                }"
                class="fixed top-5 right-5 z-[9999] text-white px-5 py-3 rounded-lg shadow-lg"
            >
                <span x-text="message"></span>
            </div>
        </div>
        <div class="flex flex-row justify-center items-center p-2">
            <form class="bg-slate-300">

                <div class="flex flex-col mb-4 justify-between items-center bg-gray-400 py-4 px-4 rounded-lg hover:shadow-xl hover:underline underline-offset-8 shadow-gray-700" >
                    <a href="{{ route('companyProfile', ['status' => 1]) }}">
                       👉 Setup Profile Toko
                    </a>
                </div>

                <div class="flex flex-col mb-4 justify-between items-center bg-gray-400 py-4 px-4 rounded-lg hover:shadow-xl hover:underline underline-offset-8 shadow-gray-700">
                    <label
                    >TimeZone
                    </label>
                    <div id="currentTime" class="p-2 mb-4 rounded-xl shadow-lg shadow-white text-white bg-black">
                         Current Time:
                        <span id="current-time"
                        wire:model="currentime"
                        >
                         {{ \Carbon\Carbon::now()
                                    ->timezone(auth()->user()->timezone ?? 'Asia/Jakarta')
                                    ->format('d-m-Y H:i:s') }}
                        </span>
                    </div>
                    <select
                        wire:model.live="timezone"
                        wire:change="getTimezone"
                        class="rounded-lg text-center"
                    >
                        <option>Select TimeZone</option>
                         {{-- @foreach($timezones as $index =>$tz)
                            <option value="{{ $tz }}">{{ $tz }}</option>
                        @endforeach --}}
                        @foreach($timezones as $index => $values)
                           <option class="text-center" value="{{ $index }}"> {{ $values }} </option>
                         @endforeach

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
            @script
            <script>
                    let timezone = @js(auth()->user()->timezone ?? 'Asia/Jakarta');
                    function updateClock() {
                        // const timezone = @js(auth()->user()->timezone ?? 'Asia/Jakarta');

                        const now = new Date();

                        document.getElementById('current-time').textContent =
                            new Intl.DateTimeFormat('en-GB', {
                                timeZone: timezone,
                                day: '2-digit',
                                month: '2-digit',
                                year: 'numeric',
                                hour: '2-digit',
                                minute: '2-digit',
                                second: '2-digit',
                                hourCycle: 'h23',
                            }).format(now);
                    }

                    updateClock();
                    setInterval(updateClock, 1000);

                    // Listen for Livewire timezone changes
                        Livewire.on('timezone-updated', (event) => {
                            timezone = event.timezone;
                            // console.log('New timezone:', event.timezone);

                            updateClock();
                        });


            </script>
            @endscript
        </div>

        {{-- </div> --}}

    </div>

</div>
