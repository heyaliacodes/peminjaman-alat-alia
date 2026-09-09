@props(['icon', 'label', 'value', 'variant' => 'primary'])

<div class="stat-card">
    <div class="icon-tile bg-{{ $variant }}-subtle text-{{ $variant }}">
        <i class="bi {{ $icon }}"></i>
    </div>
    <div>
        <div class="stat-card__value">{{ $value }}</div>
        <div class="stat-card__label">{{ $label }}</div>
    </div>
</div>