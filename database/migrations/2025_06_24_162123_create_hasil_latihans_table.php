<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hasil_latihans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schedule_id')->constrained()->onDelete('cascade');
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin');
            $table->float('berat');
            $table->float('tinggi');
            $table->float('otot_kanan');
            $table->float('otot_kiri');
            $table->integer('repitisi');
            $table->string('waktu_firebase');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_latihans');
    }
};
