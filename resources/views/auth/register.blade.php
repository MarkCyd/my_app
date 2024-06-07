<x-layout>
    <h1 class="title">Register a New Account</h1>
    <div class="mx-auto max-w-screen-sm card">
            {{-- username --}}
        <form action="{{ route('register') }}" method="post">
           @csrf

           <label for="fname">First Name</label>
           <input type="text" id="fname" name="fname" class="test">
            <div class="mb-4">
                <label for="username">UserName</label>
                <input class="border-2 border-rose-500" type="text" name="username">
                @error('username')
                    <p class="error"> {{ $message }}</p>
                @enderror
                </div>
            {{-- email --}}
            <div class="mb-4">
                <label for="email">Email</label>
                <input type="email" name="email" class="input-red">
                @error('email')
                <p class="error"> {{ $message }}</p>
                @enderror
            </div>
             {{-- password --}}
             <div class="mb-4">
                <label for="password">Password</label>
                <input type="password" name="password" class="input">
                @error('password')
                   <p class="error"> {{ $message }}</p>
                @enderror
            </div>
            {{-- confirm password --}}
            <div class="mb-8">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" class="input">
                @error('password_confirmation')
                <p class="error"> {{ $message }}</p>
                @enderror
            </div>
            {{-- Submit Button --}}
            <button class="btn">Register</button>
        </form>

    </div>
</x-layout>
