<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PeranIzinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $daftarIzin = [
            // izin milik admin
            'user.kelola',
            'alat.kelola',
            'kategori.kelola',
            'peminjaman.kelola',
            'pengembalian.kelola',
            'log.lihat',
            'pengaturan.kelola',

            // izin milik petugas
            'peminjaman.setujui',
            'pengembalian.pantau',
            'laporan.cetak',

            // izin milik peminjam
            'alat.lihat',
            'peminjaman.ajukan',
            'peminjaman.kembalikan',
        ];

        foreach ($daftarIzin as $namaIzin) {
            Permission::firstOrCreate([
                'name'          => $namaIzin,
                'guard_name'    => 'web',
            ]);
        }

        $peranAdmin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $peranPetugas = Role::firstOrCreate(['name' => 'petugas', 'guard_name' => 'web']);
        $peranPeminjam = Role::firstOrCreate(['name' => 'peminjam', 'guard_name' => 'web']);

        $peranAdmin->syncPermissions([
            'user.kelola',
            'alat.kelola',
            'kategori.kelola',
            'peminjaman.kelola',
            'pengembalian.kelola',
            'log.lihat',
            'pengaturan.kelola',
        ]);

        $peranPetugas->syncPermissions([
            'peminjaman.setujui',
            'pengembalian.pantau',
            'laporan.cetak',
        ]);

        $peranPeminjam->syncPermissions([
            'alat.lihat',
            'peminjaman.ajukan',
            'peminjaman.kembalikan',
        ]);
    }
}
