<x-layout>
    <h1 class="title">{{ $user->username }}s Posts &#9830; {{ $posts->total() }}</h1>
                                                                {{-- ->count() will only show the pagination size of 6 or what was display or loop  --}}
    <div class="grid-2-cols container mx-auto">
        @foreach ($posts as $post)
        <x-postCard :post="$post"/>
        @endforeach
    </div>
    <div>{{ $posts->links() }}</div>
    
</x-layout>