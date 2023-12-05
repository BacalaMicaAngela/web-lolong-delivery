<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblDelivery extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lts1.tbl_delivery', function (Blueprint $table) {
            $table->id('deliver_id');
            $table->integer('driver_id');
            $table->integer('truck_id');
            $table->string('helper');
            $table->string('trucker_code');
            $table->integer('deliver_status')->default(0);
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
    }
}
