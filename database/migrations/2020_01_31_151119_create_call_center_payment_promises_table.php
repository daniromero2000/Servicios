<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallCenterPaymentPromisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_center_payment_promises', function (Blueprint $table) {
            $table->increments('id');
            $table->float('payment_promise',10,2);
            $table->unsignedInteger('subsidiary_id');
            $table->foreign('subsidiary_id')->references('id')->on('subsidiaries');
            $table->unsignedInteger('call_center_management_id');
            $table->foreign('call_center_management_id', 'fk_management_payment_promise')->references('id')->on('call_center_managements');
            $table->timestamp('promise_date');
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
        Schema::dropIfExists('call_center_payment_promises');
    }
}
