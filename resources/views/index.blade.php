<!DOCTYPE html>
<html lang="en" data-theme="dracula">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rethink+Sans:ital,wght@0,400..800;1,400..800&display=swap"
        rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    @vite('resources/css/app.css')
</head>

<body>
    {{-- @if (Route::has('login'))
        <nav class="-mx-3 flex flex-1 justify-end">
            @auth
                <a href="{{ url('/dashboard') }}"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                    Log in
                </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                        Register
                    </a>
                @endif
            @endauth
        </nav>
    @endif --}}
</body>
<div class="navbar bg-base-100">

    <div class="flex-1">
        <a class="btn btn-ghost text-xl">RegisterEase</a>
    </div>
    <div class="flex-none">
        <ul class="menu menu-horizontal px-1 flex gap-3">
            @if (Route::has('login'))
                <li><a href="{{ route('login') }}" class="btn btn-sm btn-secondary">Login</a></li>
            @endif
            @if (Route::has('register'))
                <li><a href="{{ route('register') }}" class="btn btn-sm btn-accent btn-outline">Register</a></li>
            @endif
        </ul>
    </div>

</div>

<div class="container flex flex-col justify-center items-center h-[50vh]">

</div>

</html>
