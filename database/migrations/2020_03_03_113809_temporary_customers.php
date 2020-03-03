<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TemporaryCustomers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temporary_customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('documentType')->nullable();
            $table->string('documentNumber')->nullable();
            $table->timestamp('documentIssueDate')->nullable();
            $table->string('economicActivity')->nullable();
            $table->string('email')->nullable();
            $table->string('cellPhone')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('temporary_customers');
    }
}