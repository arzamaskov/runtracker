@php
    $navItems = [
        ['route' => 'dashboard', 'label' => 'Обзор', 'icon' => 'home'],
        ['route' => 'dashboard.activities', 'label' => 'Активности', 'icon' => 'activity'],
        ['route' => 'dashboard.stats', 'label' => 'Статистика', 'icon' => 'trending-up'],
        ['route' => 'dashboard.comparison', 'label' => 'Сравнение', 'icon' => 'bar-chart'],
        ['route' => 'dashboard.goals', 'label' => 'Цели', 'icon' => 'award'],
        ['route' => 'dashboard.settings', 'label' => 'Настройки', 'icon' => 'settings'],
    ];

    $user = auth()->user();
    $initials = strtoupper(substr($user->email, 0, 2));
@endphp

<aside class="hidden md:flex w-64 bg-gradient-to-b from-slate-900 to-slate-950 border-r border-slate-800 flex-col">
    {{-- Logo --}}
    <div class="p-6 border-b border-slate-800">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center">
                <span class="text-white font-bold text-lg">R</span>
            </div>
            <div>
                <h1 class="text-white font-bold text-lg">Runtracker</h1>
                <p class="text-xs text-slate-400">Dashboard</p>
            </div>
        </div>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 p-4 space-y-2">
        @foreach($navItems as $item)
            @php
                $isActive = request()->routeIs($item['route']);
                $href = Route::has($item['route']) ? route($item['route']) : '#';
            @endphp
            <a
                href="{{ $href }}"
                class="w-full flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-300 {{ $isActive ? 'bg-primary text-white shadow-lg' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
            >
                @include('components.dashboard.icons.' . $item['icon'])
                <span class="font-medium">{{ $item['label'] }}</span>
            </a>
        @endforeach
    </nav>

    {{-- User Info & Logout --}}
    <div class="p-4 border-t border-slate-800 space-y-4">
        <div class="flex items-center gap-3 px-4 py-3 rounded-lg bg-slate-800/50">
            <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center">
                <span class="text-white font-bold text-sm">{{ $initials }}</span>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-white text-sm font-medium truncate">{{ $user->email }}</p>
            </div>
        </div>
        <form action="{{ route('identity.logout') }}" method="POST">
            @csrf
            <button
                type="submit"
                class="w-full bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white flex items-center justify-center gap-2 px-4 py-3 rounded-lg transition-all duration-300"
            >
                @include('components.dashboard.icons.log-out')
                Выход
            </button>
        </form>
    </div>
</aside>
