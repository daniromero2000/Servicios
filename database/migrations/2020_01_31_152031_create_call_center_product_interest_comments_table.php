<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallCenterProductInterestCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_center_product_interest_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('call_center_product_interest_id');
            $table->foreign('call_center_product_interest_id', 'fk_product_interest_comment')->references('id')->on('call_center_product_interests');
            $table->text('comment');          
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
        Schema::dropIfExists('call_center_product_interest_comments');
    }
}
