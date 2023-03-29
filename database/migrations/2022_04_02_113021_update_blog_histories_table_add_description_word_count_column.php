<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBlogHistoriesTableAddDescriptionWordCountColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blog_histories', function(Blueprint $table) {
            $table->integer("description_word_count")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blog_histories', function(Blueprint $table) {
            $table->dropColumn("description_word_count");
        });
    }
}
