<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallCenterScriptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_center_scripts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('script',250);
            $table->tinyInteger('type')->default(0)->comment("0=Todas, 1=Cobranzas, 2=Comercial, 3=Fabrica");
            $table->tinyInteger('status')->default(0)->comment("0= Inactivo, 1= Activo");
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
        Schema::dropIfExists('call_center_scripts');
    }
}
