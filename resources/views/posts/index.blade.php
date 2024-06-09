<x-layout>
    <h1 class="title text-left font-bold text-2xl mb-6">Latest Post</h1>
    <div class="grid-2-cols container mx-auto">
        @foreach ($posts as $post)
            <div class="card">
                <a href="#">
                    {{-- title --}}
                    <h2 class="font-bold text-xl">{{ $post->title }}</h2>
                    {{-- author and date --}}
                    <div class="text-gray-600 mb-2">
                        <span>Posted {{ $post->created_at->diffForHumans() }} by </span>
                        <a href="#" class="text-blue-500 font-medium">username</a>
                    </div>
                    {{-- body --}}
                    <div class="text-sm">
                        <p>{{ Str::words($post->body, 15) }}</p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    <div>{{ $posts->links() }}</div>
</x-layout>
