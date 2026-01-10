@props([
    'title' => null,
    'subtitle' => null,
    'action' => null,
    'padding' => true,
])

<div {{ $attributes->merge(['class' => 'dashboard-card']) }}>
    @if($title || $action)
        <div class="flex items-center justify-between p-5 {{ $slot->isNotEmpty() ? 'border-b border-border-light' : '' }}">
            <div>
                @if($title)
                    <h3 class="text-lg font-semibold text-foreground">{{ $title }}</h3>
                @endif
                @if($subtitle)
                    <p class="text-sm text-muted-foreground mt-0.5">{{ $subtitle }}</p>
                @endif
            </div>
            @if($action)
                <div>
                    {{ $action }}
                </div>
            @endif
        </div>
    @endif

    @if($slot->isNotEmpty())
        <div class="{{ $padding ? 'p-5' : '' }}">
            {{ $slot }}
        </div>
    @endif
</div>
