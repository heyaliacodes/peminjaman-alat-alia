<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card text-center h-100">
            <div class="card-body">
                <div class="display-6">{{ $statistik['total_pinjam'] }}</div>
                <div class="text-muted small">Kali Meminjam</div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-center h-100">
            <div class="card-body">
                <div class="display-6">
                    @if ($statistik['persen_tepat_waktu'] !== null)
                        {{ $statistik['persen_tepat_waktu'] }}%
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </div>
                <div class="text-muted small">Tepat Waktu</div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-center h-100">
            <div class="card-body">
                <div class="display-6">
                    Rp {{ number_format($statistik['total_denda'], 0, ',', '.') }}
                </div>
                <div class="text-muted small">Total Denda</div>
            </div>
        </div>
    </div>
</div>