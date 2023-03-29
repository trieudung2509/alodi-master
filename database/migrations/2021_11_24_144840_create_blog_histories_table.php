<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_histories', function (Blueprint $table)
        {
            $table->id();
            $table->string('category_names')->nullable();
            $table->integer('blog_id');
            $table->string('title');
            $table->string('sub_title');
            $table->string('slug');
            $table->string('version')->nullable();
            $table->string("small_img")->nullable();
            $table->string("meta_img")->nullable();
            $table->text("meta_keywords")->nullable();
            $table->string("meta_title")->nullable();
            $table->string('source_url')->nullable();
            $table->string('short_description')->nullable();
            $table->string("meta_description")->nullable();
            $table->longText("description")->nullable();
            $table->integer("status");
            $table->integer('priority_type')->nullable();
            $table->dateTime('replaced_at');
            $table->unsignedInteger('editor_id')->nullable();

            $table->foreign('editor_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_histories');
    }
}
