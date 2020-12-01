<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallCenterCommentManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_center_comment_managements', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('call_center_management_id');
            $table->foreign('call_center_management_id', 'fk_management_comment')->references('id')->on('call_center_managements');
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
        Schema::dropIfExists('call_center_comment_managements');
    }
}
