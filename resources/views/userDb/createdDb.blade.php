<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com"></script>

        <style>
        @vite(['resources/css/app.css', 'resources/js/app.js'])


        </style>

    </head>
    <body class="bg-slate-300">
        <div class="w-full">
            @if (session()->has('success'))
                <div class="bg-green-500 text-white p-3 rounded">
                 {{ session('success') }}
                </div>
            @endif


            <div class="w-full flex flex-col justify-center items-center mt-8">
                <div class="flex-col justify-center items-center mb-8" >
                <label class="text-bold text-xl text-green-700">Let's Start with create database</label>
                </div>
                <Button
                    type="button"
                    class="bg-blue-300 rounded-lg p-2 mb-8 hover:shadow-lg hover:shadow-white"
                    onclick="window.location.href='{{ route('createdDB', ['dbname' => $dbname ?? null]) }}'">
                    Create Database - {{ $dbname }}

                </button>
                @if(session()->has('success'))
                    <div>
                        <button
                            type="button"
                            onclick="window.location.href='{{ route('companyProfile',['status' => $status ?? '']) }}'"
                            class="rounded-lg p-2 bg-red-400"
                        >
                            Create Company Profile{{$status ?? ''}}
                            </button>
                    </div>
                @endif


            </div>

        </div>
    </body>

</html>
