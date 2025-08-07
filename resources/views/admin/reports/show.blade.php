@extends('layouts.admin_app')

@section('content')
    <div
        x-data="{ reportOpen: false }"
        class="min-h-screen bg-cover bg-center flex flex-col items-center justify-start p-6"
        style="background-image: url('{{ e($bgImage) }}');"
    >
        <!-- Flash success message -->
        @if(session('success'))
            <div class="bg-green-600 text-white px-4 py-2 rounded shadow mb-4 w-full max-w-4xl text-center">
                {{ session('success') }}
            </div>
        @endif

        <!-- Post Card -->
        <div class="bg-white bg-opacity-60 backdrop-blur-sm rounded-lg shadow-lg max-w-4xl w-full p-8 border border-gray-300 flex space-x-6 items-start mt-6">
            @if ($imageSrc)
                <img src="{{ $imageSrc }}"
                    alt="Post Image"
                    class="w-[200px] h-[300px] object-cover rounded-md shadow">
            @endif
            <div class="flex-1 flex flex-col justify-start">
                <div class="bg-white bg-opacity-60 backdrop-blur-sm rounded-md p-4">
                    <h1 class="text-3xl font-bold text-gray-900">{{ $post->title }}</h1>
                    <p class="text-sm text-gray-600 mt-1 mb-4">
                        Posted by <span class="font-medium text-gray-800">{{ $post->user->name }}</span>
                        on {{ $post->created_at->format('F j, Y') }}
                    </p>
                    <p class="text-gray-800 whitespace-pre-line">{{ $post->content }}</p>
                </div>

                <div class="mt-6 flex flex-wrap gap-4">
                    <a href="{{ route('admin.dashboard') }}"
                        class="bg-blue-800 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded transition">
                        Back to Dashboard
                    </a>

                    <!-- Hide Post Button -->
                    <form action="{{ route('admin.reports.hide', $post) }}" method="POST" class="inline-block">
                        @csrf
                        <button type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded transition">
                            Hide Post
                        </button>
                    </form>

                    <!-- Notify Author Button -->
                    <form action="{{ route('admin.reports.notify', $post) }}" method="POST" class="inline-block">
                        @csrf
                        <button type="submit"
                            class="bg-yellow-600 hover:bg-yellow-700 text-white font-semibold px-4 py-2 rounded transition">
                            Notify Author
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Report Reasons Section -->
        @if($post->reports->count())
            <div class="bg-white bg-opacity-70 backdrop-blur-md rounded-lg shadow-lg max-w-4xl w-full mt-8 p-6 border border-red-300">
                <h2 class="text-2xl font-semibold text-red-700 mb-4">Report Details</h2>
                @foreach($post->reports as $report)
                    <div class="mb-4 p-4 border border-red-200 rounded-md bg-red-50">
                        <p class="text-sm text-red-800"><strong>Reason:</strong> {{ $report->reason }}</p>
                        @if($report->description)
                            <p class="text-sm text-red-700 mt-1"><strong>Description:</strong> {{ $report->description }}</p>
                        @endif
                        <p class="text-xs text-gray-600 mt-1 italic">Reported {{ $report->created_at->diffForHumans() }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
