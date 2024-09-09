USER_ID:=$(shell id -u)
GROUP_ID:=$(shell id -g)
CURRENT_DIR:=$(shell pwd)

build:
	USER_ID=$(USER_ID) GROUP_ID=$GROUP_ID docker build . -t notification-microservice

start:
	USER_ID=$(USER_ID) GROUP_ID=$GROUP_ID docker compose up -d

stop:
	USER_ID=$(USER_ID) GROUP_ID=$GROUP_ID docker compose down

bash:
	docker exec -it -u $(USER_ID):$(GROUP_ID) notification-microservice /bin/bash
bash-root:
	docker exec -it notification-microservice /bin/bash