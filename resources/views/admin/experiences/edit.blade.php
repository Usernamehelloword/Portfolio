@extends('admin.layouts.app')

@section('title', 'Edit Experience Entry')

@section('content')
    <form method="POST" action="{{ route('admin.experiences.update', $experience) }}">
        @csrf
        @method('PUT')

        <div class="panel">
            <div class="panel__head">
                <h2 class="panel__title">Edit experience entry</h2>
            </div>

            <div class="form-grid">
                <x-admin::field name="period" label="Period" required :value="$experience->period" />
                <x-admin::field name="title" label="Title" required :value="$experience->title" />
            </div>
            <div class="form-grid form-grid--stack">
                <x-admin::textarea name="description" label="Description" required :rows="3" :value="$experience->description" />
            </div>
            <div class="form-grid">
                <div class="field">
                    <label>Options</label>
                    <x-admin::toggle name="is_current" label="Mark as current position" :checked="$experience->is_current" />
                </div>
                <x-admin::field name="sort_order" label="Sort order" type="number" :min="0" :value="$experience->sort_order" />
            </div>

            <x-admin::actions :cancel="route('admin.experiences.index')" />
        </div>
    </form>
@endsection
