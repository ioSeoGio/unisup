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

	sudo chmod 777 -R tests/

down:
	docker-compose down
up:
	docker-compose up -d

restart: down up	

init: rights build up composer-install migrate swagger

init-w-f: init load-fixtures

rebuild: down db-rights build

api-test:
	docker-compose run --rm unisup_php vendor/bin/codecept run api

unit-test:
	docker-compose run --rm unisup_php vendor/bin/codecept run unit

test: unit-test api-test

composer-install:
	docker-compose run --rm unisup_php composer install

migrate:
	docker-compose run --rm unisup_php php yii_test migrate --interactive=0
	docker-compose run --rm unisup_php php yii migrate --interactive=0
migrate-prev:
	docker-compose run --rm unisup_php php yii_test migrate/down --interactive=0
	docker-compose run --rm unisup_php php yii migrate/down --interactive=0

load-fixtures:
	docker-compose run --rm unisup_php php yii fixture/load '*' --interactive=0

reload-fixtures:
	docker-compose run --rm unisup_php php yii migrate/fresh --interactive=0
	docker-compose run --rm unisup_php php yii fixture/load '*' --interactive=0

db-refresh:
	docker-compose run --rm unisup_php php yii_test migrate/fresh --interactive=0
	docker-compose run --rm unisup_php php yii migrate/fresh --interactive=0

cs-fix:
	docker-compose run --rm unisup_php composer cs-fix

pre-push: cs-fix test

swagger:
	docker-compose run --rm unisup_php composer swagger-generate

git-pull:
	git pull
	make composer-install
	docker-compose run --rm unisup_php composer swagger-generate
