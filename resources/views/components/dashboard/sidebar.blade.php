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

{{-- Mobile Menu Button --}}
<button
    id="sidebar-toggle"
    class="md:hidden fixed top-4 left-4 z-50 p-2 bg-white rounded-lg shadow-md hover:bg-slate-100 transition-colors"
    aria-label="Открыть меню"
>
    <svg id="menu-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="4" x2="20" y1="12" y2="12"/>
        <line x1="4" x2="20" y1="6" y2="6"/>
        <line x1="4" x2="20" y1="18" y2="18"/>
    </svg>
</button>

{{-- Overlay --}}
<div
    id="sidebar-overlay"
    class="fixed inset-0 bg-black/50 z-30 md:hidden hidden"
></div>

{{-- Sidebar --}}
<aside
    id="sidebar"
    class="fixed md:relative left-0 top-0 h-screen w-64 bg-gradient-to-b from-slate-900 to-slate-950 border-r border-slate-800 flex flex-col z-40 transition-transform duration-300 -translate-x-full md:translate-x-0"
>
    {{-- Header: Close button + Logo --}}
    <div class="p-6 border-b border-slate-800 flex items-center gap-4">
        {{-- Close button (mobile only) --}}
        <button
            id="sidebar-close"
            class="md:hidden p-2 -ml-2 text-slate-400 hover:text-white transition-colors"
            aria-label="Закрыть меню"
        >
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 6 6 18"/>
                <path d="m6 6 12 12"/>
            </svg>
        </button>
        {{-- Logo --}}
        <span class="font-bold text-xl font-display"><span class="text-primary">RUN</span><span class="text-white">TRACKER</span></span>
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
