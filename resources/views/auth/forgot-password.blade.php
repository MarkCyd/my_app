<x-layout>
    <div class="mx-auto max-w-screen-md card bg-gray-200 p-3 rounded-lg mt-4">
        <h1 class="title">Request Password Reset</h1>
        @if(session('status'))
        <div >
            <x-flashMSG msg="{{ session('status') }}"/>{{-- just add a bg="any bg color you like in an if else statement to change bg colro" --}}
        </div>
        @endif
        <form action="{{ route('password.request') }}" method="post" x-data="formSubmit" @submit.prevent="submit">
            @csrf
           
            {{-- email --}}
            <div class="mb-4">
                <label for="email">Email</label>
                <input type="text" name="email" value="{{ old('email') }}"
                    class="input  @error('email')redborder @enderror">
                @error('email')
                <p class="error"> {{ $message }}</p>
                @enderror
            </div>
            
           {{-- Submit Button --}}
            <button x-ref="btn" class="btn">Submit</button>
        </form>

    </div>
</x-layout>
