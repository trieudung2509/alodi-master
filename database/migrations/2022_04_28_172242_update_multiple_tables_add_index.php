<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMultipleTablesAddIndex extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blogs', function(Blueprint $table) {
            $table->index("title");
            $table->index("display_date");
            $table->index("published_date");
            $table->index("status");
            $table->index("featured");
        });

        Schema::table('blog_histories', function(Blueprint $table) {
            $table->index("title");
            $table->index('replaced_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blogs', function(Blueprint $table) {
            $table->dropIndex(['title']);
            $table->dropIndex(['display_date']);
            $table->dropIndex(['published_date']);
            $table->dropIndex(['status']);
            $table->dropIndex(['featured']);
        });

        Schema::table('blog_histories', function(Blueprint $table) {
            $table->dropIndex(['title']);
            $table->dropIndex(['replaced_at']);
        });
    }
}
