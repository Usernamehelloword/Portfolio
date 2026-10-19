@props([
    'name',
    'label',
    'checked' => false,
])

<label class="toggle">
    <input type="checkbox" name="{{ $name }}" value="1" @checked(old($name, $checked))>
    <span>{{ $label }}</span>
</label>
