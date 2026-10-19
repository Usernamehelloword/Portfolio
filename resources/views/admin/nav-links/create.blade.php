@extends('admin.layouts.app')

@section('title', 'New Nav Link')

@section('content')
    <form method="POST" action="{{ route('admin.nav-links.store') }}">
        @csrf

        <div class="panel">
            <div class="panel__head">
                <h2 class="panel__title">Add a navbar link</h2>
                <p class="panel__hint">Target is usually an anchor like #about or a full URL.</p>
            </div>

            <div class="form-grid">
                <x-admin::field name="label" label="Label" required :value="old('label', $link->label ?? '')" placeholder="About" />
                <x-admin::field name="href" label="Target" required :value="old('href', $link->href ?? '')" placeholder="#about" />
            </div>
            <div class="form-grid">
                <x-admin::field name="sort_order" label="Sort order" type="number" :min="0" :value="old('sort_order', 0)" />
            </div>

            <x-admin::actions :cancel="route('admin.nav-links.index')" label="Add link" />
        </div>
    </form>
@endsection
