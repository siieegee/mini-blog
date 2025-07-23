<x-app-layout>
    <div
        class="min-h-screen flex items-center justify-center p-6 bg-cover bg-center"
        style="background-image: url('https://i.pinimg.com/1200x/b9/94/bc/b994bc148ce83758a93cc6b7e70ded06.jpg');"
    >
        <div class="bg-white bg-opacity-60 backdrop-blur-sm rounded-lg shadow-lg max-w-4xl w-full p-8 border border-gray-300 flex space-x-6 items-start">
            <div class="flex-1 text-center">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Delete Post</h2>

                <p class="text-gray-700 mb-6">
                    Are you sure you want to delete the post<br>
                    <strong>"{{ $post->title }}"</strong>?
                </p>

                <div class="flex justify-center space-x-4">
                    <a href="{{ route('dashboard') }}" 
                       class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                       Cancel
                    </a>

                    <form method="POST" action="{{ route('posts.destroy', $post) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                            Confirm Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
