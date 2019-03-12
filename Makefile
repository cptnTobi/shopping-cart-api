dev:
	@composer install
	@bin/console server:run
test:
	@vendor/bin/phpspec run
psr2:
	@vendor/bin/phpcs --standard=PSR2 src