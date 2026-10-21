<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="w-full mx-auto">
            <div class="bg-transparent overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
    <div class="w-full h-screen  py-4 px-12 justify-starts items-center pb-8 mx-auto ">
            {{-- <div class="flex flex-row justify-between items-center gap-2 mb-4 "> --}}
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8 md:gap-6">
                <a href="{{ route('Produk') }}">

                <div class="flex flex-col flex-wrap py-4 px-2 justify-center items-center hover:shadow-teal-700 bg-slate-400 shadow-xl shadow-teal-400  rounded-xl">
                    <div class="bg-white rounded-xl flex flex-col flex-shrink-0 min-w-20 min-h-20 md:w-52 md:h-52 ">
                        <img class="px-2 py-2 object-cover w-full h-full" src="storage/logo/9.png">


                    </div>
                    <span class="font_card text-center text-xs p-2">Produk</span>
                </div>
                </a>
                <a href="{{ route('Kategori') }}">

                <div class="flex flex-col flex-wrap py-4 px-2 justify-center items-center hover:shadow-teal-700 bg-slate-400 shadow-xl shadow-teal-400  rounded-xl">
                    <div class="bg-white rounded-xl flex flex-col min-w-20 min-h-20 md:w-52 md:h-52 ">
                        <img class="px-2 py-2 object-cover w-full h-full" src="storage/logo/2.png">

                    </div>
                    <span class="font_card text-center text-xs p-2">Menu Kategori</span>

                </div>
                </a>

                <a href="{{ route('Menu') }}">

                <div class="flex flex-col flex-wrap py-4 px-2 justify-center items-center hover:shadow-teal-700 bg-slate-400 shadow-xl shadow-teal-400  rounded-xl">
                    <div class="bg-white  rounded-xl flex flex-col min-w-20 min-h-20 md:w-52 md:h-52  ">
                        <img class="px-2 py-2 object-cover w-full h-full" src="storage/logo/10.png">

                    </div>
                    <span class="font_card text-center text-xs p-2">Menu</span>

                </div>
                </a>
                <a href="{{ route('Pos') }}">

                <div class="flex flex-col flex-wrap py-4 px-2 justify-center items-center hover:shadow-teal-700 bg-slate-400 shadow-xl shadow-teal-400  rounded-xl">
                    <div class="bg-white  rounded-xl flex flex-col min-w-20 min-h-20 md:w-52 md:h-52 ">
                        <img class="px-2 py-2 object-cover w-full h-full" src="storage/logo/pos.png">

                    </div>
                    <span class="font_card text-center text-xs p-2">POS</span>

                </div>
                </a>
                <a href="{{ route('Transaksi') }}">

                <div class="flex flex-col flex-wrap py-4 px-2 justify-center items-center hover:shadow-teal-700 bg-slate-400 shadow-xl shadow-teal-400  rounded-xl">
                    <div class="bg-white  rounded-xl flex flex-col min-w-20 min-h-20 md:w-52 md:h-52 ">
                        <img class="px-2 py-2 object-cover w-full h-full" src="storage/logo/4.png">

                    </div>
                    <span class="font_card text-center text-xs p-2">Transaksi</span>

                </div>
                </a>

            {{-- </div> --}}

            {{-- <div class="flex flex-row justify-between items-center gap-2"> --}}

                <a href="{{ route('Discount') }}">

                <div class="flex flex-col md:flex-col py-4 px-2 justify-center items-center hover:shadow-teal-700 bg-slate-400 shadow-xl shadow-teal-400  rounded-xl">
                    <div class="bg-white  rounded-xl flex flex-col min-w-20 min-h-20 md:w-52 md:h-52 ">
                        <img class="px-2 py-2 object-cover w-full h-full" src="storage/logo/5.png">

                    </div>
                    <span class="font_card text-center text-xs p-2">Discount</span>

                </div>
                </a>

                <a href="{{ route('Ppn') }}">

                <div class="flex flex-col md:flex-col py-4 px-2 justify-center items-center hover:shadow-teal-700 bg-slate-400 shadow-xl shadow-teal-400  rounded-xl">
                    <div class="bg-white  rounded-xl flex flex-col min-w-20 min-h-20 md:w-52 md:h-52 ">
                        <img class="px-2 py-2 object-cover w-full h-full" src="storage/logo/6.png">

                    </div>
                    <span class="font_card text-center text-xs p-2">Ppn</span>

                </div>
                </a>
                <a href="{{ route('Payment') }}">

                <div class="flex flex-col md:flex-col py-4 px-2 justify-center items-center hover:shadow-teal-700 bg-slate-400 shadow-xl shadow-teal-400  rounded-xl">
                    <div class="bg-white  rounded-xl flex flex-col min-w-20 min-h-20 md:w-52 md:h-52 ">
                        <img class="px-2 py-2 object-cover w-full h-full" src="storage/logo/7.png">

                    </div>
                    <span class="font_card text-center text-xs p-2">Payment</span>

                </div>
                </a>
                <a href="{{ route('Customer') }}">

                <div class="flex flex-col md:flex-col py-4 px-2 justify-center items-center hover:shadow-teal-700 bg-slate-400 shadow-xl shadow-teal-400  rounded-xl">
                    <div class="bg-white  rounded-xl flex flex-col min-w-20 min-h-20 md:w-52 md:h-52">
                        <img class="px-2 py-2 object-cover w-full h-full" src="storage/logo/8.png">

                    </div>
                    <span class="font_card text-center text-xs p-2">Customer</span>

                </div>
                </a>


    </div>
</x-app-layout>
