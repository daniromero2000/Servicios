<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCallCenterProductInterestsProductLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_center_product_interests_product_lines', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_line_id');
            $table->foreign('product_line_id', 'fk_product_line_product_interest')->references('id')->on('product_lines');
            $table->unsignedInteger('call_center_product_interest_id');
            $table->foreign('call_center_product_interest_id', 'fk_product_interest_lines')->references('id')->on('call_center_product_interests');
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
        Schema::dropIfExists('call_center_productinterests_productlines');
    }
}
