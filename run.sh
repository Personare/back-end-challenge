#!/bin/bash

case "$1" in
	start)
		docker-compose up -d
		docker exec -ti php-composer-currency-app composer install
		;;
	build)
		docker-compose up -d --build
		;;
	test)
		docker exec -ti php-currency-app vendor/phpunit/phpunit/phpunit --testdox app/test
		;;
	*)
		echo "Usage: ./run.sh {start|build|test}"
		exit 1
esac