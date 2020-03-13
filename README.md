# Rodando a Aplicação

1. Instale as dependencias do compose
`composer install`

<<<<<<< HEAD
* [Don't List](test-dont-list.md)
* [Blog](https://github.com/felipebiel/dev-test/tree/blog-teste "Blog")
=======
1. Instale as dependencias do NPM
`npm install`

1. Renomeie o arquivo *.env.example* para *.env*

1. Configure a conexão com o banco de dados no arquivo .env

1. Gere uma chave criptografada para a aplicação
`php artisan key:generate
`
1. Execute as migrações
`php artisan migrate`

1. Execute os seeds
`php artisan db:seed`

### Acesso
O seeder cria um usuário inicial com os seguintes dados:
- e-mail: admin@admin.com.br

- senha: 123456

Url de acesso: URLDOHOST/sistema ou URLDOHOST/login
>>>>>>> a5a92e5c456612a5a7113700c04f651faa5050fd
