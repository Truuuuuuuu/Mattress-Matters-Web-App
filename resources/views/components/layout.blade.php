<!doctype html>
<html lang="en" data-theme="light">
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
<div>
    @if (!isset($hideNavbar))
        <nav class=" sticky top-0 z-50 bg-base-100 shadow flex justify-between items-center py-4 border-b border-white/10 p-5">
            {{-- Logo --}}
            <div>
                <a href="/">
                    <img src="{{ asset('images/logo-only.svg') }}" alt="" class="w-10 h-auto">
                </a>
            </div>

            @auth
                {{--Middle links--}}
                <div class="text-base-content flex gap-10 font-semibold">
                    <a href="">Browse</a>
                    <a href="">My Home</a>
                </div>

                <!-- Search -->
                <div class="w-100 text-base-content">
                    @include('components.search-bar')
                </div>

                <div class="space-x-3 font-bold flex">
                    <div class="btn btn-ghost btn-circle bg-blue-200">
                            <h1>{{Auth::user()->name[0]}}</h1>
                    </div>
                    <div class="dropdown dropdown-end" >
                        <div class="btn btn-ghost btn-circle bg-gray-200" tabindex="0" role="button">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />

                            </svg>
                        </div>
                        <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-1 w-52 p-2 shadow-sm font-normal">
                            <li><a >Settings</a></li>
                            <li><a><form method="POST" action="/logout">
                                        @csrf
                                        @method('DELETE')
                                        <button class="hover:cursor-pointer">Log Out</button>
                                    </form>
                            </a></li>
                        </ul>
                    </div>

                </div>
            @endauth

            @guest
                <div class="space-x-6 font-semibold">
                    <a href="/user-option" class="btn btn-primary">Get Started</a>
                    <a href="/login" class="text-base-content">Sign in</a>
                </div>
            @endguest
        </nav>
    @endif


    <main>
        {{ $slot }}
    </main>
</div>
</body>
</html>
