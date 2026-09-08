<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS trg_ulasan_before_insert');

        DB::unprepared("
            CREATE TRIGGER trg_ulasan_before_insert
            BEFORE INSERT ON ulasan_alat
            FOR EACH ROW
            BEGIN
                DECLARE v_status VARCHAR(20);

                SELECT p.status INTO v_status
                FROM detail_peminjaman d
                JOIN peminjaman p ON p.id = d.peminjaman_id
                WHERE d.id = NEW.detail_peminjaman_id;

                IF v_status IS NULL OR v_status <> 'selesai' THEN
                    SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'Ulasan hanya dapat diberikan untuk peminjaman yang sudah selesai';
                END IF;
            END
        ");
    }

    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS trg_ulasan_before_insert');
    }
};