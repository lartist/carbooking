r.PHONY: help

help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

install: ## Install symfony project (dev)
	composer install
	make build_assets
	make build
	#php bin/console lexik:jwt:generate-keypair

reinstall: ## Reinstall symfony project (dev)
	composer install
	make build_assets
	make rebuild
	#php bin/console lexik:jwt:generate-keypair

rebuild: ## Rebuild database (dev)
	php bin/console doctrine:database:drop --force
	make build
	#rm -rf data

build: ## Build database (dev)
	php bin/console doctrine:database:create
	php bin/console doctrine:migrations:migrate --no-interaction
	php bin/console doctrine:fixtures:load --no-interaction --append

build_assets: ## build assets (dev)
	yarn install
	yarn encore dev
	#php bin/console fos:js-routing:dump --format=json --target=public/js/fos_js_routes.json

code_quality: ## scan code for quality
	vendor/bin/php-cs-fixer fix --diff --verbose
	vendor/bin/phpstan analyse src tests -l max
docker-build:
	docker compose build --pull --no-cache
start:
	docker compose up --remove-orphans -d

stop:
	docker compose stop

trans:
	php bin/console translation:extract --force --format=yaml --as-tree=1000 fr


