<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {            
        Schema::table('donasis', function (Blueprint $table) {
            if (!Schema::hasColumn('donasis', 'penulis')) {
                $table->string('penulis')->nullable()->after('kondisi');
            }
            if (!Schema::hasColumn('donasis', 'penerbit')) {
                $table->string('penerbit')->nullable()->after('penulis');
            }
        });
    }

    public function down()
    {
        Schema::table('donasis', function (Blueprint $table) {
            if (Schema::hasColumn('donasis', 'penulis')) {
                $table->dropColumn('penulis');
            }
            if (Schema::hasColumn('donasis', 'penerbit')) {
                $table->dropColumn('penerbit');
            }
        });
    }
};
