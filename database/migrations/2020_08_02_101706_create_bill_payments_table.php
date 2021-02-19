<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('payment_deadline');
            $table->string('status')->default('0');
            $table->string('subsidiary_id');
            $table->integer('type_of_invoice');
            $table->string('type_of_service');
            $table->string('payment_reference');
            $table->integer('user_id');
            $table->timestamp('date_of_notification')->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('bill_payments');
    }
}
