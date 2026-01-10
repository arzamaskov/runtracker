@extends('layouts.dashboard')

@section('title', 'Обзор — Runtracker')
@section('page-title', 'Обзор')
@section('page-description', 'Ваша статистика за неделю')

@section('content')
    <div class="space-y-6">
        {{-- Metric Cards Grid --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
            <x-dashboard.metric-card
                label="Тренировок"
                value="—"
                color="primary"
                info="Количество тренировок за эту неделю"
            />
            <x-dashboard.metric-card
                label="Дистанция"
                value="—"
                unit="км"
                color="blue"
                info="Общая дистанция за неделю"
            />
            <x-dashboard.metric-card
                label="Время"
                value="—"
                color="green"
                info="Общее время тренировок"
            />
            <x-dashboard.metric-card
                label="Ср. темп"
                value="—"
                unit="/км"
                color="cyan"
                info="Средний темп за неделю"
            />
        </div>

        {{-- Weekly Activity Section --}}
        <section>
            <h3 class="text-lg font-semibold text-foreground mb-4">Активность за неделю</h3>
            <div class="h-48 flex items-center justify-center">
                <p class="text-muted-foreground text-sm">Здесь будет график активности</p>
            </div>
        </section>

        <hr class="border-border">

        {{-- Recent Activities Section --}}
        <section>
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-lg font-semibold text-foreground">Последние тренировки</h3>
                    <p class="text-sm text-muted-foreground mt-0.5">За последние 7 дней</p>
                </div>
                <a href="{{ route('dashboard.activities') }}" class="text-sm text-primary hover:underline">
                    Все активности
                </a>
            </div>

            <div class="text-center py-8">
                <p class="text-muted-foreground text-sm">Нет тренировок за этот период</p>
            </div>
        </section>
    </div>
@endsection
