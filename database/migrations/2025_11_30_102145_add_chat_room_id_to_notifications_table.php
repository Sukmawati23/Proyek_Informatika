<?php

// database/migrations/xxxx_add_chat_room_id_to_notifications_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->unsignedBigInteger('chat_room_id')->nullable()->after('pesan');
            $table->foreign('chat_room_id')->references('id')->on('chat_rooms')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropForeign(['chat_room_id']);
            $table->dropColumn('chat_room_id');
        });
    }
};