@extends('layouts.dashboard')

@section('title', 'Цели — Runtracker')
@section('page-title', 'Цели')
@section('page-description', 'Управление вашими целями по бегу')

@section('content')
    <x-dashboard.empty-state
        title="Нет целей"
        description="Создайте свою первую цель, чтобы отслеживать прогресс"
        icon="target"
        action-text="Создать цель"
        :action-disabled="true"
    />
@endsection
