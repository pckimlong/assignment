<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobSeekerLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_seeker_languages', function (Blueprint $table) {
            $table->unsignedBigInteger('job_seeker_id'. false)->primary();
            $table->unsignedBigInteger('languageId',false);
            $table->text('level')->nullable();
            $table->timestamps();

            $table->foreign('job_seeker_id')->references('id')->on('job_seekers');
            $table->foreign('languageId')->references('id')->on('languages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_seeker_languages');
    }
}
