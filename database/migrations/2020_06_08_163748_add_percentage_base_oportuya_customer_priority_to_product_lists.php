<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPercentageBaseOportuyaCustomerPriorityToProductLists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_lists', function (Blueprint $table) {
            $table->float('percentage_base_oportuya_customer', 4,2);
            $table->tinyInteger('priority');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_lists', function (Blueprint $table) {
            //
        });
    }
}
