<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data', function (Blueprint $table) {
            $table->id();
            $table->binary('img');
            $table->string('img_type', 64);
            $table->string('name', 256);
            $table->string('price', 64);
            $table->string('desc', 8192);
            $table->timestamps();
        });
        DB::statement('ALTER TABLE data MODIFY img LONGBLOB;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data');
    }
};
