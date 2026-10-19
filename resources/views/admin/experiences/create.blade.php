@extends('admin.layouts.app')

@section('title', 'New Experience Entry')

@section('content')
    <form method="POST" action="{{ route('admin.experiences.store') }}">
        @csrf

        <div class="panel">
            <div class="panel__head">
                <h2 class="panel__title">Add an experience entry</h2>
            </div>

            <div class="form-grid">
                <x-admin::field name="period" label="Period" required :value="old('period', $experience->period ?? '')" placeholder="2026 — Present" />
                <x-admin::field name="title" label="Title" required :value="old('title', $experience->title ?? '')" placeholder="Full-Stack Developer" />
            </div>
            <div class="form-grid form-grid--stack">
                <x-admin::textarea name="description" label="Description" required :rows="3" :value="old('description', $experience->description ?? '')" />
            </div>
            <div class="form-grid">
                <div class="field">
                    <label>Options</label>
                    <x-admin::toggle name="is_current" label="Mark as current position" :checked="old('is_current', $experience->is_current ?? false)" />
                </div>
                <x-admin::field name="sort_order" label="Sort order" type="number" :min="0" :value="old('sort_order', 0)" />
            </div>

            <x-admin::actions :cancel="route('admin.experiences.index')" label="Add entry" />
        </div>
    </form>
@endsection
