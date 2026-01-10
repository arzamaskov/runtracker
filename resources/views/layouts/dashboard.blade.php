<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard — Runtracker')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/dashboard.js'])
</head>
<body class="bg-white">
<div class="flex h-screen">
    {{-- Sidebar --}}
    <x-dashboard.sidebar />

    {{-- Main Content --}}
    <main class="flex-1 overflow-auto">
        <div class="p-4 md:p-6 lg:p-8 max-w-7xl mx-auto">
            {{-- Page Header --}}
            <div class="mb-6">
                <h1 class="text-2xl md:text-3xl font-bold text-foreground mb-1 pl-12 md:pl-0">
                    @yield('page-title')
                </h1>
                <p class="text-sm text-muted-foreground pl-12 md:pl-0">
                    @yield('page-description')
                </p>
            </div>

            {{-- Page Content --}}
            @yield('content')
        </div>
    </main>
</div>
</body>
</html>
