<h5>SETUP</h5>
<b>Execute os seguintes comandos</b>
<p>
Instala as dependências do projeto a partir do arquivo composer.lock, se presente, ou recai no composer.json.
<br><code>composer install</code>
</p>
<p>
Instala as dependências do projeto a partir do arquivo package.lock.json, se presente, ou recai no package.json.
<br><code>npm install</code><br>
</p>

<p>
Define a chave do aplicativo
<br><code>php artisan key:generate</code><br>
</p>
<h5>Configure o arquivo .env</h5>
<p>
Cria o repositório de migração
<br><code>php artisan migrate</code><br>
</p>

<p>
popular o banco de dados com registros
<br><code>php artisan db:seed</code>
</p>
<p>
Cria um link simbólico de ""public/storage"" para "storage/app/public"
<br><code>php artisan storage:link</code>
</p>

