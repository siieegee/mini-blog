<x-app-layout>
    <nav x-data="{ open: false }" class="shadow-md" style="background-color: #669bbc;">
        <!-- Admin navbar -->
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-[#1b263b]">Admin Dashboard</h1>
            <button @click="open = !open" class="md:hidden text-white">☰</button>
            <div :class="{'block': open, 'hidden': !open}" class="hidden md:flex space-x-4">
                <a href="{{ route('admin.users') }}" class="text-sm font-bold text-[#1b263b] hover:text-white">Users</a>
                <a href="#" class="text-sm font-bold text-[#1b263b] hover:text-white">Posts</a>
                <a href="#" class="text-sm font-bold text-[#1b263b] hover:text-white">Settings</a>
            </div>
        </div>
    </nav>

    <div class="min-h-screen" style="background-color: #669bbc; color: #e0e1dd;">
        <main class="max-w-7xl mx-auto p-6">

            <!-- Admin Widgets -->
            <div class="mb-10">
                <div class="shadow rounded-lg p-6 text-[#e0e1dd]" style="background-color: #1b263b;">
                    <h3 class="text-lg font-semibold mb-2">Total Users</h3>
                    <p class="text-4xl font-bold">{{ $userCount }}</p>
                </div>
            </div>

            <!-- User Management Table -->
            <div class="shadow rounded-lg p-6 text-[#e0e1dd]" style="background-color: #1b263b;">
                <h3 class="text-lg font-semibold mb-4">User Management</h3>
                @if ($users->isEmpty())
                    <p class="text-center">No users found.</p>
                @else
                    <table class="min-w-full text-left">
                        <thead>
                            <tr class="border-b text-sm text-[#e0e1dd]/80">
                                <th class="py-2">Name</th>
                                <th class="py-2">Email</th>
                                {{-- Optional: include this if roles exist --}}
                                {{-- <th class="py-2">Role</th> --}}
                                <th class="py-2">Registered</th>
                                <th class="py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="border-b hover:bg-[#2e3b52]">
                                    <td class="py-2">{{ $user->name }}</td>
                                    <td class="py-2">{{ $user->email }}</td>
                                    {{-- <td class="py-2">{{ ucfirst($user->role ?? 'user') }}</td> --}}
                                    <td class="py-2">{{ $user->created_at->format('M d, Y') }}</td>
                                    <td class="py-2">
                                        <div class="flex items-center gap-3">
                                            <!-- Edit Icon -->
                                            <a href="#" class="text-yellow-400 hover:text-yellow-300" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                                                </svg>
                                            </a>

                                            <!-- Delete Icon -->
                                            <form action="#" method="POST" onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-400" title="Delete">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3m5 0H6" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </main>
    </div>
</x-app-layout>
