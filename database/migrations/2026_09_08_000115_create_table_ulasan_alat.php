<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ulasan_alat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('detail_peminjaman_id')->constrained('detail_peminjaman')->cascadeOnDelete();
            $table->foreignId('alat_id')->constrained('alat');
            $table->foreignId('user_id')->constrained('users');
            $table->unsignedTinyInteger('rating');
            $table->string('komentar', 500)->nullable();
            $table->timestamps();

            // BR-13: satu baris pinjaman hanya boleh diulas sekali.
            $table->unique('detail_peminjaman_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ulasan_alat');
    }
};