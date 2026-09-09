@props(['label', 'persen', 'variant' => 'primary', 'keterangan' => null])

<div class="progress-stat">
    <div class="d-flex justify-content-between align-items-center mb-1">
        <span class="progress-stat__label">{{ $label }}</span>
        <span class="progress-stat__value">
            {{ $persen !== null ? $persen . '%' : '-' }}
        </span>
    </div>
    <div class="progress" style="height: 10px;">
        <div class="progress-bar bg-{{ $variant }}" role="progressbar"
            style="width: {{ $persen ?? 0 }}%"
            aria-valuenow="{{ $persen ?? 0 }}" aria-valuemin="0" aria-valuemax="100">
        </div>
    </div>
    @if ($keterangan)
        <div class="progress-stat__ket">{{ $keterangan }}</div>
    @endif
</div>