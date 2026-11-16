#!/bin/sh
set -eu

cd /var/www/html

mkdir -p \
    storage/app/public \
    storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache \
    /var/lib/laravel/database

chown -R www-data:www-data storage bootstrap/cache /var/lib/laravel/database

if [ "${DB_CONNECTION:-sqlite}" = "sqlite" ]; then
    database_path="${DB_DATABASE:-/var/lib/laravel/database/database.sqlite}"
    case "$database_path" in
        /*) ;;
        *) database_path="/var/www/html/$database_path" ;;
    esac
    mkdir -p "$(dirname "$database_path")"
    touch "$database_path"
    chown www-data:www-data "$database_path"
fi

gosu www-data php artisan migrate --force

exec "$@"
