@props(['icon', 'title', 'description', 'href', 'variant' => 'primary'])

<a href="{{ $href }}" class="shortcut-card text-decoration-none">
    <div class="icon-tile bg-{{ $variant }}-subtle text-{{ $variant }}">
        <i class="bi {{ $icon }}"></i>
    </div>
    <div class="flex-grow-1">
        <div class="shortcut-card__title">{{ $title }}</div>
        <div class="shortcut-card__desc">{{ $description }}</div>
    </div>
    <i class="bi bi-chevron-right shortcut-card__arrow"></i>
</a>