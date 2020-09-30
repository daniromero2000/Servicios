<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssesorQuotationValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assesor_quotation_values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('assesor_quotation_id');
            $table->integer('product_id');
            $table->string('quantity', 100);
            $table->string('article', 100);
            $table->string('price', 100);
            $table->string('list', 20);
            $table->string('total_aval', 100);
            $table->string('total', 100);
            $table->string('iva', 100);
            $table->string('subtotal', 100);
            $table->string('initial_fee', 100);
            $table->string('term', 50);
            $table->string('value_fee', 100);
            $table->integer('plan_id');
            $table->integer('type_quotation');
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
        Schema::dropIfExists('assesor_quotation_values');
    }
}
