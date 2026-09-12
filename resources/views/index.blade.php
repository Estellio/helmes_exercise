<html class="group/root dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Helmes exercise') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    
    <body class="flex flex-col items-center p-10 bg-gray-900 text-gray-300">
        <div class="flex flex-col w-full gap-y-8 bg-gray-800 rounded-lg px-6 py-8 ring shadow-xl ring-gray-900/50 min-w-[360px] max-w-[900px]">
            <h1 class="text-white font-medium text-lg">
                Please enter your name and pick the Sectors you are currently involved in.
            </h1>

            <livewire:sectors-form />
        </div>

        <div>
            {{ session()->getId() }}
        </div>

        <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    </body>
</html>
