<x-layout>

        <h1 class="title text-center">Welcome {{ auth()->user()->username }} you have {{ $posts->total() }} posts</h1>

        {{-- create post form --}}
        <div class="card mb-4 container mx-auto w-3/6">
            <h2 class="font-bold mb-4">Create New Post</h2>
            
            {{-- session message --}}
            @if(session('success'))
            <div >
                <x-flashMSG msg="{{ session('success') }}"/>{{-- just add a bg="any bg color you like in an if else statement to change bg colro" --}}
            </div>
            @elseif(session('delete'))
            <div >
                <x-flashMSG msg="{{ session('delete') }}" bg="bg-red-500"/>{{-- just add a bg="any bg color you like in an if else statement to change bg colro" --}}
            </div>
            @endif
        
            <form action="{{ route('posts.store') }}" method="post">
                @csrf
                {{-- post title --}}
                <div class="mb-4">
                    <label for="title">Post Title</label>
                    <input type="text" name="title" value="{{ old('title') }}"
                        class="input  @error('title')redborder @enderror">
                    @error('title')
                    <p class="error"> {{ $message }}</p>
                    @enderror
                </div>
                {{-- post body --}}
                <div class="mb-4">
                    <label for="body">Post Content</label>
                   <textarea name="body" rows="10" class="input  @error('body')redborder @enderror">{{ old('body') }}</textarea>
                    @error('body')
                    <p class="error"> {{ $message }}</p>
                    @enderror
                </div>
                {{-- submit button --}}
                <button class="btn">create</button>
            </form>
       
    </div>    
        {{-- User post --}}
        <h2 class="mb-4 container mx-auto w-3/6">Your Latest Post</h2>
        <div class="grid-2-cols container mx-auto">
            @foreach ($posts as $post)
            <x-postCard :post="$post"> 
            {{-- update post --}}
            <a href="{{ route('posts.edit',$post) }}" class="bg-green-500 text-gray-100 px-2 py-1 text-xs rounded-md">Update</a>
            {{-- delete button --}}
               <form action="{{ route('posts.destroy',$post) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-500 text-gray-100 px-2 py-1 text-xs rounded-md">Delete</button>
               </form>
            </x-postCard>  
            @endforeach
        </div>
        <div class="">{{ $posts->links() }}</div>
  </x-layout>
