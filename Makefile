run:
	docker-compose up -d

install:
	docker-compose exec emms composer install;

da:
	docker-compose exec emms composer dump-autoload;

up:
	docker-compose exec emms composer update;

cc:
	docker-compose exec emms php bin/console cache:clear;

qa:
	docker-compose exec emms composer lint-fix;
	docker-compose exec emms composer phpstan;
	docker-compose exec emms composer phpmd;

phpunit:
	docker-compose exec emms ./vendor/bin/phpunit;

migration:
	docker-compose exec emms php bin/console make:migration;

migrate:
	docker-compose exec emms php bin/console doctrine:migrations:migrate;

migrate-test:
	docker-compose exec emms php bin/console doctrine:migrations:migrate --env=test;

fixtures-load:
	docker-compose exec emms php bin/console doctrine:fixtures:load;

debug-messenger:
	docker-compose exec emms php bin/console debug:messenger;

git-refresh:
	git checkout development; git pull origin development;

git-reset:
	git checkout development; git pull origin development; git branch | grep -v "development" | grep -v "staging" | grep -v "main" | xargs git branch -D;
