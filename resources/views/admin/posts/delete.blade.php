<x-app-layout>
    <div
        class="min-h-screen flex items-center justify-center p-6"
        style="background-color: #669bbc; color: #e0e1dd;"
    >
        <div class="rounded-lg shadow-lg max-w-4xl w-full p-8 flex space-x-6 items-start"
            style="background-color: #1b263b;">
            <div class="flex-1 text-center text-[#e0e1dd]">
                <h2 class="text-2xl font-bold mb-4">Delete Post</h2>

                <p class="mb-6">
                    Are you sure you want to delete the post<br>
                    <strong>"{{ $post->title }}"</strong>?
                </p>

                <div class="flex justify-center space-x-4">
                    <a href="{{ route('admin.posts') }}" 
                        class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                        Cancel
                    </a>

                    <form method="POST" action="{{ route('admin.posts.destroy', $post->id) }}">
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
