<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard — Runtracker')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="flex h-screen bg-slate-50">
    {{-- Sidebar --}}
    <x-dashboard.sidebar />

    {{-- Main Content --}}
    <main class="flex-1 overflow-auto">
        <div class="p-6 md:p-8 max-w-7xl mx-auto">
            {{-- Page Header --}}
            <div class="mb-8">
                <h1 class="text-3xl md:text-4xl font-bold text-slate-900 mb-2">
                    @yield('page-title')
                </h1>
                <p class="text-slate-600">
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
