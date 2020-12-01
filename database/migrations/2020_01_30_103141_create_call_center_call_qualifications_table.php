<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallCenterCallQualificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_center_call_qualifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('qualification',100);
            $table->tinyInteger('status')->default(0)->comment("0= Inactivo, 1= Activo");
            $table->tinyInteger('type')->default(0)->comment("0=Todas, 1=Cobranzas, 2=Comercial, 3=Fabrica");
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
        Schema::dropIfExists('call_center_call_qualifications');
    }
}
