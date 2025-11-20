<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('bukus', function (Blueprint $table) {
            // Tambah donasi_id (nullable)
            if (!Schema::hasColumn('bukus', 'donasi_id')) {
                $table->unsignedBigInteger('donasi_id')->nullable()->after('user_id');
                $table->foreign('donasi_id')->references('id')->on('donasis')->nullOnDelete();
            }

            // Perbaiki status_buku menjadi enum: tersedia, diajukan, terkirim
            DB::statement("ALTER TABLE bukus MODIFY COLUMN status_buku ENUM('tersedia','diajukan','terkirim','rusak') NOT NULL DEFAULT 'tersedia'");

            // Tambah deskripsi & foto jika belum ada
            if (!Schema::hasColumn('bukus', 'deskripsi')) {
                $table->text('deskripsi')->nullable();
            }
            if (!Schema::hasColumn('bukus', 'foto')) {
                $table->string('foto')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bukus', function (Blueprint $table) {
            //
        });
    }
};
