r.PHONY: help

help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

install: ## Install symfony project (dev)
	composer install
	make build_assets
	make build

reinstall: ## Reinstall symfony project (dev)
	composer install
	make build_assets
	make rebuild

rebuild: ## Rebuild database (dev)
	php bin/console doctrine:database:drop --force
	make build

build: ## Build database (dev)
	php bin/console doctrine:database:create
	php bin/console doctrine:migrations:migrate --no-interaction
	php bin/console doctrine:fixtures:load --no-interaction --append

build_assets: ## build assets (dev)
	yarn install
	yarn encore dev

docker-build:
	docker compose build --pull --no-cache

start:
	docker compose up --remove-orphans -d
	symfony serve

stop:
	symfony server:stop
	docker compose stop

trans:
	php bin/console translation:extract --force --format=yaml --as-tree=1000 fr


