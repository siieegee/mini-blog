<x-app-layout>
    <nav x-data="{ open: false }" class="shadow-md" style="background-color: #669bbc;">
        <!-- Admin navbar -->
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-[#1b263b]">Admin Dashboard</h1>
            <button @click="open = !open" class="md:hidden text-white">
                ☰
            </button>
            <div :class="{'block': open, 'hidden': !open}" class="hidden md:flex space-x-4">
                <a href="{{ route('admin.users') }}" class="text-sm font-bold text-[#1b263b] hover:text-white">Users</a>
                <a href="{{ route('admin.posts') }}" class="text-sm font-bold text-[#1b263b] hover:text-white">Posts</a>
                <a href="#" class="text-sm font-bold text-[#1b263b] hover:text-white">Settings</a>
            </div>
        </div>
    </nav>

    <div class="min-h-screen" style="background-color: #669bbc; color: #e0e1dd;">
        <main class="max-w-7xl mx-auto p-6">

            <!-- Admin Widgets -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <div class="shadow rounded-lg p-4 text-[#e0e1dd]" style="background-color: #1b263b;">
                    <h3 class="text-sm">Total Users</h3>
                    <p class="text-2xl font-bold">{{ $userCount }}</p>
                </div>
                <div class="shadow rounded-lg p-4 text-[#e0e1dd]" style="background-color: #1b263b;">
                    <h3 class="text-sm">Total Posts</h3>
                    <p class="text-2xl font-bold">{{ $postCount }}</p>
                </div>
                <div class="shadow rounded-lg p-4 text-[#e0e1dd]" style="background-color: #1b263b;">
                    <h3 class="text-sm">Reports Pending</h3>
                    <p class="text-2xl font-bold text-red-400">{{ $pendingReports }}</p>
                </div>
            </div>

            
        </main>
    </div>
</x-app-layout>