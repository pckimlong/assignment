<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->binary('logo')->nullable();
            $table->text('company_name')->nullable();
            $table->longText('description')->nullable();
            $table->unsignedBigInteger('industry_id', false)->nullable();
            $table->string('website', 100)->nullable();
            $table->text('email')->nullable();
            $table->text('phone')->nullable();
            $table->text('address')->nullable();
            $table->unsignedBigInteger('province_id', false)->nullable();
            $table->string('contact_person_name', 100)->nullable();
            $table->timestamps();

            $table->foreign('industry_id')->references('id')->on('industries');
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
        Schema::dropIfExists('companies');
    }
}
