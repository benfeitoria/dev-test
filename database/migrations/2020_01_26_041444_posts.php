<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Posts extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('autor');
            $table->string('titulo');
            $table->text('conteudo');
            $table->unsignedInteger('id_category');
            $table->timestamp('publicacao');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->foreign('id_category')->references('id')->on('categories');    
        });
    }
  
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
