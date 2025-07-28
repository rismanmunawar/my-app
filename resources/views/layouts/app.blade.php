<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name', 'Portal') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans bg-gray-50">

    <div class="drawer lg:drawer-open">
        <input id="sidebar-drawer" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col min-h-screen">

            <!-- Navbar -->
            <nav class="navbar bg-base-100 shadow-sm sticky top-0 z-50">
                <div class="flex-1">
                    <label for="sidebar-drawer" class="btn btn-ghost lg:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </label>
                    <a class="btn btn-ghost text-xl normal-case">daisyUI</a>
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
                        <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                            <div class="w-10 rounded-full">
                                <img alt="User"
                                    src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
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
        <div class="drawer-side bg-base-200">
            <label for="sidebar-drawer" class="drawer-overlay"></label>
            <aside class="menu p-4 w-60 min-h-screen flex flex-col">
                <h1 class="text-2xl font-bold mb-6">Portal</h1>
                <ul class="flex-grow space-y-2">
                    {{-- Dashboard --}}
                    <li>
                        <a href="{{ route('dashboard') }}"
                            class="flex items-center gap-3 rounded-md px-3 py-2 hover:bg-base-300
            {{ request()->routeIs('dashboard') ? 'bg-primary text-white font-semibold' : 'text-base-content' }}">
                            <!-- icon -->
                            <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0h4" />
                            </svg>
                            Dashboard
                        </a>
                    </li>

                    {{-- Master Data --}}
                    <li>
                        <a href="/master-data"
                            class="flex items-center gap-3 rounded-md px-3 py-2 hover:bg-base-300
            {{ request()->is('master-data*') ? 'bg-primary text-white font-semibold' : 'text-base-content' }}">
                            <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 10h16M4 14h10M4 18h10" />
                            </svg>
                            Master Data
                        </a>
                    </li>

                    {{-- Monitoring --}}
                    <li>
                        <a href="/monitoring"
                            class="flex items-center gap-3 rounded-md px-3 py-2 hover:bg-base-300
            {{ request()->is('monitoring*') ? 'bg-primary text-white font-semibold' : 'text-base-content' }}">
                            <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 17v-2a2 2 0 012-2h2a2 2 0 012 2v2m-6 0h6m-6 0a2 2 0 01-2-2v-6a2 2 0 012-2h6a2 2 0 012 2v6a2 2 0 01-2 2" />
                            </svg>
                            Monitoring
                        </a>
                    </li>

                    {{-- Guide --}}
                    <li>
                        <a href="/guide"
                            class="flex items-center gap-3 rounded-md px-3 py-2 hover:bg-base-300
            {{ request()->is('guide*') ? 'bg-primary text-white font-semibold' : 'text-base-content' }}">
                            <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6l4 2m4-10H4a2 2 0 00-2 2v12a2 2 0 002 2h16a2 2 0 002-2V6a2 2 0 00-2-2z" />
                            </svg>
                            Guide
                        </a>
                    </li>

                    {{-- Users --}}
                    <li>
                        <a href="{{ route('users.index') }}"
                            class="flex items-center gap-3 rounded-md px-3 py-2 hover:bg-base-300
            {{ request()->routeIs('users.index') ? 'bg-primary text-white font-semibold' : 'text-base-content' }}">
                            <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a4 4 0 00-4-4h-1M7 20h10M4 20h3v-2a4 4 0 00-4-4H2m6-6a4 4 0 118 0 4 4 0 01-8 0z" />
                            </svg>
                            Users
                        </a>
                    </li>
                </ul>
            </aside>
        </div>
    </div>

    @livewireScripts
</body>

</html>
