<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_languages', function (Blueprint $table) {
            $table->bigInteger('language_id', false, true);
            $table->bigInteger('job_post_id', false, true);
            $table->timestamps();

            $table->primary(['language_id', 'job_post_id']);
            $table->foreign('language_id')->references('id')->on('languages');
            $table->foreign('job_post_id')->references('id')->on('job_posts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_languages');
    }
}
