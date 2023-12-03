<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_driver', function (Blueprint $table) {
            $table->id('driver_id');
            $table->string('driver_name');
            $table->integer('age');
            $table->string('driver_address');
            $table->string('driver_phone');
            $table->string('license_no');
            $table->integer('status');
            $table->timestamp('driver_add_date')->nullable();
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
        Schema::dropIfExists('tbl_driver');
    }
}
