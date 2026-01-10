@extends('layouts.dashboard')

@section('title', 'Сравнение — Runtracker')
@section('page-title', 'Сравнение')
@section('page-description', 'Сравнение производительности между периодами')

@section('content')
    <x-dashboard.empty-state
        title="Недостаточно данных для сравнения"
        description="Нужно минимум 2 периода с активностями для сравнения"
        icon="chart"
        action-text="Перейти к активностям"
        :action-url="route('dashboard.activities')"
    />
@endsection
