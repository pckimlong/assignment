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
            $table->bigInteger('company_id', false, true);
            $table->text('job_title')->nullable(false);
            $table->boolean('is_active')->nullable(false)->default(true);
            $table->boolean('is_agent')->nullable(false)->default(false);
            $table->integer('hire_amount')->unsigned()->nullable(false)->default(1);
            $table->text('job_level')->nullable(false);
            $table->decimal('min_salary', 8, 2)->nullable();
            $table->decimal('max_salary', 8, 2)->nullable();
            $table->integer('min_age')->unsigned()->nullable();
            $table->integer('max_age')->unsigned()->nullable();
            $table->longText('job_location')->nullable(false);
            $table->longText('languages')->nullable(false);
            $table->longText('specifications')->nullable();
            $table->string('skills');
            $table->char('sex', 1);
            $table->string('term', 30)->nullable();
            $table->integer('year_of_experience')->unsigned()->nullable();
            $table->text('qualification')->nullable();
            $table->timestamp('deadline');
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies')->on('companies')->onDelete('cascade');;
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
