<table border="1">
    <tr>
        <td colspan="6" style="font-weight: bold; font-size: 14px; text-align: center;">{{ $namaSekolah }}</td>
    </tr>
    <tr>
        <td colspan="6" style="font-weight: bold; text-align: center;">LAPORAN PEMINJAMAN ALAT</td>
    </tr>
    <tr>
        <td colspan="6" style="text-align: center;">Periode: {{ $keteranganPeriode }}</td>
    </tr>
    <tr><td colspan="6"></td></tr>
    
    <thead>
        <tr style="background-color: #d9d9d9; font-weight: bold; text-align: center;">
            <th>No</th>
            <th>Kode Pinjam</th>
            <th>Tanggal Pinjam</th>
            <th>Peminjam</th>
            <th>Alat yang Dipinjam</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($daftarPeminjaman as $index => $item)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td>{{ $item->kode_peminjaman ?? '-' }}</td>
                <td style="text-align: center;">{{ $item->tgl_pinjam }}</td>
                <td>{{ $item->peminjam->nama ?? '-' }}</td>
                <td>
                    @foreach($item->detail as $detail)
                        - {{ $detail->alat->nama_alat ?? '-' }} (Qty: {{ $detail->jumlah }})<br>
                    @endforeach
                </td>
                <td style="text-align: center;">
                    @php
                        $statusVal = $item->status;
                        if ($statusVal instanceof \App\Enums\StatusPeminjaman) {
                            $statusText = method_exists($statusVal, 'label') ? $statusVal->label() : $statusVal->value;
                        } else {
                            $statusText = ucfirst((string) $statusVal);
                        }
                    @endphp
                    {{ $statusText }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>