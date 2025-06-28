<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengawas_id'); // foreign key ke users (pengawas)
            $table->unsignedBigInteger('atlet_id');    // foreign key ke users (atlet)
            $table->date('day');
            $table->time('time');
            $table->string('type'); // chinning atau pullup
            $table->timestamps();

            $table->foreign('pengawas_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('atlet_id')->references('id')->on('users')->onDelete('cascade');
        });

    }

    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
