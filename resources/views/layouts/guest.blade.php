<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Medium Clone') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-neutral-950 antialiased">
        @php
            $authTitle = match (true) {
                request()->routeIs('register') => 'Start reading and writing.',
                request()->routeIs('password.request') => 'Reset your password.',
                request()->routeIs('password.reset') => 'Choose a new password.',
                request()->routeIs('password.confirm') => 'Confirm your password.',
                default => 'Welcome back to stories that matter.',
            };

            $authSubtitle = match (true) {
                request()->routeIs('register') => 'Create an account to publish stories, follow authors, and join the conversation.',
                request()->routeIs('password.request', 'password.reset', 'password.confirm') => 'Keep your account secure and get back to reading.',
                default => 'Sign in or create an account to write, follow authors, and clap for posts.',
            };
        @endphp

        <div class="min-h-screen bg-white">
            <div class="mx-auto flex min-h-screen w-full max-w-6xl flex-col px-4 sm:px-6 lg:px-8">
                <header class="flex h-16 items-center justify-between border-b border-neutral-200">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <x-application-logo class="h-8 w-auto" />
                    </a>

                    <div class="flex items-center gap-4 text-sm">
                        <a href="{{ route('login') }}" class="text-neutral-600 hover:text-neutral-950">Sign in</a>
                        <a href="{{ route('register') }}" class="rounded-full bg-neutral-950 px-4 py-2 font-medium text-white transition hover:bg-neutral-800">
                            Get started
                        </a>
                    </div>
                </header>

                <main class="flex flex-1 items-center justify-center py-10">
                    <div class="w-full max-w-md">
                        <div class="mb-8 text-center">
                            <h1 class="text-3xl font-semibold tracking-normal text-neutral-950">{{ $authTitle }}</h1>
                            <p class="mt-3 text-sm leading-6 text-neutral-600">{{ $authSubtitle }}</p>
                        </div>

                        <div class="border border-neutral-200 bg-white p-6 shadow-sm sm:rounded-lg">
                            {{ $slot }}
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>
