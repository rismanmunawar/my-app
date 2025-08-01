<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name', 'Portal') }}</title>
    {{-- <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    @stack('styles')
</head>

<body class="font-sans bg-gray-50">

    <div class="drawer lg:drawer-open">
        <input id="sidebar-drawer" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col min-h-screen">

            <!-- Navbar -->
            <nav class="navbar bg-base-100 shadow-sm sticky top-0 z-50 min-h-[4.5rem]">

                <div class="flex-1">
                    <label for="sidebar-drawer" class="btn btn-ghost lg:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </label>
                    {{-- <a class="btn btn-ghost text-xl normal-case text-center">daisyUI</a> --}}
                </div>
                <div class="flex gap-2">
                    <input type="text" placeholder="Search" class="input input-bordered w-24 md:w-auto" />
                    <button class="btn btn-ghost btn-circle">
                        <div class="indicator">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span class="badge badge-xs badge-primary indicator-item"></span>
                        </div>
                    </button>
                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button"
                            class="flex items-center gap-3 btn btn-ghost px-3 py-2 rounded-lg transition-all hover:bg-white hover:text-black">
                            <div class="p-1 bg-base-100 rounded-full">
                                <div class="w-9 h-9 rounded-full overflow-hidden">
                                    <img alt="User"
                                        src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                                </div>
                            </div>
                            <div class="hidden lg:block text-left">
                                <div class="text-sm font-medium">
                                    {{ Auth::user()->name }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ Auth::user()->email }}
                                </div>
                            </div>
                        </div>
                        <ul tabindex="0"
                            class="menu menu-sm dropdown-content bg-base-100 rounded-box z-50 mt-3 w-52 p-2 shadow">
                            <li><a href="{{ route('profile.show') }}">Profile</a></li>
                            <li><a href="#">Settings</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="text-left w-full">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Main content -->
            <main class="p-4 flex-1 bg-gray-50">
                <!-- Header -->
                @isset($header)
                    <header class="mb-4">
                        {{ $header }}
                    </header>
                @endisset

                <!-- Slot content -->
                {{ $slot }}
            </main>
        </div>

        <!-- Sidebar -->
        <div class="drawer-side lg:bg-base-200 bg-base-200/90 backdrop-blur-sm">
            <label for="sidebar-drawer" class="drawer-overlay"></label>
            <aside class="menu p-4 w-60 min-h-screen flex flex-col">
                <h1 class="text-2xl font-bold mb-6">Portal</h1>
                <ul class="flex-grow space-y-2">
                    {{-- Home --}}
                    <li>
                        <a href="{{ route('home') }}"
                            class="flex items-center gap-3 rounded-md px-3 py-2 transition-all
        {{ request()->routeIs('home') ? 'bg-primary text-white font-semibold' : 'text-base-content hover:bg-white hover:text-black' }}">
                            <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0h4" />
                            </svg>
                            Home
                        </a>
                    </li>
                    {{-- Artikel Edukasi --}}
                    <li>
                        <a href="{{ route('articles.index') }}"
                            class="flex items-center gap-3 rounded-md px-3 py-2 transition-all
        {{ request()->routeIs('articles.*') ? 'bg-primary text-white font-semibold' : 'text-base-content hover:bg-white hover:text-black' }}">
                            <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 100-4H5a2 2 0 100 4m14 0a2 2 0 100 4H5a2 2 0 100-4m14 0v6a2 2 0 01-2 2H7a2 2 0 01-2-2v-6" />
                            </svg>
                            Artikel Edukasi
                        </a>
                    </li>
                    {{-- Dokumentasi --}}
                    <li>
                        <a href="{{ route('docs.manage') }}"
                            class="flex items-center gap-3 px-4 py-2 rounded-md transition-all
            {{ request()->is('docs/manage') ? 'bg-primary text-white font-semibold' : 'text-base-content hover:bg-white hover:text-black' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 stroke-current" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            Dokumentasi
                        </a>
                    </li>

                    {{-- User Management --}}
                    <li>
                        <details
                            {{ request()->routeIs('users.*') || request()->routeIs('roles.*') || request()->routeIs('permissions.*') ? 'open' : '' }}>
                            <summary class="flex items-center gap-3 px-3 py-2 font-semibold">
                                <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a4 4 0 00-4-4h-1M7 20h10M4 20h3v-2a4 4 0 00-4-4H2m6-6a4 4 0 118 0 4 4 0 01-8 0z" />
                                </svg>
                                Manajemen User
                            </summary>
                            <ul>
                                {{-- Users --}}
                                @can('view.users')
                                    <li>
                                        <a href="{{ route('users.index') }}"
                                            class="flex items-center gap-3 px-4 py-2 rounded-md transition-all
                    {{ request()->routeIs('users.*') ? 'bg-primary text-white font-semibold' : 'text-base-content hover:bg-white hover:text-black' }}">
                                            <svg class="w-4 h-4 stroke-current" fill="none" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5.121 17.804A9.001 9.001 0 1118 20H6a1 1 0 01-.879-1.515z" />
                                            </svg>
                                            Users
                                        </a>
                                    </li>
                                @endcan

                                {{-- Roles --}}
                                <li>
                                    <a href="{{ route('roles.index') }}"
                                        class="flex items-center gap-3 px-4 py-2 rounded-md transition-all
                    {{ request()->routeIs('roles.*') ? 'bg-primary text-white font-semibold' : 'text-base-content hover:bg-white hover:text-black' }}">
                                        <svg class="w-4 h-4 stroke-current" fill="none" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 17h4M8 13h4M16 11V5a1 1 0 00-1-1H5a1 1 0 00-1 1v6m12 0v10a1 1 0 01-1 1H5a1 1 0 01-1-1V11h12z" />
                                        </svg>
                                        Roles
                                    </a>
                                </li>

                                {{-- Permissions --}}
                                <li>
                                    <a href="{{ route('permissions.index') }}"
                                        class="flex items-center gap-3 px-4 py-2 rounded-md transition-all
                    {{ request()->routeIs('permissions.*') ? 'bg-primary text-white font-semibold' : 'text-base-content hover:bg-white hover:text-black' }}">
                                        <svg class="w-4 h-4 stroke-current" fill="none" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Permissions
                                    </a>
                                </li>
                            </ul>
                        </details>
                    </li>
                </ul>
            </aside>
        </div>
    </div>
    @livewireScripts
    @stack('scripts')
</body>

</html>
