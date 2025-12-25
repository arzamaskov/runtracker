.PHONY: help build up down restart logs shell composer artisan migrate fresh seed test pnpm

# Default target
help:
	@echo "Runtracker Docker Commands"
	@echo ""
	@echo "Usage: make [target]"
	@echo ""
	@echo "Development:"
	@echo "  build      Build Docker images"
	@echo "  up         Start containers"
	@echo "  down       Stop containers"
	@echo "  restart    Restart containers"
	@echo "  logs       View container logs"
	@echo "  shell      Open shell in php-fpm container"
	@echo "  composer   Run composer command (use: make composer cmd='install')"
	@echo "  artisan    Run artisan command (use: make artisan cmd='migrate')"
	@echo "  migrate    Run database migrations"
	@echo "  fresh      Fresh migration with seed"
	@echo "  seed       Run database seeders"
	@echo "  test       Run tests"
	@echo ""
	@echo "Node/Vite:"
	@echo "  pnpm       Run pnpm command (use: make pnpm cmd='add package')"
	@echo "  vite-logs  View Vite dev server logs"
	@echo ""
	@echo "Production:"
	@echo "  prod-build Build production Docker images"
	@echo "  prod-up    Start production containers"
	@echo "  prod-down  Stop production containers"

# Development
build:
	docker compose build

up:
	docker compose up -d

down:
	docker compose down

restart:
	docker compose restart

logs:
	docker compose logs -f

shell:
	docker compose exec php-fpm bash

composer:
	docker compose exec php-fpm composer $(cmd)

artisan:
	docker compose exec php-fpm php artisan $(cmd)

migrate:
	docker compose exec php-fpm php artisan migrate

fresh:
	docker compose exec php-fpm php artisan migrate:fresh --seed

seed:
	docker compose exec php-fpm php artisan db:seed

test:
	docker compose exec php-fpm php artisan test

# Node/Vite
pnpm:
	docker compose exec node pnpm $(cmd)

vite-logs:
	docker compose logs -f node

# Production (uses app.env)
prod-build:
	docker compose --env-file app.env -f docker-compose.production.yml build

prod-up:
	docker compose --env-file app.env -f docker-compose.production.yml up -d

prod-down:
	docker compose --env-file app.env -f docker-compose.production.yml down

prod-logs:
	docker compose --env-file app.env -f docker-compose.production.yml logs -f
