<x-app-layout>
    <div
        class="min-h-screen bg-cover bg-center flex items-center justify-center p-6"
        style="background-image: url('{{ e($bgImage) }}');"
    >
        <div class="bg-white bg-opacity-60 backdrop-blur-sm rounded-lg shadow-lg max-w-4xl w-full p-8 border border-gray-300 flex space-x-6 items-start">

            {{-- Optional small image preview --}}
            @if ($imageSrc)
                <img src="{{ $imageSrc }}"
                     alt="Post Image"
                     class="w-[200px] h-[300px] object-cover rounded-md shadow">
            @endif

            <div class="flex-1 flex flex-col justify-start">
                <!-- Title -->
                <h1 class="text-3xl font-bold text-gray-900">{{ $post->title }}</h1>

                <!-- Author and Date -->
                <p class="text-sm text-gray-600 mt-1 mb-4">
                    Posted by <span class="font-medium text-gray-800">{{ $post->user->name }}</span> on {{ $post->created_at->format('F j, Y') }}
                </p>

                <!-- Content -->
                <p class="text-gray-800 whitespace-pre-line">{{ $post->content }}</p>

                <!-- Action Buttons -->
                <div class="mt-6 flex space-x-4">
                    <a href="{{ route('dashboard') }}"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold px-4 py-2 rounded">
                        Back to Dashboard
                    </a>

                    @if(auth()->check() && auth()->id() === $post->user_id)
                        <a href="{{ route('posts.edit', $post) }}"
                            class="bg-yellow-400 hover:bg-yellow-500 text-white font-semibold px-4 py-2 rounded">
                            Edit
                        </a>

                        <form action="{{ route('posts.destroy', $post) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this post?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded">
                                Delete
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
