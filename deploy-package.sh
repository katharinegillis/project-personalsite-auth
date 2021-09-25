#!/bin/bash

tar -czf deploy.tar.gz \
  deploy.sh \
  docker-compose.yml \
  docker-compose.prod.yml \
  docker-compose.ssl.yml \
  .env.dist