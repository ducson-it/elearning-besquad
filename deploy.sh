#!/bin/bash

# Go to your project directory
cd /var/www/beesquad

# Pull the latest code from the repository
git pull origin main
# Install dependencies
composer install --no-interaction --no-dev --prefer-dist
composer update
# Clear application cache
php artisan cache:clear

# Run database migrations (if applicable)
php artisan system:install
# Restart your web server (if necessary)
npm install

sudo systemctl restart nginx
