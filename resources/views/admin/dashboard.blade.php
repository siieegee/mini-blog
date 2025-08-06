@extends('layouts.admin_app')

@section('content')
    <nav x-data="{ open: false }" class="shadow-md" style="background-color: #669bbc;"></nav>

    <div class="min-h-screen" style="background-color: #669bbc; color: #e0e1dd;">
        <main class="max-w-7xl mx-auto p-6">

            <!-- Flash success message -->
            @if(session('success'))
                <div class="bg-green-600 text-white px-6 py-3 rounded shadow mt-6 mb-6 max-w-7xl mx-auto text-center">
                    {{ session('success') }}
                </div>
            @endif

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

            <!-- Recent Reported Posts Table -->
            <div class="bg-[#1b263b] text-[#e0e1dd] shadow rounded-lg p-6 mt-8" style="background-color: #1b263b !important; opacity: 1;">
                <h2 class="text-xl font-semibold mb-4">Reported Posts</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-blue-600">
                        <thead>
                            <tr class="text-left text-sm font-semibold">
                                <th class="px-6 py-3">#</th>
                                <th class="px-6 py-3">Title</th>
                                <th class="px-6 py-3">Author</th>
                                <th class="px-6 py-3">Created</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-blue-700">
                            @forelse ($recentPosts as $index => $post)
                                @php
                                    $reportStatus = $post->reports->pluck('status')->unique()->implode(', ');
                                @endphp
                                <tr class="border-b border-blue-500">
                                    <td class="px-6 py-3">{{ $index + 1 }}</td>
                                    <td class="px-6 py-3">{{ $post->title }}</td>
                                    <td class="px-6 py-3">{{ $post->user->name ?? 'N/A' }}</td>
                                    <td class="px-6 py-3">{{ $post->created_at->diffForHumans() }}</td>
                                    <td class="px-6 py-3 capitalize">{{ $reportStatus ?: 'N/A' }}</td>
                                    <td class="px-6 py-3 text-center">
                                        <div class="flex gap-2 justify-center">
                                            <!-- View Post -->
                                            <a href="{{ route('admin.reports.show', $post) }}"
                                                class="bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium px-4 py-2 rounded transition">
                                                View
                                            </a>

                                            <!-- Accept -->
                                            <a href="{{ route('admin.reports.show', $post) }}"
                                                class="bg-green-500 hover:bg-green-600 text-white text-sm font-medium px-4 py-2 rounded transition">
                                                Accept
                                            </a>

                                            <!-- Reject -->
                                            <form action="{{ route('admin.reports.reject', $post->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit"
                                                    class="bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-4 py-2 rounded transition">
                                                    Reject
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center">No reported posts found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>
@endsection
