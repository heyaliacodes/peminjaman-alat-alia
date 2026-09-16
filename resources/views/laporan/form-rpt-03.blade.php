<div class="card h-100">
    <div class="card-header">RPT-03 · Rekapitulasi Stok Alat</div>
    <div class="card-body">
        <form method="GET" action="{{ route('laporan.stok') }}" target="_blank" id="form-stok">
            <div class="mb-3">
                <label class="form-label small">Kategori</label>
                <select name="kategori_id" class="form-select form-select-sm">
                    <option value="">Semua Kategori</option>
                    @foreach ($daftarKategori as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary w-50">Cetak PDF</button>
                <button type="button" onclick="exportExcelStok()" class="btn btn-success w-50">Export Excel</button>
            </div>
        </form>
    </div>
</div>

<script>
function exportExcelStok() {
    const form = document.getElementById('form-stok');
    const originalAction = form.action;
    const originalTarget = form.target;

    form.action = "{{ route('laporan.stok.excel') }}";
    form.target = "_self";
    
    form.submit();

    form.action = originalAction;
    form.target = originalTarget;
}
</script>