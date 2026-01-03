@extends('layouts.app')

@section('title', 'Runtracker - Планирование и анализ беговых тренировок')

@section('content')
    <x-header />

    {{-- Hero Section --}}
    <section class="hero-gradient section-py">
        <div class="container">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

                {{-- Left: Text Content --}}
                <div class="animate-fade-in-up">
                    <h1 class="mb-6 text-foreground">
                        Бег — это просто.
                    </h1>
                    <p class="text-lg text-muted-foreground mb-8 leading-relaxed max-w-lg">
                        Когда встроенного приложения часов уже мало, а профессиональные платформы пугают — есть середина. Ваши тренировки, понятная статистика, ничего лишнего.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="#register" class="bg-primary hover:bg-primary/90 text-white h-12 px-8 text-base rounded-lg inline-flex items-center justify-center hover:shadow-lg hover:scale-105 transition-all duration-300 ease-out">
                            Попробовать
                        </a>
                    </div>
                </div>

                {{-- Right: Dashboard Mockup --}}
                <div class="animate-fade-in-up" style="animation-delay: 0.2s">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-primary/10 to-accent/10 rounded-2xl blur-3xl"></div>
                        <img
                            src="/images/dashboard-mockup.png"
                            alt="Runtracker Dashboard"
                            class="relative rounded-2xl shadow-2xl w-full"
                        >
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Features Section --}}
    <section id="features" class="section-py bg-background">
        <div class="container">
            <div class="text-center mb-16">
                <h2 class="mb-4 text-foreground">
                    Что внутри
                </h2>
                <p class="text-lg text-muted-foreground max-w-2xl mx-auto">
                    Простые инструменты, чтобы понимать, как идёт подготовка.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                {{-- Feature 1: История --}}
                <div class="feature-card text-center animate-fade-in-up">
                    <div class="flex justify-center mb-4">
                        <div class="w-16 h-16 bg-secondary rounded-full flex items-center justify-center text-primary">
                            {{-- Activity icon placeholder --}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-foreground">История</h3>
                    <p class="text-muted-foreground leading-relaxed">Каждая пробежка сохраняется. Можно всегда вернуться и сравнить с тем, что было месяц назад. Или год.</p>
                </div>

                {{-- Feature 2: Анализ --}}
                <div class="feature-card text-center animate-fade-in-up" style="animation-delay: 0.1s">
                    <div class="flex justify-center mb-4">
                        <div class="w-16 h-16 bg-secondary rounded-full flex items-center justify-center text-primary">
                            {{-- BarChart icon --}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" x2="12" y1="20" y2="10"/><line x1="18" x2="18" y1="20" y2="4"/><line x1="6" x2="6" y1="20" y2="16"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-foreground">Анализ</h3>
                    <p class="text-muted-foreground leading-relaxed">Темп, пульс, километраж, каденс. Видно, где было легко, а где пришлось потерпеть.</p>
                </div>

                {{-- Feature 3: Тренды --}}
                <div class="feature-card text-center animate-fade-in-up" style="animation-delay: 0.2s">
                    <div class="flex justify-center mb-4">
                        <div class="w-16 h-16 bg-secondary rounded-full flex items-center justify-center text-primary">
                            {{-- TrendingUp icon --}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-foreground">Тренды</h3>
                    <p class="text-muted-foreground leading-relaxed">Графики за неделю, месяц, сезон. Сразу понятно — форма растёт или пора снизить нагрузку.</p>
                </div>

                {{-- Feature 4: Отчёты --}}
                <div class="feature-card text-center animate-fade-in-up" style="animation-delay: 0.3s">
                    <div class="flex justify-center mb-4">
                        <div class="w-16 h-16 bg-secondary rounded-full flex items-center justify-center text-primary">
                            {{-- FileText icon --}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><line x1="16" x2="8" y1="13" y2="13"/><line x1="16" x2="8" y1="17" y2="17"/><line x1="10" x2="8" y1="9" y2="9"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-foreground">Отчёты</h3>
                    <p class="text-muted-foreground leading-relaxed">Итоги за период: сколько набегали, как менялся темп. Распределение времени по беговым зонам.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Analytics Deep Dive Section --}}
    <section id="analytics" class="section-py bg-card">
        <div class="container">
            <div class="bg-foreground text-white rounded-2xl p-8 md:p-12 lg:p-16">
                <h2 class="mb-8 leading-tight text-white">
                    Понятная статистика,<br>
                    а не научная работа.
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12">
                    {{-- Personalization --}}
                    <div>
                        <h4 class="font-bold mb-4 text-white uppercase tracking-wide text-sm opacity-80">
                            Персонализация
                        </h4>
                        <p class="text-white/80 mb-6 leading-relaxed">
                            Приложение учитывает вашу текущую форму. Показывает, если нагрузка резко выросла — чтобы не прийти к старту уставшим.
                        </p>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3">
                                <span class="text-accent mt-1">✓</span>
                                <span class="text-white/90">Контроль недельных объёмов</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="text-accent mt-1">✓</span>
                                <span class="text-white/90">Сравнение с предыдущими периодами</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="text-accent mt-1">✓</span>
                                <span class="text-white/90">Простые графики прогресса</span>
                            </li>
                        </ul>
                    </div>

                    {{-- Confidentiality --}}
                    <div>
                        <h4 class="font-bold mb-4 text-white uppercase tracking-wide text-sm opacity-80">
                            Конфиденциальность
                        </h4>
                        <p class="text-white/80 mb-6 leading-relaxed">
                            Ваши данные — ваши. Код открыт: можете запустить на своём сервере и не зависеть ни от кого.
                        </p>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3">
                                <span class="text-accent mt-1">✓</span>
                                <span class="text-white/90">Open source</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="text-accent mt-1">✓</span>
                                <span class="text-white/90">Полный контроль данных</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="text-accent mt-1">✓</span>
                                <span class="text-white/90">Без сторонних сервисов</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="section-py bg-background">
        <div class="container text-center">
            <h2 class="mb-6 text-foreground">
                Попробуйте
            </h2>
            <p class="text-lg text-muted-foreground max-w-2xl mx-auto mb-8">
                Пользуйтесь готовым сервисом или разверните у себя — код открыт.
            </p>
            <a href="#register" class="bg-primary hover:bg-primary/90 text-white h-12 px-8 text-base rounded-lg inline-flex items-center justify-center hover:shadow-lg hover:scale-105 transition-all duration-300 ease-out">
                Начать
            </a>
        </div>
    </section>

    <x-footer />

    @endsection

