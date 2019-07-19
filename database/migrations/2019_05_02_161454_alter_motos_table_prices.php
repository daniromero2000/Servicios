<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMotosTablePrices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('motos', function (Blueprint $table) {
            
            $table->integer('creditPrice')->nullable()->after('price');
            $table->integer('brandBonus')->nullable()->after('price');
            $table->integer('enrollment')->nullable()->after('price');
            $table->integer('creditEnrollment')->nullable()->after('price');
            $table->integer('soat')->nullable()->after('price');
            $table->integer('initialFee')->nullable()->after('price');
            $table->integer('aval')->nullable()->after('price');
            $table->integer('taxes')->nullable()->after('price');
            $table->integer('runt')->nullable()->after('price');
                        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
