<div class="card h-100">
    <div class="card-header">RPT-02 · Laporan Pengembalian &amp; Denda</div>
    <div class="card-body">
        <form method="GET" action="{{ route('laporan.pengembalian') }}" target="_blank" id="form-pengembalian">
            <div class="mb-2">
                <label class="form-label small">Tanggal Awal</label>
                <input type="date" name="tgl_awal" class="form-control form-control-sm"
                value="{{ now()->startOfMonth()->toDateString() }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label small">Tanggal Akhir</label>
                <input type="date" name="tgl_akhir" class="form-control form-control-sm"
                    value="{{ now()->toDateString() }}" required>
            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary w-50">Cetak PDF</button>
                <button type="button" onclick="exportExcelPengembalian()" class="btn btn-success w-50">Export Excel</button>
            </div>
        </form>
    </div>
</div>

<script>
function exportExcelPengembalian() {
    const form = document.getElementById('form-pengembalian');
    const originalAction = form.action;
    const originalTarget = form.target;

    // Ubah action ke route excel pengembalian
    form.action = "{{ route('laporan.pengembalian.excel') }}";
    form.target = "_self"; // Download langsung di tab yang sama
    
    form.submit();

    // Kembalikan action dan target form ke awal agar tombol PDF tetap berfungsi normal
    form.action = originalAction;
    form.target = originalTarget;
}
</script>