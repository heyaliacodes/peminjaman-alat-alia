<table border="1">
    <tr>
        <td colspan="7" style="font-weight: bold; font-size: 14px; text-align: center;">{{ $namaSekolah }}</td>
    </tr>
    <tr>
        <td colspan="7" style="font-weight: bold; text-align: center;">LAPORAN PENGEMBALIAN & DENDA ALAT</td>
    </tr>
    <tr>
        <td colspan="7" style="text-align: center;">Periode: {{ $keteranganPeriode }}</td>
    </tr>
    <tr><td colspan="7"></td></tr>
    
    <thead>
        <tr style="background-color: #d9d9d9; font-weight: bold; text-align: center;">
            <th>No</th>
            <th>Tanggal Kembali</th>
            <th>Peminjam</th>
            <th>Alat Dikembalikan</th>
            <th>Kondisi</th>
            <th>Denda (Rp)</th>
            <th>Petugas</th>
        </tr>
    </thead>
    <tbody>
        @foreach($daftarPengembalian as $index => $item)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td style="text-align: center;">{{ $item->tgl_kembali }}</td>
                <td>{{ $item->peminjaman->peminjam->nama ?? '-' }}</td>
                <td>
                    @foreach($item->peminjaman->detail as $detail)
                        - {{ $detail->alat->nama_alat ?? '-' }}<br>
                    @endforeach
                </td>
                <td style="text-align: center;">
                    @php
                        $kondisiVal = $item->kondisi_alat;
                        if (is_object($kondisiVal)) {
                            $kondisiText = method_exists($kondisiVal, 'label') ? $kondisiVal->label() : ($kondisiVal->value ?? (string)$kondisiVal);
                        } else {
                            $kondisiText = ucfirst((string) $kondisiVal);
                        }
                    @endphp
                    {{ $kondisiText ?: '-' }}
                </td>
                <td style="text-align: right;">{{ number_format($item->total_denda, 0, ',', '.') }}</td>
                <td>{{ $item->petugas->name ?? '-' }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="5" style="font-weight: bold; text-align: right;">Total Keseluruhan Denda:</td>
            <td style="font-weight: bold; text-align: right;">{{ number_format($totalDenda, 0, ',', '.') }}</td>
            <td></td>
        </tr>
    </tbody>
</table>