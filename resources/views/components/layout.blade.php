<!doctype html >
<html lang="en" data-theme="{{ auth()->user()->theme ?? 'light' }}">
<head>
    <meta charset="UTF-8">
    <meta name="user-id" content="{{ Auth::id() ?? '' }}">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link
        rel="stylesheet">
    <title>{{$heading}}</title>
    @vite(['resources/js/app.js'])

</head>
<body class="text-base-content">
<div>
    @if (!isset($hideNavbar))

        @guest
            <nav
                class="lg:hidden flex sticky top-0 z-50 bg-base-100 shadow justify-between items-center py-4 border-b border-white/10 p-5">
                {{-- Logo --}}
                <div class="shrink-0 ">
                    <img src="{{ asset('images/logo-only.svg') }}" alt="" class="w-10 h-auto">
                </div>
                <div class="space-x-6 font-semibold ">
                    <a href="{{ route('email.register') }}" class="btn btn-primary">Get Started</a>
                    <a href="/login" class="text-base-content">Sign in</a>
                </div>
            </nav>
        @endguest
        @role('tenant')
        {{--MOBILE SCREEN--}}
        <nav
            class="lg:hidden fixed bottom-0 left-0 right-0 z-50 bg-base-100 border-t border-base-300 flex justify-around items-center h-16">
            <a href="{{ route('tenant.homepage') }}"
               class="flex flex-col items-center text-xs gap-1  {{request()->routeIs('tenant.homepage') ? 'font-bold text-primary' : 'text-base-content/70'}}">
                <x-lucide-search class="w-5 h-5" stroke-width="{{request()->routeIs('tenant.homepage') ? 2.5 : 2}}"/>
                <span {{request()->routeIs('tenant.homepage') ? 'text-primary' : 'text-base-content'}}>Explore</span>
            </a>
            <a href="{{ route('reservation.index') }}"
               class="flex flex-col items-center text-xs gap-1 {{request()->routeIs('reservation.index') ? 'font-bold text-primary' : 'text-base-content/70'}}">
                <x-lucide-calendar-check class="w-5 h-5"
                                         stroke-width="{{request()->routeIs('reservation.index') ? 2.5 : 2}}"/>
                <span {{request()->routeIs('reservation.index') ? 'text-primary' : 'text-base-content'}}>Reservation</span>
            </a>
            <a href="{{ route('tenant.unit') }}"
               class="flex flex-col items-center text-xs gap-1 {{request()->routeIs('tenant.unit') ? 'font-bold text-primary' : 'text-base-content/70'}}">
                <x-lucide-house-heart class="w-5 h-5" stroke-width="{{request()->routeIs('tenant.unit') ? 2.5 : 2}}"/>
                <span>My Unit</span>
            </a>
            <a href="{{route('messages.inbox', auth()->user()->id)}}"
               class="flex flex-col items-center text-xs gap-1 text-base-content/70 {{request()->routeIs('messages.inbox') || request()->routeIs('messages.show')  ? 'font-bold text-primary' : 'text-base-content/70'}}">
                <x-lucide-message-circle-more class="w-5 h-5 "
                                         stroke-width="{{request()->routeIs('messages.inbox') || request()->routeIs('messages.show') ? 2.5 : 2}}"/>
                <span
                    class="{{request()->routeIs('messages.inbox') || request()->routeIs('messages.show') ? 'text-primary' : 'text-base-content'}} ">Messages</span>
            </a>
            <a href="{{ route('profile.index') }}"
               class="flex flex-col items-center text-xs gap-1 {{request()->routeIs('profile.index') ? 'font-bold text-primary' : 'text-base-content/70'}}">
                <x-lucide-user class="w-5 h-5" stroke-width="{{request()->routeIs('profile.index') ? 2.5 : 2}}"/>
                <span
                    class="{{request()->routeIs('profile.index') ? 'text-primary' : 'text-base-content'}}">Profile</span>
            </a>
        </nav>
        @endrole

        @role('host')
        {{--MOBILE SCREEN--}}
        <nav
            class="lg:hidden fixed bottom-0 left-0 right-0 z-50 bg-base-100 border-t border-base-300 flex justify-around items-center h-16">
            <a href="{{route('reservation.index')}}"
               class="flex flex-col items-center text-xs gap-1  {{request()->routeIs('reservation.index') ? 'font-bold text-base-content' : 'text-base-content/70'}}">
                <x-lucide-calendar-check
                    class="w-5 h-5 {{request()->routeIs('reservation.index') ? 'text-primary' : 'text-base-content'}}"
                    stroke-width="{{request()->routeIs('reservation.index') ? 2.5 : 2}}"/>
                <span class="{{request()->routeIs('reservation.index') ? 'text-primary' : 'text-base-content'}}">Reservations</span>
            </a>
            <a href="{{route('host.listings')}}"
               class="flex flex-col items-center text-xs gap-1 {{request()->routeIs('host.listings') ? 'font-bold text-base-content' : 'text-base-content/70'}}">
                <x-lucide-building
                    class="w-5 h-5 {{request()->routeIs('host.listings') ? 'text-primary' : 'text-base-content'}}"
                    stroke-width="{{request()->routeIs('host.listings') ? 2.5 : 2}}"/>
                <span>Listings</span>
            </a>
            <a href="{{route('host.dashboard')}}"
               class="flex flex-col items-center text-xs gap-1 {{request()->routeIs('host.dashboard') ? 'font-bold text-base-content' : 'text-base-content/70'}}">
                <x-lucide-layout-dashboard
                    class="w-5 h-5 {{request()->routeIs('host.dashboard') ? 'text-primary' : 'text-base-content'}}"
                    stroke-width="{{request()->routeIs('host.dashboard') ? 2.5 : 2}}"/>
                <span
                    class="{{request()->routeIs('host.dashboard') ? 'text-primary' : 'text-base-content'}}">Dashboard</span>
            </a>
            <a href="{{route('host.tenants.index')}}"
               class="flex flex-col items-center text-xs gap-1 {{request()->routeIs('host.tenants.index', 'host.tenants.show') ? 'font-bold text-base-content' : 'text-base-content/70'}}">
                <x-lucide-users
                    class="w-5 h-5 {{request()->routeIs('host.tenants.index') ? 'text-primary' : 'text-base-content'}}"
                    stroke-width="{{request()->routeIs('host.tenants.index', 'host.tenants.show') ? 2.5 : 2}}"/>
                <span class="{{request()->routeIs('host.tenants.index') ? 'text-primary' : 'text-base-content'}}">Tenants</span>
            </a>
            <a href="{{ route('messages.inbox') }}"
               class="flex flex-col items-center text-xs gap-1 {{request()->routeIs('messages.inbox') ? 'font-bold text-base-content' : 'text-base-content/70'}}">
                <x-lucide-message-circle-more
                    class="w-5 h-5 {{request()->routeIs('messages.inbox') ? 'text-primary' : 'text-base-content'}}"
                    stroke-width="{{request()->routeIs('messages.inbox') ? 2.5 : 2}}"/>
                <span
                    class="{{request()->routeIs('messages.inbox') ? 'text-primary' : 'text-base-content'}}">Message</span>
            </a>
        </nav>
        @endrole

        {{--LARGE SCREEN--}}
        <nav class="hidden lg:flex sticky top-0 z-50 bg-base-100 shadow border-b border-white/10">
            <div class="w-full max-w-7xl mx-auto flex justify-between items-center py-4 px-5">
                {{-- Logo --}}
                <div class="shrink-0 ">
                    <img src="{{ asset('images/logo-only.svg') }}" alt="" class="w-10 h-auto">
                </div>
                @auth
                    @role('admin')
                    <div
                        class="hidden lg:flex text-base-content  gap-8 items-center whitespace-nowrap font-semibold lg:absolute left-1/2 -translate-x-1/2">
                        <div>
                            <a href="{{route('admin.dashboard')}}"
                               class="text-center block {{request()->routeIs('admin.dashboard') ? 'text-primary' : 'text-base-content'}}">Dashboard</a>
                            <div
                                class="{{request()->routeIs('admin.dashboard') ? 'bg-primary w-23 h-1 rounded-xl' : ''}}"></div>
                        </div>
                        <div>
                            <a href="{{route('admin.manage.users')}}"
                               class="text-center block {{request()->routeIs('admin.manage.users') ? 'text-primary' : 'text-base-content'}}">Users</a>
                            <div
                                class="{{request()->routeIs('admin.manage.users') ? 'bg-primary w-15 h-1 rounded-xl' : ''}}"></div>
                        </div>
                        <div>
                            <a href="{{route('admin.manage.listings')}}"
                               class="text-center block {{request()->routeIs('admin.manage.listings') ? 'text-primary' : 'text-base-content'}}">Listings</a>
                            <div
                                class="{{request()->routeIs('admin.manage.listings') ? 'bg-primary w-18 h-1 rounded-xl' : ''}}"></div>
                        </div>

                    </div>
                    @endrole
                @endauth

                @auth
                    @role('tenant')
                    {{--  <div class="flex-1 w-md border">
                          <!-- Search -->
                          <div class=" w-full max-w-xs lg:max-w-lg  text-base-content">
                              @include('components.search-bar')
                          </div>
                      </div>--}}

                    {{-- Tenant links LARGE SCREEN --}}
                    <div
                        class="hidden lg:flex text-base-content  gap-8 items-center whitespace-nowrap font-semibold lg:absolute left-1/2 -translate-x-1/2">
                        <div>
                            <a href="{{route('tenant.homepage')}}"
                               class="text-center block {{request()->routeIs('tenant.homepage') ? 'text-primary' : 'text-base-content'}}">Explore</a>
                            <div
                                class="{{request()->routeIs('tenant.homepage', 'listings.index') ? 'bg-primary w-17 h-1 rounded-xl' : ''}}"></div>
                        </div>
                        <div>
                            <a href="{{route('tenant.unit')}}"
                               class="text-center block {{request()->routeIs('tenant.unit') ? 'text-primary' : 'text-base-content'}}">My
                                Unit</a>
                            <div
                                class="{{request()->routeIs('tenant.unit') ? 'bg-primary w-17 h-1 rounded-xl' : ''}}"></div>
                        </div>
                        <div>
                            <a href="{{route('reservation.index')}}"
                               class="text-center block {{request()->routeIs('reservation.index') ? 'text-primary' : 'text-base-content'}}">Reservation</a>
                            <div
                                class="{{request()->routeIs('reservation.index') ? 'bg-primary w-24 h-1 rounded-xl' : ''}}"></div>
                        </div>
                    </div>

                    @endrole

                    @role('host')
                    {{-- Host links --}}
                    <div
                        class="hidden lg:flex text-base-content  gap-10 font-semibold lg:absolute left-1/2 -translate-x-1/2">
                        <div>
                            <a href="{{route('host.dashboard')}}"
                               class="text-center block {{request()->routeIs('host.dashboard') ? 'text-primary' : 'text-base-content'}}">Dashboard</a>
                            <div
                                class="{{request()->routeIs('host.dashboard') ? 'bg-primary w-23 h-1 rounded-xl' : ''}}"></div>
                        </div>

                        <div>
                            <a href="{{route('reservation.index')}}"
                               class="text-center block {{request()->routeIs('reservation.index') ? 'text-primary' : 'text-base-content'}}">Reservations</a>
                            <div
                                class="{{request()->routeIs('reservation.index') ? 'bg-primary w-27 h-1 rounded-xl' : ''}}"></div>
                        </div>

                        <div>
                            <a href="{{route('host.listings')}}"
                               class="text-center block {{request()->routeIs('host.listings') ? 'text-primary' : 'text-base-content'}}">Listings</a>
                            <div
                                class="{{request()->routeIs('host.listings') ? 'bg-primary w-17 h-1 rounded-xl' : ''}}"></div>
                        </div>

                        <div>
                            <a href="{{route('host.tenants.index')}}"
                               class="text-center block {{request()->routeIs('host.tenants.index') ? 'text-primary' : 'text-base-content'}}">Tenants</a>
                            <div
                                class="{{request()->routeIs('host.tenants.index') ? 'bg-primary w-17 h-1 rounded-xl' : ''}}"></div>
                        </div>
                    </div>
                    @endrole
                @endauth




                @guest
                    <div class="space-x-6 font-semibold ">
                        <a href="/login" class="text-base-content">Sign in</a>
                        <a href="{{ route('email.register') }}" class="btn btn-primary">Get Started</a>
                    </div>
                @endguest

                @auth
                    <div class="flex items-center space-x-3 font-bold ">
                        @if(!auth()->user()->hasRole('admin'))
                            <a href="{{route('messages.inbox', auth()->user()->id)}}"
                               class="flex btn btn-ghost btn-circle bg-base-100" tabindex="0" role="button">
                                <x-lucide-message-circle-more
                                    class="w-7 h-7 hover:text-primary  {{request()->routeIs('messages.inbox') || request()->routeIs('messages.show') ? 'text-primary' : 'text-base-content '}}"/>
                            </a>
                            @php
                                $user = auth()->user()
                            @endphp
                            <x-avatar-circle :$user/>
                        @endif

                        {{--<div class="avatar">
                            @if(auth()->user()-  >profile_photo_public_id)
                                <a href="{{ route('profile.index') }}">
                                    <div class="ring-primary ring-offset-base-100 w-9 h-9 rounded-full ring-2 ring-offset-2 overflow-hidden cursor-pointer">
                                        <img src="{{ auth()->user()->profile_photo_url }}" alt="Photo" class="w-full h-full object-cover"/>
                                    </div>
                                </a>

                            @else
                                <a href="{{route('profile.index')}}">
                                    <div class="hidden lg:flex btn btn-ghost text-white btn-circle bg-primary">
                                        <h1>{{Auth::user()->name[0]}}</h1>
                                    </div>
                                </a>
                            @endif

                        </div>--}}

                        <div class="hidden lg:flex dropdown dropdown-end">
                            <div class="btn btn-ghost btn-circle bg-base-100" tabindex="0" role="button">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>

                                </svg>
                            </div>
                            <ul tabindex="0"
                                class="dropdown-content menu bg-base-100 rounded-box z-50 mt-13 w-52 p-2 shadow-sm font-normal">
                                <li><a href="{{route('settings.index')}}">Settings</a></li>
                                <li>
                                    <form method="POST" action="/logout" class="hover:bg-red-100 hover:text-red-900">
                                        @csrf
                                        @method('DELETE')
                                        <button class="hover:cursor-pointer">Log out</button>
                                    </form>

                                </li>
                            </ul>
                        </div>
                    </div>
                @endauth

            </div>
        </nav>
    @endif

    {{--toast--}}
    @if(session()->hasAny(['success', 'error', 'info', 'warning']))
        <div id="toast-container" class="toast toast-top toast-center z-[100] mt-5 lg:mt-16">
            @foreach(['success', 'error', 'info', 'warning'] as $type)
                @if(session($type))
                    @php
                        $class = match($type) {
                            'success' => 'alert alert-success',
                            'error'   => 'alert alert-error',
                            'warning' => 'alert alert-warning',
                            'info'    => 'alert alert-info',
                        };
                    @endphp
                    <div class="{{ $class }} px-5">
                        <span class="text-white ">{{ session($type) }}</span>
                    </div>
                @endif
            @endforeach
        </div>
    @endif


    <main class="pb-20 lg:pb-0 bg-base-200">
        @include('components.confirm-modal')
        {{ $slot }}
    </main>
</div>
</body>
</html>
