<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CategoriesTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // categories and tags table
    		Schema::create('categories', function(Blueprint $table)
    		{
    			$table->increments('id');    			
    			$table->string('name');
    			
    		});
    		
    		Schema::create('tags', function(Blueprint $table)
    		{
    			$table->increments('id');
    			$table->string('name');
    			 
    		});
    		
    		Schema::create('post_categories', function(Blueprint $table)
    		{
    			$table->increments('id');
    			$table->integer('post')->unsigned();
    			$table->foreign('post')->references('id')->on('posts')->onDelete('cascade');
    			$table->integer('category')->unsigned();
    			$table->foreign('category')->references('id')->on('categories')->onDelete('cascade');
    			 
    		});
    		
    		Schema::create('post_tags', function(Blueprint $table)
    		{
    			$table->increments('id');
    			$table->integer('post')->unsigned();
    			$table->foreign('post')->references('id')->on('posts')->onDelete('cascade');
    			$table->integer('tag')->unsigned();
    			$table->foreign('tag')->references('id')->on('tags')->onDelete('cascade');
    		
    		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('post_tags');
        Schema::drop('post_categories');
        Schema::drop('tags');
        Schema::drop('categories');
    }
}
