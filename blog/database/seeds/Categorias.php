<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Categorias extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $createdAt = date('Y-m-d H:i:s');
        
        for ($i = 1; $i <= 5; $i++) {
          
            switch ($i) {
              case 1:
                $descricao = 'Geral';
                break;
              
              case 2:
                $descricao = 'Gizu';
                break;

              case 3:
                $descricao = 'Inve';
                break;

              case 4:
                $descricao = 'Diarturoy';
                break;

              case 5:
                $descricao = 'Keynro';
                break;
            }
            
            DB::table('categorias')->insert([
              'descricao' => $descricao,
              'created_at' => $createdAt
            ]);
        }
    }
}
