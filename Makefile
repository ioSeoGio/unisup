all:
	echo hello, this is makefile 

bash:
	docker-compose run --rm unisup_php bash

build:
	docker-compose build
	
db-rights:
	if [ -d database/ ]; \
	then \
		sudo chmod 777 -R database/; \
	fi;	

vendor-rights:
	if [ -d vendor/ ]; \
	then \
		sudo chmod 777 -R vendor/; \
	fi;

migrations-rights:
	if [ -d vendor/ ]; \
	then \
		sudo chmod 777 -R migrations/; \
	fi;

rights: db-rights vendor-rights migrations-rights
	sudo chmod 777 -R web/
	sudo chmod 777 -R runtime/

	sudo chmod 777 -R message/
	sudo chmod 777 -R tests/

down:
	docker-compose down
up:
	docker-compose up -d

restart: down up	

init: rights build up composer-install migrate

rebuild: down db-rights build

api-test:
	vendor/bin/codecept run api

unit-test:
	vendor/bin/codecept run unit

test: unit-test api-test

composer-install:
	docker-compose run --rm unisup_php composer install

migrate:
	docker-compose run --rm unisup_php php yii migrate --interactive=0
