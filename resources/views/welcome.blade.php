<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Skybound Tales</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-blue-100 font-sans antialiased">

    <header class="bg-gradient-to-r from-gray-900 to-blue-900 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold tracking-wide">SKYBOUND <span class="text-blue-300">TALES</span></h1>
            <nav class="flex space-x-6 text-sm">
                <a href="{{ route('welcome') }}"
                    class="px-4 py-1 rounded-full border
                        @if(request()->routeIs('welcome')) border-white text-white
                        @else border-transparent text-white hover:text-blue-300 @endif">
                    Home
                </a>
                {{--
                <a href="{{ route('about') }}"
                    class="px-4 py-1 rounded-full border
                        @if(request()->routeIs('about')) border-white text-white
                        @else border-transparent text-white hover:text-blue-300 @endif">
                    About us
                </a>

                <a href="{{ route('contact') }}"
                    class="px-4 py-1 rounded-full border
                            @if(request()->routeIs('contact')) border-white text-white
                            @else border-transparent text-white hover:text-blue-300 @endif">
                    Contact us
                </a>
                --}}
            </nav>

            <div class="space-x-4 flex">
                <a href="{{ route('login') }}"
                    class="px-4 py-1 rounded-full border border-transparent text-white hover:text-blue-300 hover:border-white transition text-sm">
                    Login
                </a>
                <a href="{{ route('register') }}"
                    class="px-4 py-1 rounded-full border border-transparent text-white hover:text-blue-300 hover:border-white transition text-sm">
                    Register
                </a>
            </div>
        </div>
    </header>

    <main class="relative bg-cover bg-center h-screen" style="background-image: url('https://images8.alphacoders.com/135/thumb-1920-1354012.png');">
        <div class="absolute inset-0 bg-blue-900 bg-opacity-30"></div>
        <div class="relative z-10 max-w-6xl mx-auto px-6 py-20 flex flex-col justify-center items-start space-y-8">
            <h2 class="text-5xl font-bold text-white leading-tight">
                Wander Into Wonder, <br> One Story at a Time
            </h2>
            <p class="text-white text-lg max-w-xl">
                Step into the gentle magic of Studio Ghibli. From enchanted forests to  <br />
                quiet towns, our blog celebrates the films, the worlds, and the emotions <br />
                that make Ghibli timeless. Let every post take you deeper into the  <br />
                artistry, mystery, and heart behind the magic.
            </p>
            <a href="#" class="bg-white text-blue-800 font-semibold px-6 py-2 rounded-full shadow hover:bg-blue-100 transition">Explore
                Now</a>
        </div>
    </main>

</body>
</html>
