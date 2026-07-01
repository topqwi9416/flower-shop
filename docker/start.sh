#!/bin/sh
set -e

php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
php artisan migrate --force
php artisan config:cache
php artisan route:cache

exec supervisord -c /etc/supervisor/conf.d/supervisord.conf