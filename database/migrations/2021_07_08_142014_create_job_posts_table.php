<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->text('job_title')->nullable(false);
            $table->bigInteger('company_id', false, true);
            $table->boolean('is_active')->nullable(false)->default(true);
            $table->integer('hire_amount')->unsigned()->nullable(false)->default(1);
            $table->decimal('min_salary', 5, 2)->nullable();
            $table->decimal('max_salary', 5, 2)->nullable();
            $table->integer('min_age')->unsigned()->nullable();
            $table->integer('max_age')->unsigned()->nullable();
            $table->string('employment_type');
            $table->longText('specifications')->nullable(false);
            $table->char('sex', 1);
            $table->string('term', 30)->nullable();
            $table->integer('year_of_experience')->unsigned()->nullable();
            $table->bigInteger('skill_set_id')->unsigned()->nullable();
            $table->text('qualification')->nullable();
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('skill_set_id')->references('id')->on('skill_sets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_posts');
    }
}
