<x-layout>
    <h1 class="title text-left font-bold text-2xl mb-6">Latest Post</h1>
     
    <div class="grid-2-cols container mx-auto">
        @foreach ($posts as $post)
        <x-postCard :post="$post"/>
        @endforeach
    </div>
    <div>{{ $posts->links() }}</div>
</x-layout>
