@extends('admin.layouts.app')

@section('title', 'New Service')

@section('content')
    <form method="POST" action="{{ route('admin.services.store') }}">
        @csrf

        <div class="panel">
            <div class="panel__head">
                <h2 class="panel__title">Add a service</h2>
            </div>

            <div class="form-grid">
                <x-admin::field name="title" label="Title" required :value="old('title', $service->title ?? '')" placeholder="Web Development" />
                <x-admin::select name="icon" label="Icon" required :options="array_combine($icons, array_map('ucfirst', $icons))" :selected="old('icon', $service->icon ?? 'code')" />
            </div>
            <div class="form-grid form-grid--stack">
                <x-admin::textarea name="description" label="Description" required :rows="3" :value="old('description', $service->description ?? '')" />
            </div>
            <div class="form-grid">
                <x-admin::field name="sort_order" label="Sort order" type="number" :min="0" :value="old('sort_order', 0)" />
            </div>

            <x-admin::actions :cancel="route('admin.services.index')" label="Add service" />
        </div>
    </form>
@endsection
