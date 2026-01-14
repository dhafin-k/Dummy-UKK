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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kendaraan')->references('id')->on('kendaraans')->onDelete('cascade');
            $table->dateTime('waktu_masuk');
            $table->dateTime('waktu_keluar')->nullable();
            $table->foreignId('id_tarif')->references('id')->on('tarifs')->onDelete('cascade');
            $table->integer('durasi_jam')->nullable();
            $table->decimal('biaya_total', 10, 0)->nullable();
            $table->enum('status', ['masuk', 'keluar'])->default('masuk');
            $table->foreignId('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('id_area')->references('id')->on('area_parkirs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
