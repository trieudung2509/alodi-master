<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string('sub_title');
            $table->string("slug");
            $table->string('version')->nullable();
            $table->string("small_img")->nullable();
            $table->string("meta_img")->nullable();
            $table->text("meta_keywords")->nullable();
            $table->string("meta_title")->nullable();
            $table->string('source_url')->nullable();
            $table->string('short_description')->nullable();
            $table->string("meta_description")->nullable();
            $table->longText("description")->nullable();
            $table->dateTime('published_date');
            $table->integer("status")->default(0);
            $table->dateTime('display_date');
            $table->integer('priority_type')->nullable();
            $table->unsignedInteger('author_id');
            $table->unsignedInteger('editor_id')->nullable();

            $table->foreign('author_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('editor_id')
                ->references('id')
                ->on('users');
            $table->timestamps();
            $table->softDeletes("deleted_at")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
