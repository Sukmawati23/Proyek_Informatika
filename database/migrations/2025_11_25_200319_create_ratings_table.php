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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donatur_id')->constrained('users'); // Donatur yang diberi rating
            $table->foreignId('penerima_id')->constrained('users'); // Penerima yang memberi rating
            $table->string('donation_id')->nullable(); // ID Donasi (jika ada)
            $table->integer('rating_value')->unsigned(); // Nilai rating (1-5)
            $table->text('review_text')->nullable(); // Ulasan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};