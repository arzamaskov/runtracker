@extends('layouts.dashboard')

@section('title', 'Активности — Runtracker')
@section('page-title', 'Активности')
@section('page-description', 'История всех ваших тренировок')

@section('content')
    <x-dashboard.empty-state
        title="Нет активностей"
        description="Здесь будет отображаться история ваших тренировок"
        icon="activity"
        action-text="Добавить активность"
        :action-disabled="true"
    />
@endsection
