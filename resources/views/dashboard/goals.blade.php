@extends('layouts.dashboard')

@section('title', 'Цели — Runtracker')
@section('page-title', 'Цели')
@section('page-description', 'Управление вашими целями по бегу')

@section('content')
    <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-200">
        <div class="text-center py-12">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="mx-auto text-slate-300 mb-4">
                <path d="m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526"/>
                <circle cx="12" cy="8" r="6"/>
            </svg>
            <h3 class="text-xl font-semibold text-slate-900 mb-2">Нет целей</h3>
            <p class="text-slate-600 mb-6">Создайте свою первую цель, чтобы отслеживать прогресс</p>
            <button
                type="button"
                class="bg-primary hover:bg-primary/90 text-white px-6 py-3 rounded-lg font-medium inline-flex items-center gap-2 transition-all opacity-50 cursor-not-allowed"
                disabled
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14"/>
                    <path d="M12 5v14"/>
                </svg>
                Создать цель
            </button>
        </div>
    </div>
@endsection
