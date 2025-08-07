<nav class="bg-gradient-to-r from-gray-900 to-blue-900 text-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
        <!-- Logo / Site Title -->
        <a href="{{ route('admin.dashboard') }}" class="text-2xl font-bold tracking-wide select-none">
            SKYBOUND <span class="text-blue-300">TALES</span>
        </a>

        <!-- Navigation Links -->
        <nav class="flex space-x-6 text-sm">
            <a href="{{ route('admin.users') }}"
                class="px-4 py-1 rounded-full border
                    @if(request()->routeIs('dashboard')) border-white text-white
                    @else border-transparent text-white hover:text-blue-300 @endif">
                Users
            </a>

            <a href="{{ route('admin.posts') }}"
                class="px-4 py-1 rounded-full border
                    @if(request()->routeIs('about')) border-white text-white
                    @else border-transparent text-white hover:text-blue-300 @endif">
                Posts
            </a>
        </nav>

        <!-- User Actions -->
        <div class="flex items-center space-x-4">
            @auth
                <!-- Dropdown Trigger -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open"
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-800 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                        {{ Auth::user()->name }}
                        <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="open" @click.away="open = false"
                        class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 text-gray-700 ring-1 ring-black ring-opacity-5 z-20">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">Logout</button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="px-4 py-1 rounded-full border border-transparent text-white hover:text-blue-300 hover:border-white transition text-sm">
                    Login
                </a>
                <a href="{{ route('register') }}" class="px-4 py-1 rounded-full border border-transparent text-white hover:text-blue-300 hover:border-white transition text-sm">
                    Register
                </a>
            @endauth
        </div>
    </div>
</nav>
