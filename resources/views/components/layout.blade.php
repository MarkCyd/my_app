<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('app_name') }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-900">
    <header class="bg-slate-800 shadow-lg">
        <nav>
            <a href="" class="nav-link">Home</a>
            <div class="flex item-center gap-4">
            <a href="" class="nav-link">Login</a>
            <a href="" class="nav-link">Register</a>
            </div>
        </nav>
    </header>
    <main>
        {{ $slot }}
    </main class="py-8 px-4 mx-auto max-w-screen-lg">
</body>
</html>