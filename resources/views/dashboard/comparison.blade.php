@extends('layouts.dashboard')

@section('title', 'Сравнение — Runtracker')
@section('page-title', 'Сравнение')
@section('page-description', 'Сравнение производительности между периодами')

@section('content')
    <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-200">
        <div class="text-center py-12">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="mx-auto text-slate-300 mb-4">
                <line x1="12" x2="12" y1="20" y2="10"/>
                <line x1="18" x2="18" y1="20" y2="4"/>
                <line x1="6" x2="6" y1="20" y2="16"/>
            </svg>
            <h3 class="text-xl font-semibold text-slate-900 mb-2">Недостаточно данных для сравнения</h3>
            <p class="text-slate-600 mb-6">Нужно минимум 2 периода с активностями для сравнения</p>
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
