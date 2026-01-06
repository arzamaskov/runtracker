[![Lint](https://github.com/arzamaskov/runtracker/actions/workflows/lint.yml/badge.svg)](https://github.com/arzamaskov/runtracker/actions/workflows/lint.yml)
[![Test](https://github.com/arzamaskov/runtracker/actions/workflows/test.yml/badge.svg)](https://github.com/arzamaskov/runtracker/actions/workflows/test.yml)
[![GitHub release](https://img.shields.io/github/v/release/arzamaskov/runtracker)](https://github.com/arzamaskov/runtracker/releases)
[![License: AGPL-3.0](https://img.shields.io/badge/License-AGPL--3.0-blue.svg)](https://www.gnu.org/licenses/agpl-3.0)
[![PHP](https://img.shields.io/badge/PHP-8.4-777BB4.svg)](https://www.php.net/)
[![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20.svg)](https://laravel.com/)

# Runtracker

Трекер беговых тренировок для тех, кому встроенного приложения часов уже мало, а профессиональные платформы — слишком много.

## Возможности

- История всех тренировок
- Анализ темпа, пульса, каденса
- Тренды за неделю, месяц, сезон
- Отчёты по периодам
- Open source — можно развернуть на своём сервере

## Технологии

- **Backend:** PHP 8.4, Laravel 12
- **Frontend:** Tailwind CSS 4, Vite
- **Database:** SQLite (по умолчанию)
- **DevOps:** Docker Compose, Makefile

## Установка

### Требования

- PHP 8.4+
- Composer
- Node.js 24+
- pnpm

### Локальная разработка (Docker)

```bash
git clone https://github.com/arzamaskov/runtracker.git
cd runtracker
make install
```

Приложение будет доступно по адресу http://localhost/

```bash
# Запуск (после установки)
make up

# Остановка
make down
```

## Self-hosted

Runtracker можно развернуть на своём сервере. Подробная инструкция — в [документации](https://github.com/arzamaskov/runtracker/wiki).

## Contributing

Мы рады вкладу в проект! См. [CONTRIBUTING.md](CONTRIBUTING.md).

## Лицензия

[AGPL-3.0](LICENSE)
