<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	
    		// blog table
    		Schema::create('posts', function(Blueprint $table)
    		{
    			$table->increments('id');
    			$table -> integer('author_id')->unsigned()->default(0);
    			$table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
    			
    			$table->string('title');
    			$table->text('body');
    			$table->string('slug')->unique();
    			$table->boolean('active');
    			$table->timestamps();
    			$table->timestamp('published_at')->index()->nullable();
    		});
    		
    		//id, on_blog, from_user, body, at_time
    		Schema::create('comments', function(Blueprint $table)
    		{
    			$table->increments('id');
    			$table->integer('on_post')->unsigned()->default(0);
    			$table->foreign('on_post')->references('id')->on('posts')->onDelete('cascade');
    			$table->integer('from_user')->unsigned()->default(0);
    			$table->foreign('from_user')->references('id')->on('users')->onDelete('cascade');
    			$table->text('body');
    			$table->timestamps();
    		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('comments');
        Schema::drop('posts');
    }
}
