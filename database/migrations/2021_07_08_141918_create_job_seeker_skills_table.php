<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobSeekerSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_seeker_skills', function (Blueprint $table) {
            $table->unsignedBigInteger('job_seeker_id', false);
            $table->unsignedBigInteger('skill_id', false);
            $table->timestamps();

            $table->primary(['job_seeker_id','skill_id']);
            $table->foreign('job_seeker_id')->references('id')->on('job_seekers');
            $table->foreign('skill_id')->references('id')->on('skill_sets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_seeker_skills');
    }
}
