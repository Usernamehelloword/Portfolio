@extends('admin.layouts.app')

@section('title', "New Skill · {$group->category}")

@section('content')
    <form method="POST" action="{{ route('admin.skill-groups.skills.store', $group) }}">
        @csrf

        <div class="panel">
            <div class="panel__head">
                <h2 class="panel__title">Add skill to “{{ $group->category }}”</h2>
            </div>

            <div class="form-grid">
                <x-admin::field name="name" label="Name" required :value="old('name', $skill->name ?? '')" placeholder="JavaScript" />
                <x-admin::field name="abbr" label="Abbreviation" required :value="old('abbr', $skill->abbr ?? '')" placeholder="JS" hint="1–3 letters shown in the badge." />
            </div>
            <div class="form-grid">
                <x-admin::field name="level" label="Level (%)" type="number" required :min="0" :max="100" :value="old('level', $skill->level ?? 80)" />
                <x-admin::field name="color" label="Accent color" required :value="old('color', $skill->color ?? '#8b5cf6')" placeholder="#8b5cf6" hint="Hex color used for the badge and progress bar." />
            </div>
            <div class="form-grid">
                <x-admin::field name="sort_order" label="Sort order" type="number" :min="0" :value="old('sort_order', 0)" />
            </div>

            <x-admin::actions :cancel="route('admin.skill-groups.edit', $group)" label="Add skill" />
        </div>
    </form>
@endsection
