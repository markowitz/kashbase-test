#!/bin/bash

if [[ ! -z $TZ ]]; then
	sed -i "s#;date.timezone =#date.timezone = '${TZ}'#g" /etc/php/7.2/fpm/php.ini
fi

if [[ -d "/var/www/storage" ]]; then
	chmod -R 777 /var/www/storage
fi

# Max out PHP Settings
sed -i "s/pm.max_children.*/pm.max_children = 70/" /etc/php/7.2/fpm/pool.d/www.conf
sed -i "s/pm.start_servers.*/pm.start_servers = 20/" /etc/php/7.2/fpm/pool.d/www.conf
sed -i "s/pm.min_spare_servers.*/pm.min_spare_servers = 20/" /etc/php/7.2/fpm/pool.d/www.conf
sed -i "s/pm.max_spare_servers.*/pm.max_spare_servers = 35/" /etc/php/7.2/fpm/pool.d/www.conf
sed -i "s/pm.max_requests.*/pm.max_requests = 500/" /etc/php/7.2/fpm/pool.d/www.conf

# /etc/php/7.2/fpm/pool.d/www.conf
# CHANGE PHP SETTINGS FOR
# pm.max_children = 70
# pm.start_servers = 20
# pm.min_spare_servers = 20
# pm.max_spare_servers = 35
# pm.max_requests = 500


service nginx start
service php7.2-fpm start
ln -s /etc/nginx/sites-available/default.conf /etc/nginx/sites-enabled/.

/start.sh
