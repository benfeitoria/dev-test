<?php 

use Illuminate\Database\Seeder;


class CategoriasTableSeeder extends Seeder
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
                    0 => ['titulo'=>'Esporte','created_at'=> now(), 'updated_at'=>now() ],
                    1 => ['titulo'=>'Cultura','created'=> now(), 'updated_at'=>now() ],
                    2 => ['titulo'=>'Cinema','created'=> now(), 'updated_at'=>now() ],
                    3 => ['titulo'=>'Lazer','created'=> now(), 'updated_at'=>now() ],
               )
      );
    }
}