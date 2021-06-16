# 💻 Desafio Benfeitoria

> Desafio proposto para o processo seletivo de Desenvolvedor, com o intuito de avaliar o conhecimento exigido para a vaga.

## ⚠ Requisitos:

- PHP >= 7.2.5
- Node.Js >= 12.13.1
- NPM >= 6.13.4
- PostgreSQL >= 12.2

##### Deve ter o ambiente para o laravel configurado:

- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

## Ferramentas e Tecnologias utilizadas:

- PHP 7.4.14 
- Laravel 8.x
  - Laravel Mix
  - Laravel Debugar
- Vuejs
- Docker & docker-compose

## ⚡ Mão na massa:

> Você pode realizar o clone deste repositório ou baixar o arquivo .zip!

##### Clone este repositório:

````
git clone https://github.com/huriellopes/dev-test.git
````

Para baixar o zip: [https://github.com/huriellopes/dev-test/archive/master.zip](https://github.com/huriellopes/Desafio-ValidHub/archive/master.zip)

## ✔ Executando a aplicação:

##### Na raiz do projeto, execute os comandos:

````
# Para instalar as dependências do Laravel
componser install

# Para instalar as dependecias do node_modules
npm install && npm run dev
```` 

##### Copie e configure as variaveis de ambiente no arquivo .env:

````
# Para copiar o .env.example para .env
copy .env.example .env ou cp .env.example .env

# Para gerar a key do projeto
php artisan key:generate

# configure as seguintes variaveis de ambiente
DB_CONNECTION=pgsql # default = mysql
DB_HOST=127.0.0.1
DB_PORT=5432 # default = 3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

# Atenção: Deve ser PostgreSQL e lembre-se de criar o schema/banco!
````

> Obs.: Caso queira utilizar docker, gá um docker-compose na raiz do projeto para startar dois containers,
>o do php e o do banco de dados, antes de startar, configure as credenciais do banco de dados!

````
environment:
 POSTGRES_USER: "postgres" ou "nome_user_desejado"
 POSTGRES_PASSWORD: "senha_desejada"
 POSTGRES_DB: "nome_banco"

# O banco de dados está isolado, apenas a aplicação acessa!
````

##### Depois de configurar as variaveis de ambiente, ainda no raiz do projeto, execute os comandos:

````
# Para rodar as migrates e seeds
php artisan migrate --seed

# Caso queira desafazer
php artisan migrate:rollback

# Para rodar o servidor embutido => Caso opte por rodar localmente.
php artisan serve

# Irá executar na seguinte url, abra no navegador
http://localhost:8000

> Caso opte por rodar no docker, acesse no navegador:
http://localhost
````

## Créditos

Empresa Benfeitoria - Pelo desafio proposto

## 📝 Licença

Esse projeto está sob a licença MIT. Veja aqui [MIT](LICENSE)
