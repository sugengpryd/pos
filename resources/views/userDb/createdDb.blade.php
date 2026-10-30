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
            <div class="w-full flex flex-col justify-center items-center mt-8">
                <div class="flex-col justify-center items-center mb-8" >
                <label class="text-bold text-xl text-green-700">Let's Start with create database</label>
                </div>
                <Button
                    type="button"
                    class="bg-blue-300 rounded-lg p-2 hover:shadow-lg hover:shadow-white"
                    onclick="window.location.href='{{ route('createdDB', ['dbname' => $dbname]) }}'">
                    Create Database - {{ $dbname }}

                </button>

            </div>
        </div>
    </body>

</html>
