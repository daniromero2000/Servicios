<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallCenterManagementPaymentCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_center_management_payment_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->text('comment');
            $table->unsignedInteger('call_center_management_payment_id');
            $table->foreign('call_center_management_payment_id', 'fk_management_management_payment_comments')->references('id')->on('call_center_management_payments');
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
        Schema::dropIfExists('call_center_management_payment_comments');
    }
}
