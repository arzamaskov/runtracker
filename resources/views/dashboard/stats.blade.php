@extends('layouts.dashboard')

@section('title', 'Статистика — Runtracker')
@section('page-title', 'Статистика')
@section('page-description', 'Детальный анализ вашей активности')

@section('content')
    <x-dashboard.empty-state
        title="Недостаточно данных"
        description="Добавьте несколько тренировок, чтобы увидеть статистику"
        icon="chart"
        action-text="Перейти к активностям"
        :action-url="route('dashboard.activities')"
    />
@endsection
