<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Portal') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans bg-gray-50">
<div class="drawer lg:drawer-open">
  <input id="sidebar-drawer" type="checkbox" class="drawer-toggle" />
  <div class="drawer-content flex flex-col">

    <!-- ✅ Sticky Navbar -->
   <div class="navbar bg-base-100 shadow-sm sticky top-0 z-50">

  <div class="navbar bg-base-100 shadow-sm sticky top-0 z-50">
  <div class="flex-1">
    <a class="btn btn-ghost text-xl">daisyUI</a>
  </div>
  <div class="flex gap-2">
    <input type="text" placeholder="Search" class="input input-bordered w-24 md:w-auto" />
    <div class="dropdown dropdown-end">
      <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
        <div class="w-10 rounded-full">
          <img
            alt="Tailwind CSS Navbar component"
            src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
        </div>
      </div>
      <ul
        tabindex="0"
        class="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow">
        <li>
          <a href="{{ route('profile.show') }}" class="justify-between">
            Profile
            <span class="badge">New</span>
          </a>
        </li>
        <li><a>Settings</a></li>
        <li><a>Logout</a></li>
      </ul>
    </div>
  </div>
</div>
</div>


    <!-- Page content -->
    <main class="p-4">
      {{ $slot }}
    </main>
  </div>

  <!-- Sidebar -->
  <div class="drawer-side">
    <label for="sidebar-drawer" class="drawer-overlay"></label>
    <aside class="menu p-4 w-72 min-h-full bg-base-200 text-base-content flex flex-col">
      <h1 class="text-xl font-bold mb-4">Portal</h1>
      <ul class="flex-grow">
        <li><a href="/dashboard">Dashboard</a></li>
        <li><a href="#">Master Data</a></li>
        <li><a href="#">Monitoring</a></li>
        <li><a href="#">Guide</a></li>
      </ul>
    </aside>
  </div>
</div>


@livewireScripts
@stack('modals')
</body>
</html>
