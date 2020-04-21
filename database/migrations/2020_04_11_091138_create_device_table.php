<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeviceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('dv_name')->nullable();
            $table->string('dv_model')->nullable();
            $table->string('dv_serial')->nullable();
            $table->string('country')->nullable();
            $table->string('manufacturer')->nullable();
            $table->string('license_number')->nullable();
            $table->string('license_number_date')->nullable();
            $table->string('note')->nullable();
            $table->string('import_id')->nullable();
            $table->integer('dv_type_id')->nullable();
            $table->integer('provider_id')->nullable();
            $table->integer('department_id')->nullable();
            $table->integer('status')->nullable();
            $table->integer('price')->nullable();
            $table->date('produce_date')->nullable();
            $table->date('import_date')->nullable();
            $table->date('handover_date')->nullable();
            $table->date('expire_date')->nullable();
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
        Schema::dropIfExists('device');
    }
}
