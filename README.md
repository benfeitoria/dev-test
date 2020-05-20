# BLOG

## Requisitos
- [Laravel 7](https://laravel.com/docs/7.x/installation)
- PHP
- Postgres
- Npm (para build do vue.js)

## Instalação

### Usando docker
Use o script abaixo para baixar o projeto laradock e iniciar containers com nginx, php-fpm e postgres
```shell
./run.sh
```
##### Portas
Caso esteja usando a porta 80, deve ser editado o arquivo .env na pasta laradock e configurar postas alternativas, como no exemplo abaixo
- NGINX_HOST_HTTP_PORT=8573
- NGINX_HOST_HTTPS_PORT=8543
- NGINX_HOST_LOG_PATH=./logs/nginx/
- NGINX_SITES_PATH=./nginx/sites/
- NGINX_PHP_UPSTREAM_CONTAINER=php-fpm
- NGINX_PHP_UPSTREAM_PORT=9000
- NGINX_SSL_PATH=./nginx/ssl/

#### Instalando dependencias
Entrar no container do workspace onde é possível rodar comandos com composer e com npm
```shell
docker exec -it laradock_workspace_1 bash
```
Dentro do container do workspace
```shell
cd blog
composer install
npm install
npm run prod
```

#### Criando database
Se estiver utilizando docker entrar antes no containar do postgres para criar a base de dados
```shell
docker exec -it laradock_postgres_1 bash

psql -U default 

CREATE database blog;
```

#### Configurando projeto
Configurar o arquivo .env do projeto, renomeie o arquivo .env.example na pasta blog para .env
```shell
cp blog/.env.example blog/.env
```
Nesse arquivo anterior edite as diretivas abaixo:
- APP_NAME=BLOG
- DB_CONNECTION=pgsql
- DB_HOST=laradock_postgres_1
- DB_PORT=5432
- DB_DATABASE=blog
- DB_USERNAME=default
- DB_PASSWORD=secret

#### Rodando migrations e seeds na base
Entrar no container do php-fpm para rodar migrations
```shell
docker exec -it laradock_php-fpm_1 bash
```
Dentro do container 
```shell
cd blog
php artisan migrate:install
php artisan migrate

# Seeding 
php artisan db:seed --class Categorias
php artisan db:seed --class Users
php artisan db:seed --class Postagens
```

## Usando
http://localhost