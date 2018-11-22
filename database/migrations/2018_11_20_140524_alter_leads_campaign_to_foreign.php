<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterLeadsCampaignToForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leads',function(Blueprint $table){
            $table->integer('campaign')->nullable()->unsigned();
            $table->foreign('campaign')->references('id')->on('campaigns');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leads',function(Blueprint $table){
            $table->dropForeign(['campaign']);
            $table->dropColumn('campaign');     
        });
        
    }
}
