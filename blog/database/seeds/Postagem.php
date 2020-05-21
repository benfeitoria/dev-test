<?php

use Illuminate\Database\Seeder;

class Postagem extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Model\Postagem::class, 50)->create();
    }
}
