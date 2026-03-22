DOCKER_COMPOSE = docker compose
SERVICE = app

.PHONY: up down restart build logs ps shell composer-install composer-update

up:
	$(DOCKER_COMPOSE) up -d --build

down:
	$(DOCKER_COMPOSE) down

restart: down up

build:
	$(DOCKER_COMPOSE) build

logs:
	$(DOCKER_COMPOSE) logs -f

ps:
	$(DOCKER_COMPOSE) ps

shell:
	$(DOCKER_COMPOSE) exec $(SERVICE) bash

composer-install:
	$(DOCKER_COMPOSE) exec $(SERVICE) composer install

composer-update:
	$(DOCKER_COMPOSE) exec $(SERVICE) composer update
