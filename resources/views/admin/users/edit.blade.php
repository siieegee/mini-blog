<x-app-layout>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <nav x-data="{ open: false }" class="shadow-md" style="background-color: #669bbc;">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-[#1b263b]">Admin Dashboard</h1>
            <button @click="open = !open" class="md:hidden text-white">☰</button>
            <div :class="{'block': open, 'hidden': !open}" class="hidden md:flex space-x-4">
                <a href="{{ route('admin.users') }}" class="text-sm font-bold text-[#1b263b] hover:text-white">Users</a>
                <a href="{{ route('admin.posts') }}" class="text-sm font-bold text-[#1b263b] hover:text-white">Posts</a>
            </div>
        </div>
    </nav>

    <div class="min-h-screen" style="background-color: #669bbc;">
        <main class="max-w-5xl mx-auto p-8">
            <div class="rounded-lg shadow-lg p-8" style="background-color: #1b263b; color: #e0e1dd;">
                <h1 class="text-2xl font-bold mb-6">Edit User: {{ $user->name }}</h1>

                {{-- Success Message --}}
                @if(session('success'))
                    <div class="mb-6 p-4 rounded bg-green-500 text-white shadow-md">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- User Update Form --}}
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-6 mb-12">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="name" class="block text-sm font-medium mb-1">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                            class="w-full p-2 bg-gray-100 text-gray-900 border border-gray-400 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium mb-1">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                            class="w-full p-2 bg-gray-100 text-gray-900 border border-gray-400 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium mb-1">New Password</label>
                        <input type="password" name="password" id="password"
                            class="w-full p-2 bg-gray-100 text-gray-900 border border-gray-400 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium mb-1">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="w-full p-2 bg-gray-100 text-gray-900 border border-gray-400 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div class="flex justify-end space-x-4">
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded shadow">
                            Update User
                        </button>
                        <a href="{{ route('admin.users') }}"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-4 py-2 rounded shadow">
                            Cancel
                        </a>
                    </div>
                </form>

                {{-- User's Posts --}}
                <h2 class="text-xl font-semibold mb-4">Posts by {{ $user->name }}</h2>

                @if ($user->posts->isEmpty())
                    <p>No posts found.</p>
                @else
                    <table class="w-full border-collapse border border-gray-400">
                        <thead>
                            <tr class="bg-gray-700 text-[#e0e1dd]">
                                <th class="border border-gray-400 px-4 py-2 text-left">Title</th>
                                <th class="border border-gray-400 px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user->posts as $post)
                                <tr class="hover:bg-gray-600">
                                    <td class="border border-gray-400 px-4 py-2">{{ $post->title }}</td>
                                    <td class="border border-gray-400 px-4 py-2 text-center">
                                        <div class="flex justify-center space-x-2">
                                            <a href="{{ route('admin.posts.edit', $post) }}"
                                                class="bg-yellow-400 hover:bg-yellow-500 text-white font-semibold px-4 py-2 rounded text-sm">
                                                Edit
                                            </a>
                                            <a href="{{ route('admin.posts.delete', $post) }}"
                                                class="bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded text-sm">
                                                Delete
                                            </a>
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
