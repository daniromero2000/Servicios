<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallCenterProductInterestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_center_product_interests', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_line_id');
            $table->foreign('product_line_id', 'fk_product_line_product_interest')->references('id')->on('product_lines');
            $table->unsignedInteger('call_center_management_id');
            $table->foreign('call_center_management_id', 'fk_management_product_interest')->references('id')->on('call_center_managements');
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
        Schema::dropIfExists('call_center_product_interests');
    }
}
