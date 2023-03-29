<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terms', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200)->default('');
            $table->string('slug', 200)->default('');
            $table->bigInteger('term_group')->default(0);
            $table->string('taxonomy_name', 32)->default('');
            $table->unsignedBigInteger('taxonomy_id');
            $table->longText('description')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->bigInteger('count')->default(0);
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->integer('display_order')->default(0);
            $table->boolean('show_on_home_page')->default(false);
            $table->boolean('show_on_header')->default(false);
            $table->string("meta_img")->nullable();
            $table->string('small_img')->nullable();
            $table->integer('level')->default(0);

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('taxonomy_id')
                ->references('id')
                ->on('taxonomies')
                ->onDelete('cascade');

            $table->index('name');
            $table->index('slug');
            $table->index('taxonomy_name');
        });

        Schema::table('terms', function (Blueprint $table) {
            $table->foreign('parent_id')
                ->references('id')
                ->on('terms')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('terms');
    }
}
