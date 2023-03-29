<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_reports', function (Blueprint $table) {
            $table->id();
            $table->string("blog_name");
            $table->dateTime('work_date');
            $table->integer('words_count')->nullable();
            $table->integer('images_count')->nullable();
            $table->boolean('is_created')->nullable();
            $table->string('display_link')->nullable();
            $table->longText('notes')->nullable();
            $table->softDeletes("deleted_at")->nullable();
            $table->timestamps();
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
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
        Schema::dropIfExists('work_reports');
    }
}
