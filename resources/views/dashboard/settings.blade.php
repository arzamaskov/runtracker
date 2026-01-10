@extends('layouts.dashboard')

@section('title', 'Настройки — Runtracker')
@section('page-title', 'Настройки')
@section('page-description', 'Управление профилем и предпочтениями')

@section('content')
    <div class="space-y-8">
        {{-- Avatar Section --}}
        <section>
            <h2 class="text-lg font-semibold text-foreground mb-4">Фото профиля</h2>
            <div class="flex items-center gap-6">
                <div class="w-20 h-20 bg-primary rounded-full flex items-center justify-center">
                    <span class="text-white font-bold text-2xl">
                        {{ strtoupper(substr(auth()->user()->email, 0, 2)) }}
                    </span>
                </div>
                <div>
                    <p class="text-sm text-muted-foreground mb-3">
                        Загрузите фото профиля
                    </p>
                    <button
                        type="button"
                        class="text-sm bg-muted hover:bg-slate-200 text-foreground px-3 py-1.5 rounded-md font-medium border border-slate-300 transition-colors opacity-50 cursor-not-allowed"
                        disabled
                    >
                        Выбрать фото
                    </button>
                </div>
            </div>
        </section>

        <hr class="border-border">

        {{-- Personal Info Section --}}
        <section>
            <h2 class="text-lg font-semibold text-foreground mb-4">Личная информация</h2>

            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <p class="text-sm text-muted-foreground mb-1">Имя</p>
                        <p class="text-sm text-foreground">—</p>
                    </div>
                    <div>
                        <p class="text-sm text-muted-foreground mb-1">Фамилия</p>
                        <p class="text-sm text-foreground">—</p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <p class="text-sm text-muted-foreground mb-1">Email</p>
                        <p class="text-sm text-foreground">{{ auth()->user()->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-muted-foreground mb-1">Телефон</p>
                        <p class="text-sm text-foreground">—</p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <p class="text-sm text-muted-foreground mb-1">Местоположение</p>
                        <p class="text-sm text-foreground">—</p>
                    </div>
                    <div>
                        <p class="text-sm text-muted-foreground mb-1">Дата рождения</p>
                        <p class="text-sm text-foreground">—</p>
                    </div>
                </div>
                <div class="pt-2">
                    <button
                        type="button"
                        class="text-sm bg-muted hover:bg-slate-200 text-foreground px-3 py-1.5 rounded-md font-medium border border-slate-300 transition-colors opacity-50 cursor-not-allowed"
                        disabled
                    >
                        Редактировать
                    </button>
                </div>
            </div>
        </section>

        <hr class="border-border">

        {{-- Physical Stats Section --}}
        <section>
            <h2 class="text-lg font-semibold text-foreground mb-4">Физические параметры</h2>

            <div class="space-y-4">
                <div class="grid grid-cols-3 gap-8">
                    <div>
                        <p class="text-sm text-muted-foreground mb-1">Рост</p>
                        <p class="text-sm text-foreground">— <span class="text-muted-foreground">см</span></p>
                    </div>
                    <div>
                        <p class="text-sm text-muted-foreground mb-1">Вес</p>
                        <p class="text-sm text-foreground">— <span class="text-muted-foreground">кг</span></p>
                    </div>
                    <div>
                        <p class="text-sm text-muted-foreground mb-1">Возраст</p>
                        <p class="text-sm text-foreground">— <span class="text-muted-foreground">лет</span></p>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-8">
                    <div>
                        <p class="text-sm text-muted-foreground mb-1">Пол</p>
                        <p class="text-sm text-foreground">—</p>
                    </div>
                    <div>
                        <p class="text-sm text-muted-foreground mb-1">Пульс в покое</p>
                        <p class="text-sm text-foreground">— <span class="text-muted-foreground">уд/мин</span></p>
                    </div>
                    <div>
                        <p class="text-sm text-muted-foreground mb-1">Макс. пульс</p>
                        <p class="text-sm text-foreground">— <span class="text-muted-foreground">уд/мин</span></p>
                    </div>
                </div>
                <div class="pt-2">
                    <button
                        type="button"
                        class="text-sm bg-muted hover:bg-slate-200 text-foreground px-3 py-1.5 rounded-md font-medium border border-slate-300 transition-colors opacity-50 cursor-not-allowed"
                        disabled
                    >
                        Редактировать
                    </button>
                </div>
            </div>
        </section>

        <hr class="border-border">

        {{-- Training Preferences Section --}}
        <section>
            <h2 class="text-lg font-semibold text-foreground mb-4">Предпочтения тренировок</h2>

            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <p class="text-sm text-muted-foreground mb-1">Предпочитаемая дистанция</p>
                        <p class="text-sm text-foreground">—</p>
                    </div>
                    <div>
                        <p class="text-sm text-muted-foreground mb-1">Предпочитаемое время</p>
                        <p class="text-sm text-foreground">—</p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <p class="text-sm text-muted-foreground mb-1">Дней тренировок в неделю</p>
                        <p class="text-sm text-foreground">—</p>
                    </div>
                    <div>
                        <p class="text-sm text-muted-foreground mb-1">Уровень опыта</p>
                        <p class="text-sm text-foreground">—</p>
                    </div>
                </div>
                <div class="pt-2">
                    <button
                        type="button"
                        class="text-sm bg-muted hover:bg-slate-200 text-foreground px-3 py-1.5 rounded-md font-medium border border-slate-300 transition-colors opacity-50 cursor-not-allowed"
                        disabled
                    >
                        Редактировать
                    </button>
                </div>
            </div>
        </section>

        <hr class="border-border">

        {{-- Password Section --}}
        <section>
            <h2 class="text-lg font-semibold text-foreground mb-4">Пароль</h2>
            <p class="text-sm text-muted-foreground mb-3">Обновите пароль для защиты аккаунта</p>
            <button
                type="button"
                class="text-sm bg-muted hover:bg-slate-200 text-foreground px-3 py-1.5 rounded-md font-medium border border-slate-300 transition-colors opacity-50 cursor-not-allowed"
                disabled
            >
                Изменить пароль
            </button>
        </section>

        <hr class="border-border">

        {{-- Session Section --}}
        <section>
            <h2 class="text-lg font-semibold text-foreground mb-4">Сессия</h2>
            <p class="text-sm text-muted-foreground mb-3">Завершить текущую сессию на этом устройстве</p>
            <form action="{{ route('identity.logout') }}" method="POST">
                @csrf
                <button
                    type="submit"
                    class="text-sm bg-muted hover:bg-slate-200 text-foreground px-3 py-1.5 rounded-md font-medium border border-slate-300 transition-colors"
                >
                    Выйти
                </button>
            </form>
        </section>

        <hr class="border-border">

        {{-- Danger Zone --}}
        <section>
            <h2 class="text-lg font-semibold text-destructive mb-4">Удаление аккаунта</h2>
            <p class="text-sm text-muted-foreground mb-3">Удаление необратимо, все данные будут потеряны</p>
            <button
                type="button"
                class="text-sm bg-destructive/10 hover:bg-destructive/20 text-destructive px-3 py-1.5 rounded-md font-medium transition-colors opacity-50 cursor-not-allowed"
                disabled
            >
                Удалить аккаунт
            </button>
        </section>
    </div>
@endsection
