<table border="1">
    <tr>
        <td colspan="6" style="font-weight: bold; font-size: 14px; text-align: center;">{{ $namaSekolah }}</td>
    </tr>
    <tr>
        <td colspan="6" style="font-weight: bold; text-align: center;">LAPORAN REKAPITULASI STOK ALAT</td>
    </tr>
    <tr>
        <td colspan="6" style="text-align: center;">Keterangan: {{ $keteranganPeriode }}</td>
    </tr>
    <tr><td colspan="6"></td></tr>
    
    <thead>
        <tr style="background-color: #d9d9d9; font-weight: bold; text-align: center;">
            <th>No</th>
            <th>Kode Alat</th>
            <th>Nama Alat</th>
            <th>Kategori</th>
            <th>Total Stok</th>
            <th>Kondisi Baik / Rusak</th>
        </tr>
    </thead>
    <tbody>
        @foreach($daftarAlat as $index => $alat)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td style="text-align: center;">{{ $alat->kode_alat }}</td>
                <td>{{ $alat->nama_alat }}</td>
                <td>{{ $alat->kategori->nama ?? '-' }}</td>
                <td style="text-align: center;">{{ $alat->stok }}</td>
                <td style="text-align: center;">{{ $alat->kondisi_baik ?? '-' }} / {{ $alat->kondisi_rusak ?? '-' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>