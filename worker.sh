#!/bin/bash
docker-compose  exec -T php-fpm php ./bin/console.php telegram:send-notification