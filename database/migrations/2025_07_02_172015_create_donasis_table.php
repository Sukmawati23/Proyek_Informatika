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
        Schema::create('donasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // FK ke users
            $table->string('judul_buku');
            $table->string('kategori');
            $table->string('kondisi');
            $table->string('penulis')->nullable();
            $table->string('penerbit')->nullable();
            $table->string('foto')->nullable();
            $table->date('tanggal')->nullable();
            $table->enum('status', ['menunggu', 'diterima', 'diproses', 'ditolak'])->default('menunggu');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donasis');
    }
};
