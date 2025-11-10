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
        Schema::table('bukus', function (Blueprint $table) {
            $table->unsignedBigInteger('donasi_id')->nullable()->after('user_id');
            $table->foreign('donasi_id')->references('id')->on('donasis')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('bukus', function (Blueprint $table) {
            $table->dropForeign(['donasi_id']);
            $table->dropColumn('donasi_id');
        });
    }
};
