<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('app_name') }}</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-slate-100 text-slate-900">
    <header class="bg-slate-800 shadow-lg">
        <nav>
            <a href="{{ route('home') }}" class="nav-link">Home</a>
            @guest
            <div class="flex item-center gap-4">
                <a href="{{ route('login') }}" class="nav-link">Login</a>
                <a href="{{ route('register') }}" class="nav-link">Register</a>
            </div>
            @endguest
            @auth
            <div class="relative grid place-item-center" x-data="{open:false}">
                {{-- drop down menu button --}}
                <button @click="open = !open" class="round-btn">
                <img src="https://picsum.photos/200" alt="">
                </button>
                {{-- drop down menu --}}
                <div x-show="open" @click.outside="open = false" class="bg-white shadow-lg absolute top-10 right-0 rounded-lg overflow-hidden font-light flex flex-col items-center p-4">
                    <p class="username mb-2">{{ auth()->user()->username }}</p>
                    <a href="{{ route('dashboard') }}" class="block hover:bg-slate-100 pl-10 pr-10 py-2 mb-1">Dashboard</a>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="block hover:bg-slate-100 pl-10 pr-10 py-2 mb-1">Logout</button>
                    </form>
                </div>
            </div>
            @endauth
        </nav>
    </header>
    <main>
        {{ $slot }}
    </main class="py-8 px-4 mx-auto max-w-screen-lg">
</body>

</html>
