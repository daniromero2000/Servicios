<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssesorQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assesor_quotations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('lastName', 100);
            $table->string('cedula', 10)->nullable();
            $table->string('phone', 50);
            $table->string('email', 100)->nullable();
            $table->string('product_id');
            $table->integer('product_price');
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
        Schema::dropIfExists('assesor_quotations');
    }
}
