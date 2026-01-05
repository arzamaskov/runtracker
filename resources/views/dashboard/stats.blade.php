@extends('layouts.dashboard')

@section('title', 'Статистика — Runtracker')
@section('page-title', 'Статистика')
@section('page-description', 'Детальный анализ вашей активности')

@section('content')
    <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-200">
        <div class="text-center py-12">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="mx-auto text-slate-300 mb-4">
                <polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/>
                <polyline points="16 7 22 7 22 13"/>
            </svg>
            <h3 class="text-xl font-semibold text-slate-900 mb-2">Недостаточно данных</h3>
            <p class="text-slate-600 mb-6">Добавьте несколько тренировок, чтобы увидеть статистику</p>
            <a
                href="{{ route('dashboard.activities') }}"
                class="bg-primary hover:bg-primary/90 text-white px-6 py-3 rounded-lg font-medium inline-flex items-center gap-2 transition-all"
            >
                Перейти к активностям
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14"/>
                    <path d="m12 5 7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>
@endsection
