<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriasPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias_posts', function (Blueprint $table) {
            $table->increments('id');
		    $table->integer('posts_id')->unsigned();
		    $table->integer('categorias_id')->unsigned();
		
		    $table->foreign('posts_id')
		        ->references('id')->on('posts');
		
		    $table->foreign('categorias_id')
                ->references('id')->on('categorias');
                
            $table->softDeletes(); 
		    $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categorias_posts');
    }
}
