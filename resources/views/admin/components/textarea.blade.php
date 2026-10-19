@props([
    'name',
    'label',
    'value' => null,
    'rows' => 4,
    'placeholder' => null,
    'required' => false,
    'hint' => null,
])

<div class="field {{ $errors->has($name) ? 'has-error' : '' }}">
    <label for="{{ $name }}">{{ $label }}@if($required) <span class="field-req" title="Required">*</span>@endif</label>
    <textarea
        id="{{ $name }}"
        name="{{ $name }}"
        rows="{{ $rows }}"
        @if($placeholder) placeholder="{{ $placeholder }}" @endif
        @if($required) required @endif
    >{{ old($name, $value) }}</textarea>
    @if($hint)<p class="field-hint">{{ $hint }}</p>@endif
    @error($name)<p class="field-error">{{ $message }}</p>@enderror
</div>
