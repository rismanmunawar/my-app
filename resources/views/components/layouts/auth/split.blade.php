<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white antialiased">
    <div
        class="relative grid h-dvh flex-col items-center justify-center px-8 sm:px-0 lg:max-w-none lg:grid-cols-2 lg:px-0">
        <div class="relative hidden h-full flex-col p-10 lg:flex">
            {{-- Background dengan brightness untuk kontras --}}
            <div class="absolute inset-0 bg-cover bg-center brightness-75"
                style="background-image: url('/images/auth-bg.jpg');"></div>

            <a href="{{ route('home') }}" class="relative z-20 flex items-center text-lg font-medium text-black"
                wire:navigate>
                <span class="flex h-10 w-10 items-center justify-center rounded-md">
                    <x-app-logo-icon class="me-2 h-7 fill-current text-black" />
                </span>
                {{ config('app.name', 'Laravel') }}
            </a>

            {{-- Custom Quote --}}
            <div class="relative z-20 mt-auto text-black">
                <blockquote class="space-y-2">
                    <flux:heading size="lg" class="text-black">
                        &ldquo;Technology is best when it brings people together.&rdquo;
                    </flux:heading>
                    <footer>
                        <flux:heading class="text-black">— Matt Mullenweg</flux:heading>
                    </footer>
                </blockquote>
            </div>
        </div>

        <div class="w-full lg:p-8">
            <div class="mx-auto flex w-full flex-col justify-center space-y-6 sm:w-[350px]">
                <a href="{{ route('home') }}" class="z-20 flex flex-col items-center gap-2 font-medium lg:hidden"
                    wire:navigate>
                    <span class="flex h-9 w-9 items-center justify-center rounded-md">
                        <x-app-logo-icon class="size-9 fill-current text-black" />
                    </span>

                    <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
                </a>
                {{ $slot }}
            </div>
        </div>
    </div>
    @fluxScripts
</body>

</html>
