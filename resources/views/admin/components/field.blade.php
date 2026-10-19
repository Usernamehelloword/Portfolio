@props([
    'name',
    'label',
    'type' => 'text',
    'value' => null,
    'placeholder' => null,
    'required' => false,
    'hint' => null,
    'min' => null,
    'max' => null,
    'step' => null,
])

<div class="field {{ $errors->has($name) ? 'has-error' : '' }}">
    <label for="{{ $name }}">{{ $label }}@if($required) <span class="field-req" title="Required">*</span>@endif</label>
    <input
        type="{{ $type }}"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        @if($placeholder) placeholder="{{ $placeholder }}" @endif
        @if($required) required @endif
        @if(! is_null($min)) min="{{ $min }}" @endif
        @if(! is_null($max)) max="{{ $max }}" @endif
        @if(! is_null($step)) step="{{ $step }}" @endif
    >
    @if($hint)<p class="field-hint">{{ $hint }}</p>@endif
    @error($name)<p class="field-error">{{ $message }}</p>@enderror
</div>
