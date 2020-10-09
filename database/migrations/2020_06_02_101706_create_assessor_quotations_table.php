<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssessorQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessor_quotations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('lastName', 100);
            $table->string('identificationNumber', 20)->nullable();
            $table->string('telephone', 50);
            $table->string('email', 100)->nullable();
            $table->string('total', 100);
            $table->string('state', 100);
            $table->boolean('termsAndConditions');
            $table->integer('assessor_id');
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
        Schema::dropIfExists('assessor_quotations');
    }
}
