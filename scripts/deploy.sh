#!/bin/bash

set -e
user=root
ip="157.245.139.82"
environment="prod"

echo "Iniciando deploy"
# Buildeamos la imagen de docker con version y ambiente
image_name="ghcr.io/ivanmoa/caoconsolidacion"
rsync -v -a --delete --include="docker-compose.prod.yml" --exclude='*' . "$user@$ip":"/$user/deploy"
# Se construye la imagen
docker buildx build --platform linux/amd64 -t "$image_name:latest"  --build-arg GITHUB_NPM_REGISTRY_ACCESS_TOKEN=$GITHUB_NPM_REGISTRY_ACCESS_TOKEN . --push

docker_compose_folder="/$user/deploy/"
docker_compose_file="docker-compose.$environment.yml"

ssh "$user@$ip" "cd $docker_compose_folder && docker compose -f $docker_compose_file pull"

ssh "$user@$ip" "cd $docker_compose_folder && docker compose -f $docker_compose_file up -d"

echo "Deploy finalizado"

