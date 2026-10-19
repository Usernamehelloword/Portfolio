@extends('admin.layouts.app')

@section('title', "Edit: {$service->title}")

@section('content')
    <form method="POST" action="{{ route('admin.services.update', $service) }}">
        @csrf
        @method('PUT')

        <div class="panel">
            <div class="panel__head">
                <h2 class="panel__title">Edit service</h2>
            </div>

            <div class="form-grid">
                <x-admin::field name="title" label="Title" required :value="$service->title" />
                <x-admin::select name="icon" label="Icon" required :options="array_combine($icons, array_map('ucfirst', $icons))" :selected="$service->icon" />
            </div>
            <div class="form-grid form-grid--stack">
                <x-admin::textarea name="description" label="Description" required :rows="3" :value="$service->description" />
            </div>
            <div class="form-grid">
                <x-admin::field name="sort_order" label="Sort order" type="number" :min="0" :value="$service->sort_order" />
            </div>

            <x-admin::actions :cancel="route('admin.services.index')" />
        </div>
    </form>
@endsection
