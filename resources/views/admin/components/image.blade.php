@props([
    'name',
    'label',
    'current' => null,
    'hint' => 'JPG, PNG, WebP, GIF or SVG — max 4 MB.',
])

<div class="field {{ $errors->has($name) ? 'has-error' : '' }}">
    <label for="{{ $name }}">{{ $label }}</label>

    @if ($current)
        <div class="image-preview">
            <img src="{{ asset($current) }}" alt="Current image" width="88" height="66">
            <span class="image-preview__file">{{ $current }}</span>
        </div>
    @endif

    <input type="file" id="{{ $name }}" name="{{ $name }}" accept="image/*">

    @if($hint)<p class="field-hint">{{ $hint }}</p>@endif
    @error($name)<p class="field-error">{{ $message }}</p>@enderror
</div>
