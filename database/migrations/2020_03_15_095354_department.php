<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Department extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('department', function (Blueprint $table) {
            $table->bigIncrements('department_id');
            $table->string('department_name');
            $table->string('address');
            $table->dateTime('created_at'); 
            $table->dateTime('update_at'); 
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
        //
        Schema::dropIfExists('department');
    }
}
