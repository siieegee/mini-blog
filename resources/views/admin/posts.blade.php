<x-app-layout>
    <nav x-data="{ open: false }" class="shadow-md" style="background-color: #669bbc;">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-[#1b263b]">Admin Dashboard</h1>
            <button @click="open = !open" class="md:hidden text-white">☰</button>
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
            <div class="mb-10">
                <div class="shadow rounded-lg p-6 text-[#e0e1dd]" style="background-color: #1b263b;">
                    <h3 class="text-lg font-semibold mb-2">Total Posts</h3>
                    <p class="text-4xl font-bold">{{ $postCount }}</p>
                </div>
            </div>

            <!-- Post Management Table -->
            <div class="shadow rounded-lg p-6 text-[#e0e1dd]" style="background-color: #1b263b;">
                <h3 class="text-lg font-semibold mb-4">Post Management</h3>
                @if ($posts->isEmpty())
                    <p class="text-center">No posts found.</p>
                @else
                    <table class="min-w-full text-left">
                        <thead>
                            <tr class="border-b text-sm text-[#e0e1dd]/80">
                                <th class="py-2">Image</th>
                                <th class="py-2">Title</th>
                                <th class="py-2">Author</th>
                                <th class="py-2">Created</th>
                                <th class="py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr class="border-b hover:bg-[#2e3b52]">
                                    <!-- Image -->
                                    <td class="py-1 align-top">
                                        @php
                                            $photo = $post->photo_path;
                                            $isUrl = Str::startsWith($photo, ['http://', 'https://']);
                                        @endphp

                                        @if ($photo)
                                            <img src="{{ $isUrl ? $photo : asset('storage/' . $photo) }}"
                                                 alt="Post Image"
                                                 class="w-16 h-16 object-cover rounded">
                                        @else
                                            <span class="text-sm text-gray-400 italic">No image</span>
                                        @endif
                                    </td>

                                    <!-- Title -->
                                    <td class="align-top py-1">
                                        {{ $post->title }}
                                    </td>

                                    <!-- Author -->
                                    <td class="align-top py-1">
                                        {{ $post->user->name ?? 'Unknown' }}
                                    </td>

                                    <!-- Created -->
                                    <td class="align-top py-1">
                                        {{ $post->created_at->format('M d, Y') }}
                                    </td>

                                    <!-- Actions -->
                                    <td class="py-1 align-top">
                                        <div class="flex gap-2">
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
