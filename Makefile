intro:
	@echo "Recipesite"

setup:
	composer install
	cp .env.example .env
	php artisan key:generate
	php artisan storage:link

update: do_composer do_assets migrate do_ide_helper do_clear_cache do_storage_link

migrate:
	php artisan migrate:fresh --seed

test:
	php artisan test --parallel

test-coverage:
	php -d zend_extension="xdebug.so" -d xdebug.mode=coverage ./vendor/bin/phpunit --coverage-html ./public/coverage

codestyle:
		./vendor/bin/ecs --config=ecs-config.php check

codestyle-fix:
		./vendor/bin/ecs --config=ecs-config.php check --fix

do_composer:
	composer install

do_assets:
	npm install
	npm run dev

do_ide_helper:
	php artisan ide-helper:generate
	php artisan ide-helper:models --nowrite
	php artisan ide-helper:eloquent
	php artisan ide-helper:meta

do_clear_cache:
	php artisan optimize:clear

do_storage_link:
	php artisan storage:link

deploy:
	php artisan down
	git reset --hard
	git pull
	php artisan migrate
	npm i
	npm run production
	composer install --optimize-autoloader --no-dev
	php artisan config:cache
	php artisan route:cache
	php artisan view:cache
	php artisan optimize
	php artisan storage:link
	@echo "DONT FORGET TO SET 'APP_DEBUG' TO 'false' AND 'APP_ENV' TO 'production' IN .env!!!!"
	php artisan up

# Aliases
u: update
t: test
tc: test-coverage
coverage: test-coverage
format: codestyle-fix
c: codestyle
cf: codestyle-fix
