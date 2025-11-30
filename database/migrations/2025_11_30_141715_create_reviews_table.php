<?php
// database/migrations/xxxx_xx_xx_create_reviews_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengajuan_id');
            $table->unsignedBigInteger('reviewer_id');
            $table->unsignedBigInteger('reviewed_id');
            $table->enum('reviewer_role', ['penerima', 'donatur']);
            $table->enum('reviewed_role', ['penerima', 'donatur']);
            $table->tinyInteger('rating')->unsigned()->between(1, 5);
            $table->text('comment')->nullable();
            $table->timestamps();

            $table->foreign('pengajuan_id')->references('id')->on('pengajuans')->onDelete('cascade');
            $table->foreign('reviewer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('reviewed_id')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['pengajuan_id', 'reviewer_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
};