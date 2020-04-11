<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryKtvTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_ktv', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('time')->nullable();
            $table->string('action')->nullable();
            $table->string('status')->nullable();
            $table->integer('implementer')->nullable();
            $table->integer('dv_id')->nullable();
            $table->integer('acc_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_ktv');
    }
}
