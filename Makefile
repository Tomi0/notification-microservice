USER_ID:=$(shell id -u)
GROUP_ID:=$(shell id -g)
CURRENT_DIR:=$(shell pwd)

build:
	USER_ID=$(USER_ID) GROUP_ID=$GROUP_ID docker build . -t notification-microservice

make listen:
	USER_ID=$(USER_ID) GROUP_ID=$GROUP_ID \
		docker run --rm --init -v $(CURRENT_DIR):/app \
		--network notification-microservice_default \
		--name notification-microservice -u $(USER_ID):$(GROUP_ID) \
		notification-microservice php bin/console notifications:listen

up:
	docker compose up -d

down:
	docker compose down

bash:
	docker exec -it -u $(USER_ID):$(GROUP_ID) notification-microservice /bin/sh