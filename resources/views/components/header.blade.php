<header class="sticky top-0 z-50 bg-background border-b border-border">
    <div class="container flex items-center justify-between h-16 md:h-20">
        {{-- Logo --}}
        <div class="flex items-center gap-2">
            <span class="font-bold text-xl font-display"><span class="text-primary">RUN</span>TRACKER</span>
        </div>


        {{-- Mobile Menu --}}
        <button
            id="menu-toggle"
            class="md:hidden p-2 text-foreground"
            aria-label="Открыть меню"
            aria-expanded="false"
        >
            {{-- Hamberger icon --}}
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="3" y1="6" x2="21" y2="6"/>
                <line x1="3" y1="12" x2="21" y2="12"/>
                <line x1="3" y1="18" x2="21" y2="18"/>
            </svg>
        </button>


        {{-- Desktop Auth Buttons --}}
        <div class="hidden md:flex items-center gap-4">
            <a href="#login" class="border border-primary text-primary hover:bg-secondary px-4 py-2 rounded-lg">
                Войти
            </a>
            <a href="#register" class="bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded-lg hover:shadow-lg transition-all duration-300 ease-out">
                Регистрация
            </a>
        </div>
    </div>

    {{-- Mobile Auth Buttons --}}
    <div id="mobile-menu" class="hidden md:hidden border-t border-border">
        <div class="container py-4 flex flex-col gap-3">
            <a href="#login" class="text-center border border-primary text-primary hover:bg-secondary px-4 py-2 rounded-lg">
                Войти
            </a>
            <a href="#register" class="text-center bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded-lg">
                Регистрация
            </a>
        </div>
    </div>

</header>
