.PHONY: help build up down restart ps shell shell-root logs logs-php logs-nginx logs-node \
	composer composer-install composer-update composer-require composer-dump \
	pnpm pnpm-install pnpm-dev pnpm-build artisan tinker \
	sqlite-init migrate migrate-rollback migrate-fresh migrate-fresh-seed seed \
	test test-coverage test-filter lint lint-fix stan deptrac qa \
	cache-clear optimize optimize-clear key-generate storage-link \
	queue-work queue-listen queue-restart permissions permissions-fix \
	install fresh-install clean clean-all db-reset volumes check stats info
.DEFAULT_GOAL := help

# =============================================================================
# Variables
# =============================================================================

GREEN  := \033[0;32m
YELLOW := \033[0;33m
NC     := \033[0m

# Container user (default: laravel uid:1000, gid:1000)
# Override with: make composer-install USER_ID=$(id -u)
USER_ID  ?= 1000
GROUP_ID ?= 1000
EXEC_USER := -u $(USER_ID):$(GROUP_ID)

# Docker Compose commands (v2)
DC := docker compose
DC_EXEC := $(DC) exec $(EXEC_USER)
DC_EXEC_ROOT := $(DC) exec -u root
PHP_SERVICE := php-fpm
NODE_SERVICE := node
ARTISAN := $(DC_EXEC) $(PHP_SERVICE) php artisan
COMPOSER_RUN := $(DC_EXEC) $(PHP_SERVICE) composer
PNPM_SHELL := $(DC) exec $(NODE_SERVICE) sh -lc
PNPM_BOOTSTRAP := corepack enable && corepack prepare pnpm@9 --activate &&

PROJECT := $(shell basename "$(CURDIR)" | tr '[:upper:]' '[:lower:]')

# =============================================================================
# Help
# =============================================================================

help: ## Show this help
	@echo "$(GREEN)Available commands:$(NC)"
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "  $(YELLOW)%-20s$(NC) %s\n", $$1, $$2}'

# =============================================================================
# Docker Compose
# =============================================================================

build: ## Build Docker images
	$(DC) build --no-cache

up: ## Start all containers
	$(DC) up -d

sqlite-init: ## Create SQLite database file for local Docker environment
	@mkdir -p ./database
	@touch ./database/database.sqlite

down: ## Stop all containers
	$(DC) down

restart: ## Restart all containers
	$(DC) restart

ps: ## Show container status
	$(DC) ps

shell: ## Open PHP container shell (as laravel user)
	$(DC_EXEC) $(PHP_SERVICE) sh

shell-root: ## Open PHP container shell (as root)
	$(DC_EXEC_ROOT) $(PHP_SERVICE) sh

# =============================================================================
# Logs
# =============================================================================

logs: ## Show all container logs
	$(DC) logs -f

logs-php: ## Show PHP logs
	$(DC) logs -f $(PHP_SERVICE)

logs-nginx: ## Show Nginx logs
	$(DC) logs -f nginx

logs-node: ## Show Node logs
	$(DC) logs -f $(NODE_SERVICE)

# =============================================================================
# Composer
# =============================================================================

composer: ## Run Composer command (make composer CMD="install")
	$(COMPOSER_RUN) $(CMD)

composer-install: ## Install PHP dependencies
	$(COMPOSER_RUN) install

composer-update: ## Update PHP dependencies
	$(COMPOSER_RUN) update

composer-require: ## Require package (make composer-require PKG="vendor/package")
	$(COMPOSER_RUN) require $(PKG)

composer-dump: ## Regenerate autoload files
	$(COMPOSER_RUN) dump-autoload

# =============================================================================
# PNPM
# =============================================================================

pnpm: ## Run PNPM command (make pnpm CMD="install")
	$(PNPM_SHELL) '$(PNPM_BOOTSTRAP) pnpm $(CMD)'

pnpm-install: ## Install Node dependencies
	$(PNPM_SHELL) '$(PNPM_BOOTSTRAP) pnpm install --frozen-lockfile'

pnpm-dev: ## Start Vite dev server
	$(PNPM_SHELL) '$(PNPM_BOOTSTRAP) pnpm run dev'

pnpm-build: ## Build production assets
	$(PNPM_SHELL) '$(PNPM_BOOTSTRAP) pnpm run build'

# =============================================================================
# Artisan
# =============================================================================

artisan: ## Run Artisan command (make artisan CMD="migrate")
	$(ARTISAN) $(CMD)

tinker: ## Start Tinker REPL
	$(ARTISAN) tinker

# =============================================================================
# Migrations & Seeders
# =============================================================================

migrate: ## Run migrations
	@$(MAKE) sqlite-init
	$(ARTISAN) migrate

migrate-rollback: ## Rollback last migration
	$(ARTISAN) migrate:rollback

migrate-fresh: ## Drop all tables and re-run migrations
	@$(MAKE) sqlite-init
	$(ARTISAN) migrate:fresh

migrate-fresh-seed: ## Drop all tables, re-run migrations and seeders
	@$(MAKE) sqlite-init
	$(ARTISAN) migrate:fresh --seed

seed: ## Run seeders
	$(ARTISAN) db:seed

# =============================================================================
# Testing
# =============================================================================

test: ## Run tests
	@$(MAKE) sqlite-init
	$(ARTISAN) test

test-coverage: ## Run tests with coverage
	@$(MAKE) sqlite-init
	$(ARTISAN) test --coverage

test-filter: ## Run specific test (make test-filter FILTER="TestName")
	@$(MAKE) sqlite-init
	$(ARTISAN) test --filter=$(FILTER)

# =============================================================================
# Code Quality
# =============================================================================

lint: ## Check code style (Laravel Pint)
	$(DC_EXEC) $(PHP_SERVICE) ./vendor/bin/pint --test

lint-fix: ## Fix code style (Laravel Pint)
	$(DC_EXEC) $(PHP_SERVICE) ./vendor/bin/pint

stan: ## Run static analysis (PHPStan)
	$(DC_EXEC) $(PHP_SERVICE) ./vendor/bin/phpstan analyse --memory-limit=2G

deptrac: ## Check architecture rules (Deptrac)
	$(DC_EXEC) $(PHP_SERVICE) ./vendor/bin/deptrac analyse

qa: lint deptrac stan test ## Run all checks before push

# =============================================================================
# Cache & Optimization
# =============================================================================

cache-clear: ## Clear all caches
	$(ARTISAN) cache:clear
	$(ARTISAN) config:clear
	$(ARTISAN) route:clear
	$(ARTISAN) view:clear

optimize: ## Optimize application
	$(ARTISAN) config:cache
	$(ARTISAN) route:cache
	$(ARTISAN) view:cache

optimize-clear: ## Clear optimization cache
	$(ARTISAN) optimize:clear

# =============================================================================
# Laravel Utilities
# =============================================================================

key-generate: ## Generate application key
	$(ARTISAN) key:generate

storage-link: ## Create storage symlink
	$(ARTISAN) storage:link

queue-work: ## Start queue worker
	$(ARTISAN) queue:work

queue-listen: ## Start queue listener
	$(ARTISAN) queue:listen

queue-restart: ## Restart queue workers
	$(ARTISAN) queue:restart

# =============================================================================
# Permissions
# =============================================================================

permissions: ## Set file permissions (runs as root)
	$(DC_EXEC_ROOT) $(PHP_SERVICE) chown -R $(USER_ID):$(GROUP_ID) /var/www/html
	$(DC_EXEC_ROOT) $(PHP_SERVICE) chmod -R 755 /var/www/html/storage
	$(DC_EXEC_ROOT) $(PHP_SERVICE) chmod -R 755 /var/www/html/bootstrap/cache

permissions-fix: ## Fix storage and cache permissions
	$(DC_EXEC_ROOT) $(PHP_SERVICE) chown -R $(USER_ID):$(GROUP_ID) /var/www/html/storage /var/www/html/bootstrap/cache
	$(DC_EXEC_ROOT) $(PHP_SERVICE) chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# =============================================================================
# Installation
# =============================================================================

install: build up sqlite-init composer-install pnpm-install key-generate migrate storage-link permissions ## Full project installation

fresh-install: build up sqlite-init composer-install pnpm-install key-generate migrate-fresh-seed storage-link permissions ## Fresh install with database reset

# =============================================================================
# Cleanup
# =============================================================================

clean: down ## Remove containers and volumes (DELETES DATA!)
	@echo "$(YELLOW)WARNING: This will delete ALL DATA including database!$(NC)"
	@echo "$(YELLOW)Press Ctrl+C to cancel or Enter to continue...$(NC)"
	@read confirm
	$(DC) down -v
	docker system prune -f

clean-all: ## Remove everything including images (DELETES DATA!)
	@echo "$(YELLOW)WARNING: This will delete ALL DATA including database and images!$(NC)"
	@echo "$(YELLOW)Press Ctrl+C to cancel or Enter to continue...$(NC)"
	@read confirm
	$(DC) down -v --rmi all
	docker system prune -af

db-reset: ## Reset main database (DELETES DATA!)
	@echo "$(YELLOW)WARNING: All database data will be deleted!$(NC)"
	@echo "$(YELLOW)Press Ctrl+C to cancel or Enter to continue...$(NC)"
	@read confirm
	$(ARTISAN) migrate:fresh --seed
	@echo "$(GREEN)Database reset complete$(NC)"

# =============================================================================
# Monitoring
# =============================================================================

volumes: ## Show volume information
	@echo "$(GREEN)Project Docker volumes:$(NC)"
	@docker volume ls | grep '$(PROJECT)_' || echo "No volumes found"
	@echo ""
	@echo "$(GREEN)Volume sizes:$(NC)"
	@docker system df -v | grep '$(PROJECT)_' || echo "No volumes found"

check: ## Verify all containers are running
	@echo "$(GREEN)Checking containers...$(NC)"
	@$(DC) ps

stats: ## Show resource usage statistics
	docker stats

info: ## Show project information
	@echo "$(GREEN)Project information:$(NC)"
	@echo "  USER_ID:  $(USER_ID)"
	@echo "  GROUP_ID: $(GROUP_ID)"
	@echo ""
	@echo "$(GREEN)Versions:$(NC)"
	@printf "  PHP:      " && $(DC_EXEC) $(PHP_SERVICE) php -v | head -n 1
	@printf "  Composer: " && $(COMPOSER_RUN) --version 2>/dev/null | head -n 1
	@printf "  Node.js:  " && $(DC) exec $(NODE_SERVICE) node -v
	@printf "  pnpm:     " && $(PNPM_SHELL) '$(PNPM_BOOTSTRAP) pnpm -v'
	@echo ""
	@echo "$(GREEN)Laravel:$(NC)"
	@printf "  " && $(ARTISAN) --version
