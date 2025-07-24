<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Skybound Tales') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-blue-100 font-sans antialiased">

    <!-- Navbar -->
    <header class="bg-gradient-to-r from-gray-900 to-blue-900 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('welcome') }}" class="text-2xl font-bold tracking-wide text-white hover:text-blue-300 transition">
                SKYBOUND <span class="text-blue-300">TALES</span>
            </a>
            <nav class="flex space-x-6 text-sm">
                {{-- Optional Links --}}
            </nav>
        </div>
    </header>

    <!-- Login/Register -->
    <main class="flex justify-center items-center min-h-screen bg-cover bg-center" style="background-image: url('https://images2.alphacoders.com/136/1360350.png');">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white bg-opacity-60 shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </main>

</body>
</html>
