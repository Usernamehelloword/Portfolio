@props([
    'cancel' => null,
    'label' => 'Save changes',
])

<div class="form-actions">
    <button type="submit" class="btn btn--primary">{{ $label }}</button>
    @if ($cancel)
        <a href="{{ $cancel }}" class="btn btn--ghost">Cancel</a>
    @endif
</div>
