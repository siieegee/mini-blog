@extends('layouts.admin_app')

@section('content')
    <nav x-data="{ open: false }" class="shadow-md" style="background-color: #669bbc;">

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
@endsection
