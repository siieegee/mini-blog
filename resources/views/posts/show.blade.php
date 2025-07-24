<x-app-layout>
    <div
        class="min-h-screen bg-cover bg-center flex flex-col items-center justify-start p-6"
        style="background-image: url('{{ e($bgImage) }}');"
    >
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

                <div class="mt-6 flex space-x-4">
                    <a href="{{ route('dashboard') }}"
                        class="bg-blue-800 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded transition">
                        Back to Posts
                    </a>
                    @if(auth()->check() && auth()->id() === $post->user_id)
                        <a href="{{ route('posts.edit', $post) }}"
                            class="bg-yellow-400 hover:bg-yellow-500 text-white font-semibold px-4 py-2 rounded">
                            Edit
                        </a>
                        <a href="{{ route('posts.delete', $post) }}"
                            class="bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded">
                            Delete
                        </a>
                    @endif
                </div>
            </div>
        </div>

        
        <!-- Comments Section -->
        <div class="bg-white bg-opacity-60 backdrop-blur-sm rounded-lg shadow-lg max-w-4xl w-full p-6 border border-gray-300 mt-8">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Comments</h2>
            
            @if($post->comments->count())
                <div class="space-y-4">
                    @foreach($post->comments as $comment)
                        <div class="bg-gray-50 bg-opacity-80 p-4 rounded-lg border border-gray-200 shadow-sm">
                            <p class="text-gray-900 font-medium leading-relaxed">{{ $comment->body }}</p>
                            <p class="text-sm text-gray-600 mt-2 font-medium">
                                — {{ $comment->user->name }} on {{ $comment->created_at->format('F j, Y g:i A') }}
                            </p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-700 font-medium">No comments yet. Be the first to comment!</p>
            @endif
            
            <!-- Add Comment Form -->
            @auth
                <form action="{{ route('comments.store', $post) }}" method="POST" class="mt-6">
                    @csrf
                    <label for="body" class="block text-sm font-semibold text-gray-800">Add a comment:</label>
                    <textarea name="body" id="body" rows="3" required
                        placeholder="Write your comment here..."
                        class="w-full mt-1 p-3 text-xs border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 bg-white bg-opacity-95"></textarea>
                    <button type="submit"
                        class="mt-3 bg-blue-800 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Post Comment
                    </button>
                </form>
            @else
                <p class="mt-4 text-gray-800 font-medium">
                    <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-semibold">Login</a> to post a comment.
                </p>
            @endauth
        </div>
    </div>
</x-app-layout>