@extends('layouts.dashboard')

@section('title', 'Настройки — Runtracker')
@section('page-title', 'Настройки')
@section('page-description', 'Управление профилем и предпочтениями')

@section('content')
    <div class="space-y-6">
        {{-- Avatar Section --}}
        <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-200">
            <h2 class="text-2xl font-bold text-slate-900 mb-6">Фото профиля</h2>
            <div class="flex items-center gap-6">
                <div class="w-24 h-24 bg-primary rounded-full flex items-center justify-center">
                    <span class="text-white font-bold text-3xl">
                        {{ strtoupper(substr(auth()->user()->email, 0, 2)) }}
                    </span>
                </div>
                <div>
                    <p class="text-slate-600 mb-4">
                        Загрузите фото профиля. Вы сможете обрезать и отрегулировать изображение перед сохранением.
                    </p>
                    <button
                        type="button"
                        class="bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded-lg font-medium flex items-center gap-2 transition-all opacity-50 cursor-not-allowed"
                        disabled
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                            <polyline points="17 8 12 3 7 8"/>
                            <line x1="12" x2="12" y1="3" y2="15"/>
                        </svg>
                        Выбрать фото
                    </button>
                </div>
            </div>
        </div>

        {{-- Personal Info Section --}}
        <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-200">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-slate-900">Личная информация</h2>
                <button
                    type="button"
                    class="border border-slate-300 text-slate-700 hover:bg-slate-100 px-4 py-2 rounded-lg font-medium flex items-center gap-2 transition-all opacity-50 cursor-not-allowed"
                    disabled
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/>
                        <path d="m15 5 4 4"/>
                    </svg>
                    Редактировать
                </button>
            </div>

            <div class="space-y-6">
                {{-- Name Row --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-slate-600 font-medium mb-1">Имя</p>
                        <p class="text-lg text-slate-900 font-semibold">—</p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-600 font-medium mb-1">Фамилия</p>
                        <p class="text-lg text-slate-900 font-semibold">—</p>
                    </div>
                </div>

                {{-- Contact Row --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary mt-1">
                            <rect width="20" height="16" x="2" y="4" rx="2"/>
                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                        </svg>
                        <div>
                            <p class="text-sm text-slate-600 font-medium mb-1">Email</p>
                            <p class="text-slate-900">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-600 mt-1">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                        </svg>
                        <div>
                            <p class="text-sm text-slate-600 font-medium mb-1">Телефон</p>
                            <p class="text-slate-900">Не указан</p>
                        </div>
                    </div>
                </div>

                {{-- Location & Birth Date Row --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-orange-600 mt-1">
                            <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                        <div>
                            <p class="text-sm text-slate-600 font-medium mb-1">Местоположение</p>
                            <p class="text-slate-900">Не указано</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-purple-600 mt-1">
                            <path d="M8 2v4"/>
                            <path d="M16 2v4"/>
                            <rect width="18" height="18" x="3" y="4" rx="2"/>
                            <path d="M3 10h18"/>
                        </svg>
                        <div>
                            <p class="text-sm text-slate-600 font-medium mb-1">Дата рождения</p>
                            <p class="text-slate-900">Не указана</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Physical Stats Section --}}
        <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-200">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-slate-900">Физические параметры</h2>
                <button
                    type="button"
                    class="border border-slate-300 text-slate-700 hover:bg-slate-100 px-4 py-2 rounded-lg font-medium flex items-center gap-2 transition-all opacity-50 cursor-not-allowed"
                    disabled
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/>
                        <path d="m15 5 4 4"/>
                    </svg>
                    Редактировать
                </button>
            </div>

            <div class="space-y-6">
                {{-- Stats Cards --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-blue-50 rounded-xl p-6 border border-blue-200">
                        <p class="text-sm text-slate-600 font-medium mb-2">Рост</p>
                        <p class="text-3xl font-bold text-blue-600">—</p>
                        <p class="text-sm text-slate-600 mt-1">см</p>
                    </div>

                    <div class="bg-green-50 rounded-xl p-6 border border-green-200">
                        <p class="text-sm text-slate-600 font-medium mb-2">Вес</p>
                        <p class="text-3xl font-bold text-green-600">—</p>
                        <p class="text-sm text-slate-600 mt-1">кг</p>
                    </div>

                    <div class="bg-purple-50 rounded-xl p-6 border border-purple-200">
                        <p class="text-sm text-slate-600 font-medium mb-2">Возраст</p>
                        <p class="text-3xl font-bold text-purple-600">—</p>
                        <p class="text-sm text-slate-600 mt-1">лет</p>
                    </div>
                </div>

                {{-- Gender & BMI --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-slate-50 rounded-xl p-6 border border-slate-200">
                        <p class="text-sm text-slate-600 font-medium mb-2">Пол</p>
                        <p class="text-lg text-slate-900 font-semibold">Не указан</p>
                    </div>

                    <div class="bg-slate-50 rounded-xl p-6 border border-slate-200">
                        <p class="text-sm text-slate-600 font-medium mb-2">Индекс массы тела (BMI)</p>
                        <p class="text-3xl font-bold text-slate-400">—</p>
                    </div>
                </div>

                {{-- Heart Rate --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-orange-50 rounded-xl p-6 border border-orange-200">
                        <p class="text-sm text-slate-600 font-medium mb-2">Пульс в покое</p>
                        <p class="text-3xl font-bold text-orange-600">—</p>
                        <p class="text-sm text-slate-600 mt-1">уд/мин</p>
                    </div>

                    <div class="bg-red-50 rounded-xl p-6 border border-red-200">
                        <p class="text-sm text-slate-600 font-medium mb-2">Максимальный пульс</p>
                        <p class="text-3xl font-bold text-red-600">—</p>
                        <p class="text-sm text-slate-600 mt-1">уд/мин</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Training Preferences Section --}}
        <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-200">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-slate-900">Предпочтения тренировок</h2>
                <button
                    type="button"
                    class="border border-slate-300 text-slate-700 hover:bg-slate-100 px-4 py-2 rounded-lg font-medium flex items-center gap-2 transition-all opacity-50 cursor-not-allowed"
                    disabled
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/>
                        <path d="m15 5 4 4"/>
                    </svg>
                    Редактировать
                </button>
            </div>

            <div class="space-y-6">
                {{-- Distance & Time --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-blue-50 rounded-xl p-6 border border-blue-200">
                        <p class="text-sm text-slate-600 font-medium mb-2">Предпочитаемая дистанция</p>
                        <p class="text-lg text-slate-900 font-semibold">Не указана</p>
                    </div>

                    <div class="bg-green-50 rounded-xl p-6 border border-green-200">
                        <p class="text-sm text-slate-600 font-medium mb-2">Предпочитаемое время</p>
                        <p class="text-lg text-slate-900 font-semibold">Не указано</p>
                    </div>
                </div>

                {{-- Days & Level --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-orange-50 rounded-xl p-6 border border-orange-200">
                        <p class="text-sm text-slate-600 font-medium mb-2">Дней тренировок в неделю</p>
                        <p class="text-3xl font-bold text-orange-600">—</p>
                    </div>

                    <div class="bg-purple-50 rounded-xl p-6 border border-purple-200">
                        <p class="text-sm text-slate-600 font-medium mb-2">Уровень опыта</p>
                        <p class="text-lg text-slate-900 font-semibold">Не указан</p>
                    </div>
                </div>

                {{-- Terrain Types --}}
                <div>
                    <p class="text-sm text-slate-600 font-medium mb-3">Любимые типы местности</p>
                    <p class="text-slate-500">Не выбраны</p>
                </div>

                {{-- Toggles --}}
                <div class="space-y-3 pt-4 border-t border-slate-200">
                    <div class="flex items-center justify-between">
                        <span class="text-slate-900 font-medium">Уведомления о тренировках</span>
                        <div class="w-12 h-6 rounded-full bg-slate-300"></div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-900 font-medium">Делиться результатами</span>
                        <div class="w-12 h-6 rounded-full bg-slate-300"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Account Settings Section --}}
        <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-200">
            <h2 class="text-2xl font-bold text-slate-900 mb-6">Управление аккаунтом</h2>

            <div class="space-y-4">
                {{-- Account Info --}}
                <div class="bg-slate-50 rounded-xl p-6 border border-slate-200">
                    <p class="text-sm text-slate-600 font-medium mb-2">Email аккаунта</p>
                    <p class="text-lg text-slate-900 font-semibold">{{ auth()->user()->email }}</p>
                    <p class="text-sm text-slate-500 mt-2">Используется для входа и восстановления пароля</p>
                </div>

                {{-- Security Section --}}
                <div class="bg-blue-50 rounded-xl p-6 border border-blue-200">
                    <div class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-600 mt-1">
                            <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                        <div class="flex-1">
                            <h3 class="font-semibold text-slate-900 mb-2">Безопасность</h3>
                            <p class="text-sm text-slate-600 mb-4">
                                Измените пароль, чтобы защитить ваш аккаунт
                            </p>
                            <button
                                type="button"
                                class="bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-lg font-medium flex items-center gap-2 transition-all opacity-50 cursor-not-allowed"
                                disabled
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                                </svg>
                                Изменить пароль
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Session Management --}}
                <div class="bg-orange-50 rounded-xl p-6 border border-orange-200">
                    <div class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-orange-600 mt-1">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                            <polyline points="16 17 21 12 16 7"/>
                            <line x1="21" x2="9" y1="12" y2="12"/>
                        </svg>
                        <div class="flex-1">
                            <h3 class="font-semibold text-slate-900 mb-2">Сеанс</h3>
                            <p class="text-sm text-slate-600 mb-4">
                                Выйти из аккаунта на этом устройстве
                            </p>
                            <form action="{{ route('identity.logout') }}" method="POST" class="inline">
                                @csrf
                                <button
                                    type="submit"
                                    class="border border-orange-300 text-orange-700 hover:bg-orange-100 px-4 py-2 rounded-lg font-medium flex items-center gap-2 transition-all"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                                        <polyline points="16 17 21 12 16 7"/>
                                        <line x1="21" x2="9" y1="12" y2="12"/>
                                    </svg>
                                    Выход
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Danger Zone --}}
                <div class="bg-red-50 rounded-xl p-6 border-2 border-red-200">
                    <div class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-red-600 mt-1">
                            <circle cx="12" cy="12" r="10"/>
                            <line x1="12" x2="12" y1="8" y2="12"/>
                            <line x1="12" x2="12.01" y1="16" y2="16"/>
                        </svg>
                        <div class="flex-1">
                            <h3 class="font-semibold text-slate-900 mb-2">Опасная зона</h3>
                            <p class="text-sm text-slate-600 mb-4">
                                Удаление аккаунта необратимо. Все ваши данные будут удалены.
                            </p>
                            <button
                                type="button"
                                class="bg-red-600 text-white hover:bg-red-700 px-4 py-2 rounded-lg font-medium flex items-center gap-2 transition-all opacity-50 cursor-not-allowed"
                                disabled
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 6h18"/>
                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                                    <line x1="10" x2="10" y1="11" y2="17"/>
                                    <line x1="14" x2="14" y1="11" y2="17"/>
                                </svg>
                                Удалить аккаунт
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Security Tip --}}
            <div class="mt-8 pt-6 border-t border-slate-200">
                <div class="bg-slate-50 rounded-lg p-4">
                    <p class="text-sm text-slate-600">
                        <strong>Совет по безопасности:</strong> Никогда не делитесь своим паролем с кем-либо. Runtracker никогда не будет просить вас ввести пароль по электронной почте.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
