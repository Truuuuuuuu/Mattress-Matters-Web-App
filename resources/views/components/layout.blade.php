<!doctype html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link
        rel="stylesheet">
    <title>{{$heading}}</title>
    @vite(['resources/js/app.js'])
</head>
<body class="text-black">
<div class="px-10">
    <nav class="flex justify-between items-center py-4 border-b border-white/10">
        <div>
            <a href="/">
                <img src="{{ asset('images/logo-only.svg') }}" alt="" class="w-10 h-auto">
            </a>
        </div>

        @auth
            <div class="space-x-6 font-bold flex">
                <a href="/jobs/create">Post a job</a>
                <form method="POST" action="/logout">
                    @csrf
                    @method('DELETE')
                    <button class="hover:cursor-pointer">Log Out</button>
                </form>
            </div>
        @endauth

        @guest
            <div class="space-x-6 font-semibold">
                <a href="/register" class="btn btn-primary">Get Started</a>
                <a href="/login" class="text-base-content">Sign in</a>
            </div>
        @endguest
    </nav>

    <main>
        {{ $slot }}
    </main>
</div>
</body>
</html>
