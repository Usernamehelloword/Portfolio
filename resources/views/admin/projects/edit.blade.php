@extends('admin.layouts.app')

@section('title', "Edit: {$project->name}")

@section('content')
    <form method="POST" action="{{ route('admin.projects.update', $project) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="panel">
            <div class="panel__head">
                <h2 class="panel__title">Edit project</h2>
            </div>

            <div class="form-grid form-grid--stack">
                <x-admin::field name="name" label="Project name" required :value="$project->name" />
                <x-admin::textarea name="description" label="Description" required :rows="3" :value="$project->description" />
                <x-admin::field name="technologies" label="Technologies" :value="$project->technologies" hint="Comma separated — each becomes a tag." />
            </div>
            <div class="form-grid">
                <x-admin::field name="github" label="GitHub URL" :value="$project->github" />
                <x-admin::field name="demo" label="Live demo URL" :value="$project->demo" />
            </div>
            <div class="form-grid">
                <x-admin::image name="image" label="Replace image" :current="$project->image" />
                <x-admin::field name="sort_order" label="Sort order" type="number" :min="0" :value="$project->sort_order" />
            </div>

            <x-admin::actions :cancel="route('admin.projects.index')" />
        </div>
    </form>
@endsection
