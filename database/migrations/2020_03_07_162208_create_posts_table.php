<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
		    $table->integer('users_id')->unsigned();
		    $table->string('img_destaque', 255)->nullable();
		    $table->string('titulo', 150)->nullable();
		    $table->text('conteudo')->nullable();
		    $table->date('data_publicacao')->nullable();
			
		    $table->foreign('users_id')
                ->references('id')->on('users');
                
            $table->softDeletes(); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
