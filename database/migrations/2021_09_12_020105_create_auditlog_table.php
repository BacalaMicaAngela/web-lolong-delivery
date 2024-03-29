<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditlog', function (Blueprint $table) {
            $table->id();
            $table->string('avatar');
            $table->string('fname');
            $table->string('userType');
            $table->string('logType');
            $table->integer('user_id');
            $table->date('create_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auditlog');
    }
}
