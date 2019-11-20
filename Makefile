FIG = docker-compose
APP = $(FIG) exec app
COMPOSER = $(APP) composer

# コンテナ
build:
	@$(FIG) build
up:
	@$(FIG) up -d
down:
	@$(FIG) down
restart:
	@$(FIG) stop
	@$(FIG) start
clean:
	@docker image prune
	@docker volume prune

# composer
c-setup:
	@$(COMPOSER) setup
c-migrate:
	@$(COMPOSER) migrate
c-csfix:
	@$(COMPOSER) cs-fix
c-tests:
	@$(COMPOSER) tests