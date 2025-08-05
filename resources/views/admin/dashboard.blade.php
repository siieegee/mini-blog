@extends('layouts.admin_app')

@section('content')
    <nav x-data="{ open: false }" class="shadow-md" style="background-color: #669bbc;"></nav>

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

            <!-- Recent Posts Table -->
            <div class="bg-[#1b263b] text-[#e0e1dd] shadow rounded-lg p-6 mt-8">
                <h2 class="text-xl font-semibold mb-4">Recent Posts</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-600">
                        <thead>
                            <tr class="text-left text-sm font-semibold">
                                <th class="px-4 py-2">#</th>
                                <th class="px-4 py-2">Title</th>
                                <th class="px-4 py-2">Author</th>
                                <th class="px-4 py-2">Created</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                            @forelse ($recentPosts as $index => $post)
                                <tr>
                                    <td class="px-4 py-2">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2">{{ $post->title }}</td>
                                    <td class="px-4 py-2">{{ $post->user->name ?? 'N/A' }}</td>
                                    <td class="px-4 py-2">{{ $post->created_at->diffForHumans() }}</td>
                                    <td class="px-4 py-2 space-x-2">
                                        <a href="{{ route('posts.edit', $post) }}" class="text-blue-400 hover:underline">Edit</a>
                                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this post?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:underline">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-2 text-center">No recent posts found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>
@endsection
