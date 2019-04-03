<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeSizeAnswerToFqasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fqas', function (Blueprint $table) {
            $table->string('question', 400)->change();
            $table->string('answer', 800)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fqas', function (Blueprint $table) {
            $table->dropColumn('question');
            $table->dropColumn('answer');
        });
    }
}
