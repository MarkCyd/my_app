@props(['post','full'=>false])
<div class="flex px-4 min-h-44 items-center card container  mx-auto mt-3">
    {{-- show uploaded image  --}}
    <div class=" w-40">
    @if ($post->image)
     
        <img src="{{ asset('storage/' . $post->image) }}" alt=""> {{-- show uploaded file path posible usage for download --}}
  
     @else
     <img src="{{ asset('storage/posts_images/default.jpg') }}" alt="">
     @endif
    </div>
    {{-- title --}}
    <h2 class="font-bold text-xl px-2">{{ $post->title }}</h2>
    {{-- author and date --}}
    <div class="text-gray-600 mb-2">
        <span>Posted {{ $post->created_at->diffForHumans() }} by </span>
        <a href="{{ route('posts.user',$post->user) }}" class="text-blue-500 font-medium">{{ $post->user->username
            }}</a>{{-- user() will give the relationship type /if no brackets we get the collection type object user
        --}}
    </div>
    {{-- body --}}
    @if ($full)
    <div class="text-sm">
        <span>{{ $post->body }}</span>
      
    </div>
    @else
    <div class="text-sm">
        <span>{{ Str::words($post->body, 15) }}</span>
        <a href="{{ route('posts.show',$post) }}" class="text-blue-500 ml-2">Read more &rarr;</a>
    </div>
    @endif
    <div class="flex item-center justify-end gap-4 mt-6">
    {{ $slot }}    
    </div>    
</div>