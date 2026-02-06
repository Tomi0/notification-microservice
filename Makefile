NEW_USER_ID := $(shell id -u)
NEW_GROUP_ID := $(shell id -g)

build:
	docker build -t ddd-symfony-skeleton:latest .

start:
	NEW_USER_ID=$(NEW_USER_ID) NEW_GROUP_ID=$(NEW_GROUP_ID) docker compose up -d

stop:
	NEW_USER_ID=$(NEW_USER_ID) NEW_GROUP_ID=$(NEW_GROUP_ID) docker compose down

bash:
	docker exec -it -u $(NEW_USER_ID):$(NEW_GROUP_ID) ddd-symfony-skeleton bash

test:
	docker exec -it -u $(NEW_USER_ID):$(NEW_GROUP_ID) ddd-symfony-skeleton php bin/console cache:clear --silent
	docker exec -it -u $(NEW_USER_ID):$(NEW_GROUP_ID) ddd-symfony-skeleton php bin/console doctrine:migrations:migrate --no-interaction --silent
	docker exec -it -u $(NEW_USER_ID):$(NEW_GROUP_ID) ddd-symfony-skeleton php vendor/bin/phpstan analyse -c phpstan.dist.neon
	docker exec -it -u $(NEW_USER_ID):$(NEW_GROUP_ID) ddd-symfony-skeleton php bin/phpunit --testdox

php-cs-fixer:
	docker exec -it -u $(NEW_USER_ID):$(NEW_GROUP_ID) -e PHP_CS_FIXER_IGNORE_ENV=1 ddd-symfony-skeleton ./vendor/bin/php-cs-fixer fix src
