@props(['post'])
<div class="card">
    <a href="#">
        {{-- title --}}
        <h2 class="font-bold text-xl">{{ $post->title }}</h2>
        {{-- author and date --}}
        <div class="text-gray-600 mb-2">
            <span>Posted {{ $post->created_at->diffForHumans() }} by </span>
            <a href="{{ route('posts.user',$post->user) }}" class="text-blue-500 font-medium">{{ $post->user->username }}</a>{{-- user() will give the relationship type /if no brackets we get the collection type object user --}}
        </div>
        {{-- body --}}
        <div class="text-sm">
            <p>{{ Str::words($post->body, 15) }}</p>
        </div>
    </a>
</div>