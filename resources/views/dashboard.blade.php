<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-transparent overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
    <div class="w-full h-screen px-6 mx-auto pb-8 overflow-y-auto">
            <div class="flex md:flex-row justify-center items-center mx-auto gap-2 ">
                <a href="{{ route('Produk') }}">

                <div class="flex flex-col p-2 justify-center items-center hover:shadow-teal-700 bg-slate-400 shadow-xl shadow-teal-400  rounded-xl">
                    <div class="bg-white rounded-xl flex flex-col w-20 h-20 md:w-40 md:h-40">
                        <img class="px-2 py-2 object-cover w-[full] h-full" src="storage/logo/produk.jpg">


                    </div>
                    <span class="font_card text-center text-xs">Produk</span>
                </div>
                </a>
                <a href="{{ route('Kategori') }}">

                <div class="flex flex-col p-2 justify-center items-center hover:shadow-teal-700 bg-slate-400 shadow-xl shadow-teal-400  rounded-xl">
                    <div class="bg-white flex flex-col w-20 h-20 md:w-40 md:h-40 rounded-xl ">

                    </div>
                    <span class="font_card text-center text-xs">Menu Kategori</span>

                </div>
                </a>

                <a href="{{ route('Menu') }}">

                <div class="flex flex-col p-2 justify-center items-center hover:shadow-teal-700 bg-slate-400 shadow-xl shadow-teal-400  rounded-xl">
                    <div class="bg-white flex flex-col w-20 h-20 md:w-40 md:h-40 rounded-xl  ">

                    </div>
                    <span class="font_card text-center text-xs">Menu</span>

                </div>
                </a>
                <a href="{{ route('Pos') }}">

                <div class="flex flex-col p-2 justify-center items-center hover:shadow-teal-700 bg-slate-400 shadow-xl shadow-teal-400  rounded-xl">
                    <div class="bg-white  rounded-xl flex flex-col w-20 h-20 md:w-40 md:h-40">
                        <img class="px-2 py-2 object-cover w-[full] h-full" src="storage/logo/pos.png">

                    </div>
                    <span class="font_card text-center text-xs">POS</span>

                </div>
                </a>
                <a href="{{ route('Transaksi') }}">

                <div class="flex flex-col p-2 justify-center items-center hover:shadow-teal-700 bg-slate-400 shadow-xl shadow-teal-400  rounded-xl">
                    <div class="bg-white rounded-xl flex flex-col w-20 h-20 md:w-40 md:h-40">

                    </div>
                    <span class="font_card text-center text-xs">Transaksi</span>

                </div>
                </a>

            </div>

            <div class="flex md:flex-row justify-center items-center mx-auto gap-2 mt-6">

                <a href="{{ route('Discount') }}">

                <div class="flex flex-col md:flex-col p-2 justify-center items-center hover:shadow-teal-700 bg-slate-400 shadow-xl shadow-teal-400  rounded-xl">
                    <div class="bg-white rounded-xl flex flex-col w-20 h-20 md:w-40 md:h-40">

                    </div>
                    <span class="font_card text-center text-xs">Discount</span>

                </div>
                </a>

                <a href="{{ route('Ppn') }}">

                <div class="flex flex-col md:flex-col p-2 justify-center items-center hover:shadow-teal-700 bg-slate-400 shadow-xl shadow-teal-400  rounded-xl">
                    <div class="bg-white rounded-xl flex flex-col w-20 h-20 md:w-40 md:h-40">

                    </div>
                    <span class="font_card text-center text-xs">Ppn</span>

                </div>
                </a>
                <a href="{{ route('Payment') }}">

                <div class="flex flex-col md:flex-col p-2 justify-center items-center hover:shadow-teal-700 bg-slate-400 shadow-xl shadow-teal-400  rounded-xl">
                    <div class="bg-white rounded-xl flex flex-col w-20 h-20 md:w-40 md:h-40">

                    </div>
                    <span class="font_card text-center text-xs">Payment</span>

                </div>
                </a>
                <a href="{{ route('Customer') }}">

                <div class="flex flex-col md:flex-col p-2 justify-center items-center hover:shadow-teal-700 bg-slate-400 shadow-xl shadow-teal-400  rounded-xl">
                    <div class="bg-white flex flex-col w-20 h-20 md:w-40 md:h-40 rounded-xl">

                    </div>
                    <span class="font_card text-center text-xs">Customer</span>

                </div>
                </a>


    </div>
</x-app-layout>
