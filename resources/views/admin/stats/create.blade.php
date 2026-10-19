@extends('admin.layouts.app')

@section('title', 'New Stat')

@section('content')
    <form method="POST" action="{{ route('admin.stats.store') }}">
        @csrf

        <div class="panel">
            <div class="panel__head">
                <h2 class="panel__title">Add a stat</h2>
                <p class="panel__hint">Shown in the About section, e.g. value "3" suffix "+" label "Years Experience".</p>
            </div>

            <div class="form-grid">
                <x-admin::field name="value" label="Value" type="number" required :min="0" :max="999999" :value="old('value', $stat->value ?? '')" />
                <x-admin::field name="suffix" label="Suffix" :value="old('suffix', $stat->suffix ?? '')" placeholder="+ / % / K" hint="Text shown right after the number." />
            </div>
            <div class="form-grid">
                <x-admin::field name="label" label="Label" required :value="old('label', $stat->label ?? '')" placeholder="Years Experience" />
                <x-admin::field name="sort_order" label="Sort order" type="number" :min="0" :value="old('sort_order', 0)" hint="Lower numbers show first." />
            </div>

            <x-admin::actions :cancel="route('admin.stats.index')" label="Add stat" />
        </div>
    </form>
@endsection
