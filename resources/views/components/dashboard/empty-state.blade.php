@props([
    'title',
    'description' => null,
    'icon' => 'activity',
    'action' => null,
    'actionText' => null,
    'actionUrl' => null,
    'actionDisabled' => false,
])

@php
    $icons = [
        'activity' => '<path d="M22 12h-2.48a2 2 0 0 0-1.93 1.46l-2.35 8.36a.25.25 0 0 1-.48 0L9.24 2.18a.25.25 0 0 0-.48 0l-2.35 8.36A2 2 0 0 1 4.49 12H2"/>',
        'chart' => '<polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/>',
        'target' => '<circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/>',
        'calendar' => '<path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/>',
        'settings' => '<circle cx="12" cy="12" r="3"/><path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/>',
    ];
    $iconPath = $icons[$icon] ?? $icons['activity'];
@endphp

<div>
    <div class="text-center py-16 px-6">
        <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-muted flex items-center justify-center">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="32"
                height="32"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="text-muted-foreground"
            >
                {!! $iconPath !!}
            </svg>
        </div>

        <h3 class="text-lg font-semibold text-foreground mb-2">{{ $title }}</h3>

        @if($description)
            <p class="text-sm text-muted-foreground mb-6 max-w-sm mx-auto">{{ $description }}</p>
        @endif

        @if($action)
            {{ $action }}
        @elseif($actionText)
            @if($actionUrl && !$actionDisabled)
                <a
                    href="{{ $actionUrl }}"
                    class="inline-flex items-center gap-2 text-sm bg-muted hover:bg-slate-200 text-foreground px-3 py-1.5 rounded-md font-medium border border-slate-300 transition-colors"
                >
                    {{ $actionText }}
                </a>
            @else
                <button
                    type="button"
                    class="inline-flex items-center gap-2 text-sm bg-muted hover:bg-slate-200 text-foreground px-3 py-1.5 rounded-md font-medium border border-slate-300 transition-colors {{ $actionDisabled ? 'opacity-50 cursor-not-allowed' : '' }}"
                    {{ $actionDisabled ? 'disabled' : '' }}
                >
                    {{ $actionText }}
                </button>
            @endif
        @endif
    </div>

