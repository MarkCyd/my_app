<x-layout>
<div class="card mb-4 container mx-auto w-3/6 mt-3">

<a href="{{ route('dashboard') }}">&larr; Back to the Dashboard</a>
<p class="mb-4"></p>
<h2 class="font-bold mb-2">Update Post</h2>    
<form action="{{ route('posts.update', $post) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
     {{-- session message --}}
     @if(session('success'))
     <div >
         <x-flashMSG msg="{{ session('success') }}"/>{{-- just add a bg="any bg color you like in an if else statement to change bg colro" --}}
     </div>
     @elseif(session('update'))
     <div >
         <x-flashMSG msg="{{ session('update') }}" bg="bg-red-500"/>{{-- just add a bg="any bg color you like in an if else statement to change bg colro" --}}
     </div>
     @endif
    {{-- post title --}}
    <div class="mb-4">
        <label for="title">Post Title</label>
        <input type="text" name="title" value="{{ $post->title }}"
            class="input  @error('title')redborder @enderror">
        @error('title')
        <p class="error"> {{ $message }}</p>
        @enderror
    </div>
    {{-- post body --}}
    <div class="mb-4">
        <label for="body">Post Content</label>
       <textarea name="body" rows="10" class="input  @error('body')redborder @enderror">{{  $post->body }}</textarea>
        @error('body')
        <p class="error"> {{ $message }}</p>
        @enderror
    </div>
    {{-- current cover photo if it exist --}}
     <div class=" rouded-md mb-4 w-1/4 object-cover">
     @if ($post->image)
        <label>Cover Photo</label>
        <img src="{{ asset('storage/' . $post->image) }}" alt=""> {{-- show uploaded file path posible usage for download --}}
     @endif
    </div>
   
     {{-- post image --}}
     <div class=" mb-4">
        <label class="mt-4" for="image">Update Photo</label>
        <input type="file" name="image" id="image">
     </div>
     @error('image')
     <p class="error mb-4"> {{ $message }}</p>
     @enderror
    {{-- submit button --}}
    <button class="btn">Update</button>
</form>
</div>
</x-layout>