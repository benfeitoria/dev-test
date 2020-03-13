# Rodando a Aplicação

1. Instale as dependencias do compose
`composer install`

1. Instale as dependencias do NPM
`npm install`

1. Copie e renomeie o arquivo *.env.example* para *.env*

1. Configure a conexão com o banco de dados no arquivo .env

1. Gere uma chave criptografada para a aplicação
`php artisan key:generate`

1. Execute as migrações
`php artisan migrate`

1. Execute os seeds
`php artisan db:seed`

1. Crie o atalho da pasta storange com a public (Para o Upload)
`php artisan storage:link`

1. Execute o servidor local do Laravel
`php artisan serve`

### Acesso
O seeder cria um usuário inicial com os seguintes dados:
- e-mail: admin@admin.com.br

- senha: 123456

Url de acesso: http://127.0.0.1:8000/sistema ou http://127.0.0.1:8000/login