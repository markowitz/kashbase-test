#!/bin/bash

if [[ ! -z $TZ ]]; then
	sed -i "s#;date.timezone =#date.timezone = '${TZ}'#g" /etc/php/7.2/fpm/php.ini
fi

if [[ -d "/var/www/storage" ]]; then
	chmod -R 777 /var/www/storage
fi

/start.sh
