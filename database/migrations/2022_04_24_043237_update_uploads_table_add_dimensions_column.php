<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUploadsTableAddDimensionsColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('uploads', function(Blueprint $table) {
            $table->integer("width")->nullable();
            $table->integer("height")->nullable();
            $table->index("width");
            $table->index("height");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('uploads', function(Blueprint $table) {
            $table->dropIndex(['width']);
            $table->dropIndex(['height']);
            $table->dropColumn("width");
            $table->dropColumn("height");
        });
    }
}
