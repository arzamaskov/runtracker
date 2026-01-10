@props([
    'label',
    'value',
    'unit' => null,
    'icon' => null,
    'color' => 'primary',
    'info' => null,
])

@php
    $colorClasses = [
        'primary' => 'text-primary',
        'blue' => 'text-[var(--chart-blue)]',
        'cyan' => 'text-[var(--chart-cyan)]',
        'orange' => 'text-[var(--chart-orange)]',
        'red' => 'text-[var(--chart-red)]',
        'green' => 'text-[var(--chart-green)]',
        'purple' => 'text-[var(--chart-purple)]',
        'gray' => 'text-[var(--chart-gray)]',
    ];
    $valueColor = $colorClasses[$color] ?? $colorClasses['primary'];
@endphp

<div class="dashboard-card p-5">
    <div class="flex items-start justify-between mb-3">
        <span class="metric-label">{{ $label }}</span>
        @if($info)
            <x-dashboard.info-tooltip :text="$info" />
        @endif
    </div>

    <div class="flex items-baseline gap-1">
        @if($icon)
            <span class="mr-2 {{ $valueColor }}">
                {{ $icon }}
            </span>
        @endif
        <span class="metric-value {{ $valueColor }}">{{ $value }}</span>
        @if($unit)
            <span class="metric-unit">{{ $unit }}</span>
        @endif
    </div>

    @if($slot->isNotEmpty())
        <div class="mt-3 pt-3 border-t border-border-light">
            {{ $slot }}
        </div>
    @endif
</div>
