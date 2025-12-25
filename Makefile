.PHONY: help build up down restart logs shell composer pnpm artisan migrate seed test \
        lint stan psql backup-db restore-db test-db-create test-db-drop ci permissions \
        clean install fresh-install volumes ps info tinker
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

# Database
DB_USERNAME := laravel
DB_DATABASE := runtracker
DB_DATABASE_TEST := $(DB_DATABASE)_test
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

down: ## Stop all containers
	$(DC) down

restart: ## Restart all containers
	$(DC) restart

ps: ## Show container status
	$(DC) ps

shell: ## Open PHP container shell (as laravel user)
	$(DC_EXEC) php-fpm sh

shell-root: ## Open PHP container shell (as root)
	$(DC_EXEC_ROOT) php-fpm sh

# =============================================================================
# Logs
# =============================================================================

logs: ## Show all container logs
	$(DC) logs -f

logs-php: ## Show PHP logs
	$(DC) logs -f php-fpm

logs-nginx: ## Show Nginx logs
	$(DC) logs -f nginx

logs-redis: ## Show Redis logs
	$(DC) logs -f redis

logs-node: ## Show Node logs
	$(DC) logs -f node

# =============================================================================
# Service connections
# =============================================================================

psql: ## Connect to PostgreSQL console
	$(DC) exec postgres psql -U $(DB_USERNAME) -d $(DB_DATABASE)

psql-root: ## Connect to PostgreSQL as superuser
	$(DC) exec postgres psql -U postgres

redis-cli: ## Connect to Redis console
	$(DC) exec redis redis-cli

# =============================================================================
# Composer
# =============================================================================

composer: ## Run Composer command (make composer CMD="install")
	$(DC_EXEC) php-fpm composer $(CMD)

composer-install: ## Install PHP dependencies
	$(DC_EXEC) php-fpm composer install

composer-update: ## Update PHP dependencies
	$(DC_EXEC) php-fpm composer update

composer-require: ## Require package (make composer-require PKG="vendor/package")
	$(DC_EXEC) php-fpm composer require $(PKG)

composer-dump: ## Regenerate autoload files
	$(DC_EXEC) php-fpm composer dump-autoload

# =============================================================================
# PNPM
# =============================================================================

pnpm: ## Run PNPM command (make pnpm CMD="install")
	$(DC) exec node sh -lc 'corepack enable && pnpm $(CMD)'

pnpm-install: ## Install Node dependencies
	$(DC) exec node sh -lc 'corepack enable && pnpm install'

pnpm-dev: ## Start Vite dev server
	$(DC) exec node sh -lc 'corepack enable && pnpm run dev'

pnpm-build: ## Build production assets
	$(DC) exec node sh -lc 'corepack enable && pnpm run build'

# =============================================================================
# Artisan
# =============================================================================

artisan: ## Run Artisan command (make artisan CMD="migrate")
	$(DC_EXEC) php-fpm php artisan $(CMD)

tinker: ## Start Tinker REPL
	$(DC_EXEC) php-fpm php artisan tinker

# =============================================================================
# Migrations & Seeders
# =============================================================================

migrate: ## Run migrations
	$(DC_EXEC) php-fpm php artisan migrate

migrate-rollback: ## Rollback last migration
	$(DC_EXEC) php-fpm php artisan migrate:rollback

migrate-fresh: ## Drop all tables and re-run migrations
	$(DC_EXEC) php-fpm php artisan migrate:fresh

migrate-fresh-seed: ## Drop all tables, re-run migrations and seeders
	$(DC_EXEC) php-fpm php artisan migrate:fresh --seed

seed: ## Run seeders
	$(DC_EXEC) php-fpm php artisan db:seed

# =============================================================================
# Testing
# =============================================================================

test: ## Run tests
	$(DC_EXEC) php-fpm php artisan test

test-coverage: ## Run tests with coverage
	$(DC_EXEC) php-fpm php artisan test --coverage

test-filter: ## Run specific test (make test-filter FILTER="TestName")
	$(DC_EXEC) php-fpm php artisan test --filter=$(FILTER)

test-db-create: ## Create test database
	@echo "$(GREEN)Creating test database...$(NC)"
	$(DC) exec postgres psql -U $(DB_USERNAME) -d postgres -c "CREATE DATABASE $(DB_DATABASE_TEST);" || echo "Database already exists"
	@echo "$(GREEN)Test database created$(NC)"

test-db-drop: ## Drop test database
	@echo "$(YELLOW)Dropping test database...$(NC)"
	$(DC) exec postgres psql -U $(DB_USERNAME) -d postgres -c "DROP DATABASE IF EXISTS $(DB_DATABASE_TEST);"
	@echo "$(GREEN)Test database dropped$(NC)"

test-db-reset: ## Reset test database with migrations
	@echo "$(GREEN)Resetting test database...$(NC)"
	@make test-db-drop
	@make test-db-create
	$(DC_EXEC) php-fpm php artisan migrate --database=pgsql --env=testing
	@echo "$(GREEN)Test database ready$(NC)"

# =============================================================================
# Code Quality
# =============================================================================

lint: ## Check code style (Laravel Pint)
	$(DC_EXEC) php-fpm ./vendor/bin/pint --test

lint-fix: ## Fix code style (Laravel Pint)
	$(DC_EXEC) php-fpm ./vendor/bin/pint

stan: ## Run static analysis (PHPStan)
	$(DC_EXEC) php-fpm ./vendor/bin/phpstan analyse --memory-limit=2G

deptrac: ## Check architecture rules (Deptrac)
	$(DC_EXEC) php-fpm ./vendor/bin/deptrac analyse

ci: lint deptrac stan test ## Run all checks before push

# =============================================================================
# Cache & Optimization
# =============================================================================

cache-clear: ## Clear all caches
	$(DC_EXEC) php-fpm php artisan cache:clear
	$(DC_EXEC) php-fpm php artisan config:clear
	$(DC_EXEC) php-fpm php artisan route:clear
	$(DC_EXEC) php-fpm php artisan view:clear

optimize: ## Optimize application
	$(DC_EXEC) php-fpm php artisan config:cache
	$(DC_EXEC) php-fpm php artisan route:cache
	$(DC_EXEC) php-fpm php artisan view:cache

optimize-clear: ## Clear optimization cache
	$(DC_EXEC) php-fpm php artisan optimize:clear

# =============================================================================
# Laravel Utilities
# =============================================================================

key-generate: ## Generate application key
	$(DC_EXEC) php-fpm php artisan key:generate

storage-link: ## Create storage symlink
	$(DC_EXEC) php-fpm php artisan storage:link

queue-work: ## Start queue worker
	$(DC_EXEC) php-fpm php artisan queue:work

queue-listen: ## Start queue listener
	$(DC_EXEC) php-fpm php artisan queue:listen

queue-restart: ## Restart queue workers
	$(DC_EXEC) php-fpm php artisan queue:restart

# =============================================================================
# Permissions
# =============================================================================

permissions: ## Set file permissions (runs as root)
	$(DC_EXEC_ROOT) php-fpm chown -R $(USER_ID):$(GROUP_ID) /var/www/html
	$(DC_EXEC_ROOT) php-fpm chmod -R 755 /var/www/html/storage
	$(DC_EXEC_ROOT) php-fpm chmod -R 755 /var/www/html/bootstrap/cache

permissions-fix: ## Fix storage and cache permissions
	$(DC_EXEC_ROOT) php-fpm chown -R $(USER_ID):$(GROUP_ID) /var/www/html/storage /var/www/html/bootstrap/cache
	$(DC_EXEC_ROOT) php-fpm chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# =============================================================================
# Installation
# =============================================================================

install: build up composer-install pnpm-install key-generate migrate storage-link permissions ## Full project installation

fresh-install: build up composer-install pnpm-install key-generate migrate-fresh-seed storage-link permissions ## Fresh install with database reset

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

# =============================================================================
# Database Management
# =============================================================================

backup-db: ## Create database backup
	@mkdir -p ./backups
	@echo "$(GREEN)Creating database backup...$(NC)"
	$(DC) exec -T postgres pg_dump -U $(DB_USERNAME) $(DB_DATABASE) | gzip > ./backups/backup_$(shell date +%Y%m%d_%H%M%S).sql.gz
	@echo "$(GREEN)Backup created in ./backups/$(NC)"

restore-db: ## Restore database from backup (make restore-db FILE=backup.sql.gz)
	@if [ -z "$(FILE)" ]; then \
		echo "$(YELLOW)Please specify file: make restore-db FILE=backup.sql.gz$(NC)"; \
		exit 1; \
	fi
	@echo "$(YELLOW)WARNING: Current database will be replaced!$(NC)"
	@echo "$(YELLOW)Press Ctrl+C to cancel or Enter to continue...$(NC)"
	@read confirm
	@echo "$(GREEN)Restoring database from $(FILE)...$(NC)"
	@gunzip < $(FILE) | $(DC) exec -T postgres psql -U $(DB_USERNAME) -d $(DB_DATABASE)
	@echo "$(GREEN)Database restored$(NC)"

db-list: ## Show all databases
	@echo "$(GREEN)Database list:$(NC)"
	$(DC) exec postgres psql -U $(DB_USERNAME) -d postgres -c "\l"

db-reset: ## Reset main database (DELETES DATA!)
	@echo "$(YELLOW)WARNING: All database data will be deleted!$(NC)"
	@echo "$(YELLOW)Press Ctrl+C to cancel or Enter to continue...$(NC)"
	@read confirm
	$(DC_EXEC) php-fpm php artisan migrate:fresh --seed
	@echo "$(GREEN)Database reset complete$(NC)"

db-schema: ## Show main database table structure
	@echo "$(GREEN)Table structure:$(NC)"
	$(DC) exec postgres psql -U $(DB_USERNAME) -d $(DB_DATABASE) -c "\dt"

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
	@echo ""
	@echo "$(GREEN)Checking database connection...$(NC)"
	@$(DC) exec postgres pg_isready -U $(DB_USERNAME) || echo "$(YELLOW)PostgreSQL is not ready!$(NC)"

stats: ## Show resource usage statistics
	docker stats

info: ## Show project information
	@echo "$(GREEN)Project information:$(NC)"
	@echo "  USER_ID:  $(USER_ID)"
	@echo "  GROUP_ID: $(GROUP_ID)"
	@echo ""
	@echo "$(GREEN)Versions:$(NC)"
	@printf "  PHP:      " && $(DC_EXEC) php-fpm php -v | head -n 1
	@printf "  Composer: " && $(DC_EXEC) php-fpm composer --version 2>/dev/null | head -n 1
	@printf "  Node.js:  " && $(DC) exec node node -v
	@printf "  pnpm:     " && $(DC) exec node sh -lc 'corepack enable && pnpm -v'
	@echo ""
	@echo "$(GREEN)Laravel:$(NC)"
	@printf "  " && $(DC_EXEC) php-fpm php artisan --version
