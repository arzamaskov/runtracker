<footer class="bg-card border-t border-border">
    <div class="container section-py">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">

            {{-- Brand --}}
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <span class="font-bold text-lg font-display"><span class="text-primary">RUN</span>TRACKER</span>
                </div>
                <p class="text-muted-foreground text-sm">
                    Трекер для тех, кто бегает для себя.
                </p>
            </div>

            {{-- Product --}}
            <div>
                <h4 class="font-bold mb-4 font-display">Продукт</h4>
                <ul class="space-y-2 text-sm">
                    <li>
                        <a href="#features" class="text-muted-foreground hover:text-primary transition-colors">
                            Функции
                        </a>
                    </li>
                    <li>
                        <a href="#analytics" class="text-muted-foreground hover:text-primary transition-colors">
                            Аналитика
                        </a>
                    </li>
                    <li>
                        <span class="text-muted-foreground/50 cursor-not-allowed">
                            Цены
                        </span>
                    </li>
                </ul>
            </div>

            {{-- Community --}}
            <div>
                <h4 class="font-bold mb-4 font-display">Сообщество</h4>
                <ul class="space-y-2 text-sm">
                    <li>
                        <a href="https://github.com/arzamaskov/runtracker" class="text-muted-foreground hover:text-primary transition-colors" target="_blank" rel="noopener">
                            GitHub
                        </a>
                    </li>
                    <li>
                        <a href="https://github.com/arzamaskov/runtracker/wiki" class="text-muted-foreground hover:text-primary transition-colors" target="_blank" rel="noopener">
                            Документация
                        </a>
                    </li>
                    <li>
                        <a href="https://github.com/arzamaskov/runtracker/issues/new" class="text-muted-foreground hover:text-primary transition-colors" target="_blank" rel="noopener">
                            Сообщить о проблеме
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Legal --}}
            <div>
                <h4 class="font-bold mb-4 font-display">Правовая информация</h4>
                <ul class="space-y-2 text-sm">
                    <li>
                        <span class="text-muted-foreground/50 cursor-not-allowed">
                            Политика конфиденциальности
                        </span>
                    </li>
                    <li>
                        <span class="text-muted-foreground/50 cursor-not-allowed">
                            Условия использования
                        </span>
                    </li>
                    <li>
                        <span class="text-muted-foreground/50 cursor-not-allowed">
                            Контакты
                        </span>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Divider --}}
        <div class="border-t border-border pt-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-muted-foreground text-sm">
                    © {{ date('Y') }} Runtracker. Создано бегунами для бегунов.
                </p>
                <div class="flex items-center gap-4">
                    <a href="https://github.com/arzamaskov/runtracker" class="text-muted-foreground hover:text-primary transition-colors" aria-label="GitHub" target="_blank" rel="noopener">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15 22v-4a4.8 4.8 0 0 0-1-3.5c3 0 6-2 6-5.5.08-1.25-.27-2.48-1-3.5.28-1.15.28-2.35 0-3.5 0 0-1 0-3 1.5-2.64-.5-5.36-.5-8 0C6 2 5 2 5 2c-.3 1.15-.3 2.35 0 3.5A5.403 5.403 0 0 0 4 9c0 3.5 3 5.5 6 5.5-.39.49-.68 1.05-.85 1.65-.17.6-.22 1.23-.15 1.85v4"/>
                            <path d="M9 18c-4.51 2-5-2-7-2"/>
                        </svg>
                    </a>
                    <div class="flex items-center gap-1 text-muted-foreground text-sm">
                        <span>Сделано с</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor" class="text-destructive">
                            <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
