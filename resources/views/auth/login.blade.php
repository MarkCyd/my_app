<x-layout>
    <div class="mx-auto max-w-screen-sm card bg-gray-200 p-10 rounded-lg mt-4">
        <h1 class="title">Welcome Back</h1>


        <form action="{{ route('login') }}" method="post">
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
            {{-- password --}}
            <div class="mb-4">
                <label for="password">Password</label>
                <input type="password" name="password" class="input  @error('password')redborder @enderror">
                @error('password')
                <p class="error"> {{ $message }}</p>
                @enderror
            </div>
            {{-- remember me song --}}
            <div class="flex mb-6 gap-2">
                <input type="checkbox" name="remember" id="remember">
                <label for="rememberme">Remember Me</label>

            </div>
            @error('failed')
            <p class="error mb-4"> {{ $message }}</p>
            @enderror
            {{-- Submit Button --}}
            <button class="btn">Login</button>
        </form>

    </div>
</x-layout>
