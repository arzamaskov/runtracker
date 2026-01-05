@extends('layouts.dashboard')

@section('title', 'Активности — Runtracker')
@section('page-title', 'Активности')
@section('page-description', 'История всех ваших тренировок')

@section('content')
    <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-200">
        <div class="text-center py-12">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="mx-auto text-slate-300 mb-4">
                <path d="M22 12h-2.48a2 2 0 0 0-1.93 1.46l-2.35 8.36a.25.25 0 0 1-.48 0L9.24 2.18a.25.25 0 0 0-.48 0l-2.35 8.36A2 2 0 0 1 4.49 12H2"/>
            </svg>
            <h3 class="text-xl font-semibold text-slate-900 mb-2">Нет активностей</h3>
            <p class="text-slate-600 mb-6">Здесь будет отображаться история ваших тренировок</p>
            <button
                type="button"
                class="bg-primary hover:bg-primary/90 text-white px-6 py-3 rounded-lg font-medium inline-flex items-center gap-2 transition-all opacity-50 cursor-not-allowed"
                disabled
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14"/>
                    <path d="M12 5v14"/>
                </svg>
                Добавить активность
            </button>
        </div>
    </div>
@endsection
