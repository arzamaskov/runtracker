@extends('layouts.app')

@section('title', 'Вход — Runtracker')

@section('content')
    <div class="min-h-screen flex items-start md:items-center justify-center p-4 pt-16 md:pt-4">
        <div class="bg-background rounded-2xl shadow-2xl w-full max-w-md">
            {{-- Header --}}
            <div class="p-6 border-b border-border">
                <h1 class="text-2xl font-bold font-display">Войти</h1>
            </div>

            {{-- Content --}}
            <div class="p-6">
                <form action="{{ route('identity.login.submit') }}" method="POST" class="space-y-4">
                    @csrf

                    {{-- Email --}}
                    <div class="space-y-2">
                        <label for="email" class="text-sm font-medium text-foreground flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary">
                                <rect width="20" height="16" x="2" y="4" rx="2"/>
                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                            </svg>
                            Email
                        </label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="your@email.com"
                            class="w-full h-11 px-3 bg-secondary border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary {{ $errors->has('email') ? 'border-red-500' : 'border-border' }}"
                        >
                        <div class="h-5">
                            @error('email')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Password --}}
                    <div class="space-y-2">
                        <label for="password" class="text-sm font-medium text-foreground flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary">
                                <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                            Пароль
                        </label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Ваш пароль"
                            class="w-full h-11 px-3 bg-secondary border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary {{ $errors->has('password') ? 'border-red-500' : 'border-border' }}"
                        >
                        <div class="h-5">
                            @error('password')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Remember me --}}
                    <div class="flex items-center gap-2">
                        <input
                            type="checkbox"
                            id="remember"
                            name="remember"
                            class="w-4 h-4 rounded border-border text-primary focus:ring-primary"
                        >
                        <label for="remember" class="text-sm text-muted-foreground">
                            Запомнить меня
                        </label>
                    </div>

                    {{-- Submit --}}
                    <button
                        type="submit"
                        class="w-full bg-primary hover:bg-primary/90 text-white h-11 rounded-lg font-medium hover:shadow-lg hover:scale-105 transition-all duration-300 ease-out flex items-center justify-center gap-2"
                    >
                        Войти
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14"/>
                            <path d="m12 5 7 7-7 7"/>
                        </svg>
                    </button>

                    {{-- Switch to login --}}
                    <p class="text-sm text-center text-muted-foreground">
                        Нет аккаунта?
                        <a href="{{ route('identity.register') }}" class="text-primary hover:underline">Зарегистрироваться</a>
                    </p>

                    <a href="/" class="text-primary hover:underline">← На главную</a>
                </form>
            </div>
        </div>
    </div>
@endsection
