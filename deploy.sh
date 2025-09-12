#!/bin/bash
cd /var/www/vhosts/laravel-asdin.com/httpdocs/laravel
git pull origin main
docker-compose down
docker-compose up -d --build
docker system prune -f
