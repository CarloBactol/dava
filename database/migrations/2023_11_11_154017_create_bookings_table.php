<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('branch');
            $table->string('services')->nullable();
            $table->string('date')->nullable();
            $table->string('start')->nullable();
            $table->string('end')->nullable();
            $table->string('type');
            $table->string('email');
            $table->string('address')->nullable();
            $table->longText('message')->nullable();
            $table->string('status')->nullable()->default("Pending");
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
        Schema::dropIfExists('bookings');
    }
}
