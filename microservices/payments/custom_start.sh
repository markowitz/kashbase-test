#!/bin/bash

if [[ ! -f "/var/www/.env" ]] && [[ -f "/var/www/.env.example" ]]; then
	cp /var/www/.env.example /var/www/.env
fi

if [[ -f "/var/www/.env" ]]; then
	sed -i "s/DB_PORT=.*/DB_PORT=${DB_PORT}/" /var/www/.env
	sed -i "s/DB_HOST=.*/DB_HOST=${DB_HOST}/" /var/www/.env
	sed -i "s/DB_DATABASE=.*/DB_DATABASE=${DB_NAME}/" /var/www/.env
	sed -i "s/DB_USERNAME=.*/DB_USERNAME=${DB_USERNAME}/" /var/www/.env
	sed -i "s/DB_PASSWORD=.*/DB_PASSWORD='${DB_PASSWORD}'/" /var/www/.env
	sed -i "s/DB_CONNECTION=.*/DB_CONNECTION=${DB_CONNECTION}/" /var/www/.env
fi

if [[ ! -z $TZ ]]; then
	sed -i "s#;date.timezone =#date.timezone = '${TZ}'#g" /etc/php/7.2/fpm/php.ini
fi

if [[ -d "/var/www/storage" ]]; then
	chmod -R 777 /var/www/storage
fi

php artisan key:generate


/start.sh
