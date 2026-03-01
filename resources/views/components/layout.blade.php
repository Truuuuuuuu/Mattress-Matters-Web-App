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
                <div class="flex-shrink-0 ">
                    <a href="/">
                        <img src="{{ asset('images/logo-only.svg') }}" alt="" class="w-10 h-auto" >
                    </a>
                </div>

                @auth
                    @role('tenant')
                      {{--  <div class="flex-1 w-md border">
                            <!-- Search -->
                            <div class=" w-full max-w-xs lg:max-w-lg  text-base-content">
                                @include('components.search-bar')
                            </div>
                        </div>--}}

                    {{-- links --}}
                    <div class="hidden lg:flex text-base-content  gap-8 items-center whitespace-nowrap font-semibold lg:absolute left-1/2 -translate-x-1/2">
                        <div>
                            <a href="{{route('tenant.homepage')}}" class="text-center block" >Explore</a>
                            <div class="{{request()->routeIs('tenant.homepage', 'listings.index') ? 'bg-black w-17 h-1 rounded-xl' : ''}}"></div>
                        </div>
                        <div>
                            <a href="{{route('tenant.unit')}}" class="text-center block" >My Unit</a>
                            <div class="{{request()->routeIs('tenant.unit') ? 'bg-black w-17 h-1 rounded-xl' : ''}}"></div>
                        </div>
                        <div>
                            <a href="{{route('tenant.reservation')}}" class="text-center block" >Reservation</a>
                            <div class="{{request()->routeIs('tenant.reservation') ? 'bg-black w-24 h-1 rounded-xl' : ''}}"></div>
                        </div>


                    </div>


                    @endrole

                    @role('host')
                    {{-- links --}}
                    <div class="hidden lg:flex text-base-content  gap-10 font-semibold lg:absolute left-1/2 -translate-x-1/2">
                        <a href="">Reservations</a>
                        <a href="">Listings</a>

                    </div>
                    @endrole
                @endauth




                @guest
                    <div class="space-x-6 font-semibold ">
                        <a href="/user-option" class="btn btn-primary">Get Started</a>
                        <a href="/login" class="text-base-content">Sign in</a>
                    </div>
                @endguest

                @auth
                        <div class="flex space-x-3 font-bold ">
                            <div class="flex btn btn-ghost btn-circle lg:bg-gray-200 lg:text-black" tabindex="0" role="button">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-15 lg:size-6">
                                    <path fill-rule="evenodd" d="M4.804 21.644A6.707 6.707 0 0 0 6 21.75a6.721 6.721 0 0 0 3.583-1.029c.774.182 1.584.279 2.417.279 5.322 0 9.75-3.97 9.75-9 0-5.03-4.428-9-9.75-9s-9.75 3.97-9.75 9c0 2.409 1.025 4.587 2.674 6.192.232.226.277.428.254.543a3.73 3.73 0 0 1-.814 1.686.75.75 0 0 0 .44 1.223ZM8.25 10.875a1.125 1.125 0 1 0 0 2.25 1.125 1.125 0 0 0 0-2.25ZM10.875 12a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Zm4.875-1.125a1.125 1.125 0 1 0 0 2.25 1.125 1.125 0 0 0 0-2.25Z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="hidden lg:flex btn btn-ghost btn-circle bg-blue-200">
                                <h1>{{Auth::user()->name[0]}}</h1>
                            </div>
                            <div class="hidden lg:flex dropdown dropdown-end" >
                                <div class="btn btn-ghost btn-circle bg-gray-200" tabindex="0" role="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />

                                    </svg>
                                </div>
                                <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-50 mt-13 w-52 p-2 shadow-sm font-normal">
                                    <li><a >Settings</a></li>
                                    <li><a><form method="POST" action="/logout">
                                                @csrf
                                                @method('DELETE')
                                                <button class="hover:cursor-pointer">Log Out</button>
                                            </form>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                @endauth

        </nav>
    @endif


    <main>
        {{ $slot }}
    </main>
</div>
</body>
</html>
