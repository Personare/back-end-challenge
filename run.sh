#!/bin/bash

case "$1" in
	start)
		docker-compose up -d
		docker exec -ti php-composer-currency-app composer install
		;;
	build)
		docker-compose up -d --build
		;;
	*)
		echo "Usage: ./run.sh {start|build}"
		exit 1
esac