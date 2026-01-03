<div id="register-modal" class="hidden">
    {{-- Backdrop --}}
    <div class="fixed inset-0 bg-black/50 z-40" data-modal-backdrop></div>

    {{-- Modal --}}
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="bg-background rounded-2xl shadow-2xl w-full max-w-md">
            {{-- Header --}}
            <div class="flex items-center justify-between p-6 border-b border-border">
                <h2 class="text-2xl font-bold font-display">Создать аккаунт</h2>
                <button data-modal-close class="p-1 hover:bg-secondary rounded-lg transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
            </div>

            {{-- Content --}}
            <div class="p-6">
                <form class="space-y-4">
                    {{-- Email --}}
                    <div class="space-y-2">
                        <label for="register-email" class="text-sm font-medium text-foreground flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary">
                                <rect width="20" height="16" x="2" y="4" rx="2"/>
                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                            </svg>
                            Email
                        </label>
                        <input
                            type="email"
                            id="register-email"
                            placeholder="your@email.com"
                            class="w-full h-11 px-3 bg-secondary border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                        >
                    </div>

                    {{-- Password --}}
                    <div class="space-y-2">
                        <label for="register-password" class="text-sm font-medium text-foreground flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary">
                                <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                            Пароль
                        </label>
                        <input
                            type="password"
                            id="register-password"
                            placeholder="Минимум 6 символов"
                            class="w-full h-11 px-3 bg-secondary border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                        >
                    </div>

                    {{-- Confirm Password --}}
                    <div class="space-y-2">
                        <label for="register-confirm" class="text-sm font-medium text-foreground flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary">
                                <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                            Подтвердите пароль
                        </label>
                        <input
                            type="password"
                            id="register-confirm"
                            placeholder="Повторите пароль"
                            class="w-full h-11 px-3 bg-secondary border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                        >
                    </div>

                    {{-- Submit --}}
                    <button
                        type="submit"
                        class="w-full bg-primary hover:bg-primary/90 text-white h-11 rounded-lg font-medium hover:shadow-lg hover:scale-105 transition-all duration-300 ease-out flex items-center justify-center gap-2"
                    >
                        Создать аккаунт
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14"/>
                            <path d="m12 5 7 7-7 7"/>
                        </svg>
                    </button>

                    {{-- Terms --}}
                    <p class="text-xs text-muted-foreground text-center">
                        Создавая аккаунт, вы соглашаетесь с
                        <a href="#" class="text-primary hover:underline">политикой конфиденциальности</a>
                    </p>

                    {{-- Switch to login --}}
                    <p class="text-sm text-center text-muted-foreground">
                        Уже есть аккаунт?
                        <button type="button" data-open-modal="login-modal" data-modal-close class="text-primary hover:underline">
                            Войти
                        </button>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>

