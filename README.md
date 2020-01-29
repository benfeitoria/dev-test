Development Environment

Requirements

PHP 7.3+ / Mysql 8 / VueJs / Composer / redis

Instalação

clone este repositório em um ambiente com nginx ou apache

.ENV
DB_HOST = host do seu mysql IP
DB_REDIS = host do seu redis IP

Criar base com o nome default

rode o composer 'composer install --ignore-platform-reqs'

rode as migrations 'php artisan migrate'

de permissão para a pasta /storage 

Para acessar o projeto funcionando basta acessar o meu heroku
http://blogwithvue.herokuapp.com/


Endereço da api

http://blogwithvue.herokuapp.com/api/allarticles




