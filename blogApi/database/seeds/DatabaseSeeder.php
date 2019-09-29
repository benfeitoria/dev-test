<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('categorias')->insert(
            array(
                      0 => ['titulo'=>'Esporte','created_at'=> Carbon::now(), 'updated_at'=>Carbon::now() ],
                      1 => ['titulo'=>'Cultura','created'=> Carbon::now(), 'updated_at'=>Carbon::now() ],
                      2 => ['titulo'=>'Cinema','created'=> Carbon::now(), 'updated_at'=>Carbon::now() ],
                      3 => ['titulo'=>'Lazer','created'=> Carbon::now(), 'updated_at'=>Carbon::now() ],
                 )
        );
    }
}
