<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobPostLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_post_locations', function (Blueprint $table) {
            $table->unsignedBigInteger('province_id', false);
            $table->unsignedBigInteger('job_post_id', false);
            $table->timestamps();

            $table->primary(['province_id', 'job_post_id']);
            $table->foreign('province_id')->references('id')->on('provinces');
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
        Schema::dropIfExists('job_post_locations');
    }
}
