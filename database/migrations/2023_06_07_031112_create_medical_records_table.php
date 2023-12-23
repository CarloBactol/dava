<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_records', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('vet_id');
            $table->unsignedInteger('animal_id');
            $table->string('procedure');
            $table->string('type_of_procedure');
            $table->string('cost');
            $table->string('status')->default(1);
            $table->longText('notes')->nullable();
            $table->timestamps();
            $table->foreign('vet_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('animal_id')->references('id')->on('animals')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_records');
    }
}
