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
<p>
Executar a aplicação
<br><code>php artisan serve</code> ou
<br><code>sudo php -S localhost:80 -t public</code>
</p>
<br>
<h3>Acessando o sistema</h3>
Para acessar o sistema click o link login no canto superio direito da tela inicial e utilize o
 <br>Usuario <b>admin@admin.com</b>
 <br>Senha <b>admin123</b><br>
 
 Tambem pode se registrar novos usuários o mesmo ao publicar um post se torna um autor
 
 
 


