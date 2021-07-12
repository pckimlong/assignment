<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobSeekersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_seekers', function (Blueprint $table) {
            $table->id();
            $table->string('firstname', 30)->nullable(false);
            $table->string('lastname', 30)->nullable(false);
            $table->string('phone_number', 10)->nullable(false);
            $table->char('gender', 1)->nullable(true);
            $table->timestamp('birthdate')->nullable();
            $table->binary('profile_image')->nullable();
            $table->text('current_address')->nullable();
            $table->text('qualification')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_seekers');
    }
}
