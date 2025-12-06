<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('file_name');      // Nama file laporan (misal: Laporan_donasi_2025-12-01.pdf)
            $table->enum('type', ['donatur', 'penerima', 'donasi', 'verifikasi', 'ulasan']);
            $table->enum('format', ['pdf', 'excel']);
            $table->timestamp('date')->useCurrent(); // Tanggal generate
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reports');
    }
};
