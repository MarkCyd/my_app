<x-layout>
    <div class="mx-auto max-w-screen-sm card bg-gray-200 p-10 rounded-lg mt-4">
        <h1 class="text-3xl font-bold leading-9 text-slate-900 text-center mb-4">Register a New Account</h1>

        {{-- username --}}
        <form action="{{ route('register') }}" method="post">
            @csrf
            <div class="mb-4">
                <label for="username">User Name</label>
                <input class="input  @error('username')redborder @enderror" value="{{ old('username')  }}" type="text"
                    name="username">
                @error('username')
                <p class="error"> {{ $message }}</p>
                @enderror
            </div>
            {{-- email --}}
            <div class="mb-4">
                <label for="email">Email</label>
                <input type="text" name="email" value="{{ old('email') }}"
                    class="input  @error('email')redborder @enderror">
                @error('email')
                <p class="error"> {{ $message }}</p>
                @enderror
            </div>
            {{-- password --}}
            <div class="mb-4">
                <label for="password">Password</label>
                <input type="password" name="password" class="input  @error('password')redborder @enderror">
                @error('password')
                <p class="error"> {{ $message }}</p>
                @enderror
            </div>
            {{-- confirm password --}}
            <div class="mb-8">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation"
                    class="input  @error('password')redborder @enderror">
                @error('password_confirmation')
                <p class="error"> {{ $message }}</p>
                @enderror
            </div>
            {{-- Submit Button --}}
            <button class="btn">Register</button>
        </form>

    </div>
</x-layout>
