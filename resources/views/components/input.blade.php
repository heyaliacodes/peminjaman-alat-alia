@props(['name', 'label', 'type' => 'text', 'value' => '', 'icon' => null])

<div class="mb-3">
    <label for="{{ $name }}" class="form-label">
        {{ $label }}
        @if ($attributes->has('required'))
            <span class="text-danger">*</span>
        @endif
    </label>

    <div class="input-group input-group-icon">
        @if ($icon)
            <span class="input-group-text"><i class="bi {{ $icon }}"></i></span>
        @endif
        <input type="{{ $type }}"
            class="form-control @error($name) is-invalid @enderror"
            id="{{ $name }}"
            name="{{ $name }}"
            value="{{ old($name, $value) }}"
            {{ $attributes }}
        >
    </div>

    @error($name)
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>