<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssesorQuotationDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assesor_quotation_discounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('assesor_quotations_value_id');
            $table->string('value', 100);
            $table->string('type', 100);
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
        Schema::dropIfExists('assesor_quotation_discounts');
    }
}
