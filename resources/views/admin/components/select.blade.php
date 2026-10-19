@props([
    'name',
    'label',
    'options' => [],
    'selected' => null,
    'required' => false,
    'hint' => null,
])

<div class="field {{ $errors->has($name) ? 'has-error' : '' }}">
    <label for="{{ $name }}">{{ $label }}@if($required) <span class="field-req" title="Required">*</span>@endif</label>
    <select id="{{ $name }}" name="{{ $name }}" @if($required) required @endif>
        @foreach ($options as $optionValue => $optionLabel)
            <option value="{{ $optionValue }}" @selected((string) old($name, $selected) === (string) $optionValue)>{{ $optionLabel }}</option>
        @endforeach
    </select>
    @if($hint)<p class="field-hint">{{ $hint }}</p>@endif
    @error($name)<p class="field-error">{{ $message }}</p>@enderror
</div>
