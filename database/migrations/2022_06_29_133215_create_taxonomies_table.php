<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxonomiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxonomies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 32)->default('');
            $table->longText('description')->nullable();
            $table->string('slug', 200)->default('');
            $table->boolean('is_hierarchical')->default(false);
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->integer('display_order')->default(0);
            $table->boolean('show_on_header')->default(false);
            $table->string("meta_img")->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->unique('name');
            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taxonomies');
    }
}
