<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com"></script>

        <style>
        @vite(['resources/css/app.css', 'resources/js/app.js'])


        </style>

    </head>
    <body>
        <div class="w-full flex">
            <div class="flex flex-1 justify-center items-center">
                <Button
                    type="button"
                    class="bg-blue-300 rounded-lg p-2"
                    onclick="window.location.href='{{ route('createdDB', ['dbname' => $dbname]) }}'">
                    Create Database - {{ $dbname }}

                </button>

            </div>
    </body>

</html>
