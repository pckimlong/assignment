<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobSeekerEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_seeker_education', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_seeker_id', false);
            $table->text('certification')->nullable(false);
            $table->text('major')->nullable(false);
            $table->text('school_name')->nullable(false);
            $table->timestamp('start_date')->nullable(false);
            $table->timestamp('graduated_date')->nullable();
            $table->boolean('is_current')->default(false);
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
        Schema::dropIfExists('job_seeker_education');
    }
}
