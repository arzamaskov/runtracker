@props([
    'label',
    'value',
    'unit' => null,
    'info' => null,
])

<div class="stat-row">
    <div class="flex items-center gap-2">
        <span class="stat-row-label">{{ $label }}</span>
        @if($info)
            <x-dashboard.info-tooltip :text="$info" />
        @endif
    </div>
    <div class="flex items-baseline">
        <span class="stat-row-value">{{ $value }}</span>
        @if($unit)
            <span class="text-xs text-muted-foreground ml-1">{{ $unit }}</span>
        @endif
    </div>
</div>
