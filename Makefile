build:
	docker build --build-arg USER_ID=$(shell id -u) --build-arg GROUP_ID=$(shell id -g)  -t notification-microservice:latest .

start:
	docker compose up

stop:
	docker compose down

bash:
	docker exec -it notification-microservice bash

test:
	docker exec -it notification-microservice php bin/console cache:clear --silent
	docker exec -it notification-microservice php bin/console doctrine:migrations:migrate --no-interaction --silent
	docker exec -it notification-microservice php vendor/bin/phpstan analyse -c phpstan.dist.neon
	docker exec -it notification-microservice php bin/phpunit --testdox

php-cs-fixer:
	docker exec -it -e PHP_CS_FIXER_IGNORE_ENV=1 notification-microservice ./vendor/bin/php-cs-fixer fix src

composer-install:
	docker run -it --rm -u $(shell id -u):$(shell id -g) -v $(PWD):/app -w /app composer:2.8.8 composer install