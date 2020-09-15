<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddApplyProtectionToProductLists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_lists', function (Blueprint $table) {
            $table->tinyInteger('apply_protection')->default(1)->comment('0: No aplica proteccion, 1: Aplica proteccion');
            $table->tinyInteger('apply_gift')->default(1)->comment('0: No aplica obsequios, 1: Aplica obsequios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_list', function (Blueprint $table) {
            //
        });
    }
}