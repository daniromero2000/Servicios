<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallCenterPaymentPromisesCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_center_payment_promises_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('call_center_payment_promise_id');
            $table->foreign('call_center_payment_promise_id', 'fk_payment_comment')->references('id')->on('call_center_payment_promises');
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
        Schema::dropIfExists('call_center_payment_promises_comments');
    }
}
