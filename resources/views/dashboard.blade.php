<x-app-layout>
    <nav x-data="{ open: false }" class="bg-white">
        <!-- your navbar HTML here -->
    </nav>

    @php
        $bgImage = asset('images/dashboard_bg.png');
    @endphp

    <div class="min-h-screen bg-cover bg-center" style="background-image: url('{{ $bgImage }}');">
        <div class="min-h-screen bg-gradient-to-b from-black/70 via-black/30 to-black/70">
            <main class="max-w-7xl mx-auto p-6">

                <!-- Title and Create Post Button -->
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-bold text-white" style="text-shadow: 1px 2px 4px rgba(0,0,0,0.8);">
                        Your Posts
                    </h1>
                    <a href="{{ route('posts.create') }}"
                        class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition">
                        + Create Post
                    </a>
                </div>

                @if ($posts->isEmpty())
                    <p class="text-white text-center">You have no posts yet.</p>
                @else
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
                        @foreach ($posts as $post)
                            <article class="flex flex-col items-center text-center">
                                <a href="{{ route('posts.show', $post) }}" class="group w-full">
                                    {{-- Photo Display --}}
                                    @if ($post->photo_path)
                                        @php
                                            $imageSrc = \Illuminate\Support\Str::startsWith($post->photo_path, ['http://', 'https://'])
                                                ? $post->photo_path
                                                : asset('storage/' . $post->photo_path);
                                        @endphp

                                        <img src="{{ $imageSrc }}"
                                            alt="Post Image"
                                            class="w-[200px] h-[300px] object-cover rounded-md shadow-2xl group-hover:opacity-90 transition mx-auto">
                                    @endif

                                    {{-- Title below the image --}}
                                    <h2 class="mt-3 text-xl font-semibold text-white" style="text-shadow: 1px 2px 4px rgba(0,0,0,0.8);">
                                        {{ $post->title }}
                                    </h2>
                                </a>
                            </article>
                        @endforeach
                    </div>
                @endif
            </main>
        </div>
    </div>
</x-app-layout>
