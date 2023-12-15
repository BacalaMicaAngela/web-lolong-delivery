<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblSchedule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('tbl_schedule', function (Blueprint $table) {
                $table->id('schedule_id');
                $table->integer('deliver_id');
                $table->string('bussiness_name');
                $table->string('delivery_address');
                $table->string('contact_person');
                $table->string('contactno');
                $table->date('delivery_date');
                $table->string('dispatch_by');
                $table->date('dispatch_date');
                $table->string('recieve_by')->nullable();
                $table->date('recieve_date')->nullable();
                $table->integer('hasno');
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
