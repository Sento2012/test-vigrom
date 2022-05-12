#!/usr/bin/make
SHELL = /bin/bash

install:
	docker-compose build --no-cache
	docker-compose up -d
	docker exec -it php-apache-test-api composer install
	sleep 30
	docker exec -i db-test-api mysql -uroot -proot root < src/db.sql
