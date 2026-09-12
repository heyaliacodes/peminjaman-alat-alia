<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftaran_akun', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pendaftaran', 20)->unique();
            $table->string('nama', 100);
            $table->string('username', 50);
            $table->string('email', 100)->nullable();
            $table->string('no_telp', 20)->nullable();
            $table->string('password');
            $table->enum('status', ['menunggu', 'diterima', 'ditolak'])
                ->default('menunggu')
                ->index();
            $table->text('alasan_penolakan')->nullable();
            $table->foreignId('diproses_oleh')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->timestamp('diproses_pada')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_akun');
    }
};