<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableCreditPolicy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('credit_policy', function (Blueprint $table) {
            $table->string('name')->nullable();
            $table->integer('scoreEnd')->nullable();
            $table->integer('salary')->nullable();
            $table->integer('salaryEnd')->nullable();
            $table->integer('age')->nullable();
            $table->integer('ageEnd')->nullable();
            $table->string('activity')->nullable();
            $table->integer('quotaApproved')->nullable();
            $table->integer('score')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('credit_policy', function (Blueprint $table) {
            //
        });
    }
}
