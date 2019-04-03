<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableCreditPolicyDropColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('credit_policy', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('score');
            $table->dropColumn('scoreEnd');
            $table->dropColumn('salary');
            $table->dropColumn('salaryEnd');
            $table->dropColumn('age');
            $table->dropColumn('ageEnd');
            $table->dropColumn('activity');
            $table->dropColumn('quotaApproved');
            $table->dropColumn('deleted_at');
            $table->string('timeLimitPublic')->nullable();
            $table->string('timeLimitAdmin')->nullable();
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
