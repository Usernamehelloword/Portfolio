@extends('admin.layouts.app')

@section('title', 'New Skill Group')

@section('content')
    <form method="POST" action="{{ route('admin.skill-groups.store') }}">
        @csrf

        <div class="panel">
            <div class="panel__head">
                <h2 class="panel__title">Add a skill group</h2>
                <p class="panel__hint">After creating the group you can add skills to it.</p>
            </div>

            <div class="form-grid">
                <x-admin::field name="category" label="Category name" required :value="old('category', $group->category ?? '')" placeholder="Frontend" />
                <x-admin::select name="icon" label="Icon" required :options="array_combine($icons, array_map('ucfirst', $icons))" :selected="old('icon', $group->icon ?? 'layout')" />
            </div>
            <div class="form-grid">
                <x-admin::field name="blurb" label="Short description" :value="old('blurb', $group->blurb ?? '')" placeholder="Responsive, accessible interfaces." />
                <x-admin::field name="sort_order" label="Sort order" type="number" :min="0" :value="old('sort_order', 0)" />
            </div>

            <x-admin::actions :cancel="route('admin.skill-groups.index')" label="Add group" />
        </div>
    </form>
@endsection
