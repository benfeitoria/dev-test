<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*CRIA O PRIMEIRO USUARIO PADRÂO DA APLICAÇÂO*/
        $user = User::create([
            'name'      => 'Admin Teste',
            'email'     => 'admin@admin.com.br',
            'password'  => bcrypt('12345678'),
        ]);

        $this->command->info('User administrativo admin@admin.com.br foi criado com a senha 12345678');
    }
}
