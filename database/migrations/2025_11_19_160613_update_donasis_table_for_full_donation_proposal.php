<?php

use Illuminate\Support\Facades\DB;
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
        Schema::table('donasis', function (Blueprint $table) {
            // Pastikan kolom berikut ada
            if (!Schema::hasColumn('donasis', 'judul_buku')) {
                $table->string('judul_buku');
            }
            if (!Schema::hasColumn('donasis', 'kategori')) {
                $table->string('kategori');
            }
            if (!Schema::hasColumn('donasis', 'kondisi')) {
                $table->string('kondisi');
            }
            if (!Schema::hasColumn('donasis', 'jumlah')) {
                $table->integer('jumlah')->default(1);
            }
            if (!Schema::hasColumn('donasis', 'deskripsi')) {
                $table->text('deskripsi')->nullable();
            }
            if (!Schema::hasColumn('donasis', 'foto')) {
                $table->string('foto')->nullable();
            }

            // Perbaiki `status` menjadi enum yang benar (ganti jika perlu)
            DB::statement("ALTER TABLE donasis MODIFY COLUMN status ENUM('menunggu','diverifikasi','ditolak','terkirim') NOT NULL DEFAULT 'menunggu'");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donasis', function (Blueprint $table) {
            //
        });
    }
};
