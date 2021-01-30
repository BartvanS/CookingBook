setup:
	composer install
	cp .env.example .env
	php artisan key:generate
	php artisan storage:link

update: do_composer do_assets migrate do_ide_helper

migrate:
	php artisan migrate:fresh --seed

test:
	php artisan test --parallel

test-coverage:
	php -d zend_extension="xdebug.so" -d xdebug.mode=coverage ./vendor/bin/phpunit --coverage-html ./public/coverage

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
