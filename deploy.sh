#!/bin/bash

# Recreate the .env file
envsubst < .env.dist > .env

PARENT_PWD=${PWD%/*}
CURRENT_DIR=${PWD##*/}

echo "COMPOSE_PROJECT_NAME=${PARENT_PWD##*/}-${CURRENT_DIR}" >> .env

if [[ ! -d var ]]; then
    mkdir var
fi

# Update instance
docker-compose -f docker-compose.yml -f docker-compose.prod.yml -f docker-compose.ssl.yml pull
docker-compose -f docker-compose.yml -f docker-compose.prod.yml -f docker-compose.ssl.yml up -d --remove-orphans

# Update database
docker-compose -f docker-compose.yml -f docker-compose.prod.yml -f docker-compose.ssl.yml exec -T app php bin/console doctrine:migrations:migrate --no-interaction

# Clean up old networks and images
docker system prune -f