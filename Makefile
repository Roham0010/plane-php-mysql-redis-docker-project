# Variables
DOCKER_COMPOSE = docker compose
DOCKER_APP_SERVICE = app
DOCKER_DB_SERVICE = appdb
ENV_FILE = .env
ENV_TEST_FILE = .env.test
PHPUNIT = ./vendor/bin/phpunit

# Docker commands


down:
	$(DOCKER_COMPOSE) down

build:
	$(DOCKER_COMPOSE) build

up:
	$(DOCKER_COMPOSE) up -d --build

test:
	docker compose exec app ./vendor/bin/phpunit

app-create-transaction:
	@if [ -z "$(USER_ID)" ] || [ -z "$(AMOUNT)" ]; then \
		echo "Error: USER_ID and AMOUNT parameters are required"; \
		exit 1; \
	fi
	$(DOCKER_COMPOSE) exec $(DOCKER_APP_SERVICE) php bin/console app:create-transaction --user-id $(USER_ID) --amount $(AMOUNT) --date $(DATE)

app-generate-report:
	@if [ -z "$(TYPE)" ]; then \
		echo "Error: TYPE is required"; \
		exit 1; \
	fi
	$(DOCKER_COMPOSE) exec $(DOCKER_APP_SERVICE) php bin/console app:generate-report --type $(TYPE)
	#  --user-id $(USER_ID) --date $(DATE)

app-get:
	@if [ -z "$(TYPE)" ]; then \
		echo "Error: TYPE parameter is required"; \
		exit 1; \
	fi
	$(DOCKER_COMPOSE) exec $(DOCKER_APP_SERVICE) php bin/console app:get --type $(TYPE)

app-get-users:
	$(DOCKER_COMPOSE) exec $(DOCKER_APP_SERVICE) php bin/console app:get-users

app-populate-users:
	$(DOCKER_COMPOSE) exec $(DOCKER_APP_SERVICE) php bin/console app:populate-users

app-migrate:
	$(DOCKER_COMPOSE) exec $(DOCKER_APP_SERVICE) php bin/console app:migrate

# Help command
.PHONY: help

help:
	@grep -E '^[a-zA-Z_-]+:.*
