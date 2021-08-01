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
            $table->id();
            $table->unsignedBigInteger('job_seeker_id', false);
            $table->timestamp('start_date')->nullable(false);
            $table->timestamp('end_date')->nullable();

            $table->boolean('is_current_job')->default(false);
            $table->string('job_name', 100)->nullable(false);
            $table->string('company', 100)->nullable(false);
            $table->longText('description')->nullable();
            $table->timestamps();

            $table->foreign('job_seeker_id')->references('id')->on('job_seekers')->onDelete('cascade');
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
