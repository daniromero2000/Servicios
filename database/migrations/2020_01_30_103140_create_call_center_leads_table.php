<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallCenterLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('call_center_leads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identity_number',13);
            $table->string('name');
            $table->string('last_name');
            $table->string('email');
            $table->string('address');
            $table->string('city');
            $table->string('phone');
            $table->string('status');
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
        Schema::dropIfExists('call_center_leads');
    }
}
