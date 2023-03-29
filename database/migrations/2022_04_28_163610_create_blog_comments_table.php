<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_comments', function (Blueprint $table) {
            $table->id();
            $table->longText("description")->nullable();
            $table->unsignedInteger('author_id');
            $table->string('author_name');
            $table->boolean('is_approved');
            $table->unsignedBigInteger('blog_id');

            $table->foreign('author_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('blog_id')
                ->references('id')
                ->on('blogs')
                ->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes("deleted_at")->nullable();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unique('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_comments');
        Schema::table('users', function (Blueprint $table) {
           $table->dropUnique(['email']);
        });
    }
}
