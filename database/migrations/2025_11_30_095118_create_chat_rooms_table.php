<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chat_rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('donatur_id');
            $table->unsignedBigInteger('penerima_id');
            $table->unsignedBigInteger('donasi_id');
            $table->timestamps();

            $table->foreign('donatur_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('penerima_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('donasi_id')->references('id')->on('donasis')->onDelete('cascade');
            $table->unique(['donatur_id', 'penerima_id', 'donasi_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chat_rooms');
    }
};