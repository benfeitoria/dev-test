<?php

use Illuminate\Database\Seeder;

class PostCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Model\PostCategories::class,30)->create();
    }
}
