<x-app-layout>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <div
        class="min-h-screen bg-cover bg-center flex items-center justify-center p-6"
        style="background-image: url('{{ e($bgImage) }}');"
    >
        <div class="bg-white bg-opacity-80 backdrop-blur-sm rounded-lg shadow-lg max-w-4xl w-full p-8 border border-gray-300">
            <h1 class="text-3xl font-bold mb-6 text-gray-900">Edit Post</h1>

            <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}"
                        required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Content -->
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                    <textarea name="content" id="content" rows="5" required
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">{{ old('content', $post->content) }}</textarea>
                </div>

                <!-- Photo Upload with Live Preview -->
                <div x-data="{ fileName: '', previewUrl: '' }">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Upload Photo (optional)</label>

                    <label for="photo"
                        class="flex flex-col items-center justify-center w-full px-6 py-10 border-2 border-dashed border-gray-300 rounded-md text-blue-600 bg-gray-50 hover:bg-blue-50 hover:border-blue-400 cursor-pointer transition">

                        <svg class="w-12 h-12 mb-3 text-blue-500" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1M12 12v6m0 0l-3-3m3 3l3-3m3-6V7a4 4 0 00-4-4H9a4 4 0 00-4 4v5" />
                        </svg>

                        <template x-if="!previewUrl">
                            <p class="text-sm font-medium text-gray-700 mb-1">Upload file or drag and drop</p>
                        </template>
                        <template x-if="!previewUrl">
                            <p class="text-xs text-gray-500">PNG, JPG, JPEG, GIF up to 2MB</p>
                        </template>

                        <template x-if="previewUrl">
                            <img :src="previewUrl" alt="Image Preview"
                                class="mt-4 rounded-md shadow-md w-40 h-40 object-cover">
                        </template>

                        <template x-if="fileName">
                            <p class="text-sm text-gray-600 mt-2" x-text="fileName"></p>
                        </template>
                    </label>

                    <input type="file" name="photo" id="photo" accept=".png,.jpg,.jpeg,.gif"
                        class="hidden"
                        @change="
                            const file = $event.target.files[0];
                            fileName = file?.name || '';
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = e => previewUrl = e.target.result;
                                reader.readAsDataURL(file);
                            }
                        ">
                </div>

                <!-- Optional Photo URL -->
                <div>
                    <label for="photo_url" class="block text-sm font-medium text-gray-700">Or Photo URL (optional)</label>
                    <input type="url" name="photo_url" id="photo_url"
                        value="{{ old('photo_url', Str::startsWith($post->photo_path, ['http', 'https']) ? $post->photo_path : '') }}"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Submit and Cancel -->
                <div class="flex justify-end space-x-4">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded shadow">
                        Save Changes
                    </button>

                    <a href="{{ route('posts.show', $post) }}"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-4 py-2 rounded shadow">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
