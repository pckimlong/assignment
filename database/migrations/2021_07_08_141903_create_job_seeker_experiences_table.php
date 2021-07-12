<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobSeekerExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_seeker_experiences', function (Blueprint $table) {
            $table->unsignedBigInteger('job_seeker_id', false);
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();

            $table->boolean('is_current_job')->default(false);
            $table->string('job_name', 100);
            $table->string('work_place_name', 100);
            $table->text('job_address')->nullable();
            $table->unsignedBigInteger('province_id', false)->nullable();
            $table->timestamps();

            // $table->primary(['job_seeker_id', 'start_date','end_date']);
            $table->foreign('job_seeker_id')->references('id')->on('job_seekers');
            $table->foreign('province_id')->references('id')->on('provinces');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_seeker_experiences');
    }
}
