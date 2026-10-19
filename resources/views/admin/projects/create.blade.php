@extends('admin.layouts.app')

@section('title', 'New Project')

@section('content')
    <form method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="panel">
            <div class="panel__head">
                <h2 class="panel__title">Add a project</h2>
            </div>

            <div class="form-grid form-grid--stack">
                <x-admin::field name="name" label="Project name" required :value="old('name', $project->name ?? '')" placeholder="ShopLayo" />
                <x-admin::textarea name="description" label="Description" required :rows="3" :value="old('description', $project->description ?? '')" hint="A short summary shown on the project card." />
                <x-admin::field name="technologies" label="Technologies" :value="old('technologies', $project->technologies ?? '')" placeholder="React, Node.js, MySQL" hint="Comma separated — each becomes a tag." />
            </div>
            <div class="form-grid">
                <x-admin::field name="github" label="GitHub URL" :value="old('github', $project->github ?? '')" placeholder="https://github.com/you/project" />
                <x-admin::field name="demo" label="Live demo URL" :value="old('demo', $project->demo ?? '')" placeholder="https://demo.example.com" />
            </div>
            <div class="form-grid">
                <x-admin::image name="image" label="Project image" />
                <x-admin::field name="sort_order" label="Sort order" type="number" :min="0" :value="old('sort_order', 0)" />
            </div>

            <x-admin::actions :cancel="route('admin.projects.index')" label="Add project" />
        </div>
    </form>
@endsection
