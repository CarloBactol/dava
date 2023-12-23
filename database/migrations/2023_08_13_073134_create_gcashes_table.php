<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGcashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gcashes', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('amount')->nullable();
            $table->string('phone_no');
            $table->string('reference_no');
            $table->string('status')->defaultValue('0');
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
        Schema::dropIfExists('gcashes');
    }
}
