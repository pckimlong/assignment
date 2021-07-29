<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_logins', function (Blueprint $table) {
            $table->bigInteger('id', false, true)->primary();
            $table->string('email', 100)->unique();
            $table->string('password', 100)->nullable(false);
            $table->timestamps();
            $table->rememberToken();

            $table->foreign('id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_logins');
    }
}
