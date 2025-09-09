SHELL := /bin/bash

.DEFAULT_GOAL := help

# Core commands
.PHONY: help up down dev restart build install fresh reset status logs shell wp cache clean

help: ## Show available commands
	@echo "WordPress Development Environment"
	@echo ""
	@echo "Commands:"
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "  \033[36m%-12s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

up: ## Start basic stack (WordPress only)
	@docker compose up -d
	@echo "✅ WordPress stack started at http://localhost:8080"

dev: ## Start development stack (with Node.js tools)
	@docker compose --profile dev up -d
	@echo "✅ Development stack started:"
	@echo "   WordPress: http://localhost:8080"
	@echo "   Vite dev:  http://localhost:3000"

down: ## Stop and remove all containers
	@docker compose down

restart: ## Restart all containers
	@docker compose restart

build: ## Rebuild all containers
	@docker compose build --no-cache

status: ## Show container status
	@docker compose ps

logs: ## Show logs (optional service: make logs wp/nginx/node/redis)
	@if [ -n "$(filter-out $@,$(MAKECMDGOALS))" ]; then \
		docker compose logs -f $(filter-out $@,$(MAKECMDGOALS)); \
	else \
		docker compose logs -f --tail=100; \
	fi

shell: ## Access container shell (make shell wp/node/redis)
	@if [ "$(filter-out $@,$(MAKECMDGOALS))" = "node" ]; then \
		docker compose exec node sh; \
	elif [ "$(filter-out $@,$(MAKECMDGOALS))" = "redis" ]; then \
		docker compose exec redis redis-cli; \
	else \
		docker compose exec wp bash; \
	fi

wp: ## Run WP-CLI command (make wp "plugin list")
	@docker compose exec -u www-data wp wp $(args)

install: ## Install WordPress
	@docker compose exec -u www-data wp wp core install \
		--url=$$(grep -E '^WP_URL=' .env | cut -d= -f2) \
		--title="WP Dev" \
		--admin_user=admin \
		--admin_password=admin \
		--admin_email=admin@example.com
	@echo "✅ WordPress installed: admin/admin"

fresh: ## Fresh installation (rebuild everything)
	@make down build dev install
	@echo "✅ Fresh WordPress development environment ready!"

clean: ## Stop containers and remove volumes (data will be lost)
	@docker compose down -v
	@echo "🧹 Containers stopped and volumes removed"

reset: ## Nuclear option - remove everything
	@docker compose down -v
	@docker system prune -f --volumes
	@echo "💥 Everything removed! Run 'make fresh' to rebuild."

cache: ## Clear WordPress and Redis cache
	@docker compose exec -u www-data wp wp cache flush 2>/dev/null || echo "WordPress cache cleared"
	@docker compose exec redis redis-cli FLUSHALL 2>/dev/null || echo "Redis cache cleared"
	@echo "✅ All caches cleared"

# Allow passing arguments to make targets
%:
	@:
