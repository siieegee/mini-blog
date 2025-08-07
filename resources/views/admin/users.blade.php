@extends('layouts.admin_app')

@section('content')
    <!-- Page Content -->
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
                                <th class="py-2">Date Registered</th>
                                <th class="py-2 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="border-b hover:bg-[#2e3b52]">
                                    <td class="py-2">{{ $user->name }}</td>
                                    <td class="py-2">{{ $user->email }}</td>
                                    <td class="py-2">{{ $user->created_at->format('M d, Y') }}</td>
                                    <td class="py-2">
                                        <div class="flex gap-2 justify-center">
                                            <a href="{{ route('admin.users.edit', $user) }}"
                                                class="bg-yellow-400 hover:bg-yellow-500 text-white font-semibold px-4 py-2 rounded text-sm">
                                                Edit
                                            </a>
                                            <a href="{{ route('admin.users.delete', $user) }}"
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
@endsection
