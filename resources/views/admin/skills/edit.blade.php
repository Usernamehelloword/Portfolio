@extends('admin.layouts.app')

@section('title', "Edit Skill · {$skill->name}")

@section('content')
    <form method="POST" action="{{ route('admin.skill-groups.skills.update', [$group, $skill]) }}">
        @csrf
        @method('PUT')

        <div class="panel">
            <div class="panel__head">
                <h2 class="panel__title">Edit skill</h2>
            </div>

            <div class="form-grid">
                <x-admin::field name="name" label="Name" required :value="$skill->name" />
                <x-admin::field name="abbr" label="Abbreviation" required :value="$skill->abbr" hint="1–3 letters shown in the badge." />
            </div>
            <div class="form-grid">
                <x-admin::field name="level" label="Level (%)" type="number" required :min="0" :max="100" :value="$skill->level" />
                <x-admin::field name="color" label="Accent color" required :value="$skill->color" hint="Hex color used for the badge and progress bar." />
            </div>
            <div class="form-grid">
                <x-admin::field name="sort_order" label="Sort order" type="number" :min="0" :value="$skill->sort_order" />
            </div>

            <x-admin::actions :cancel="route('admin.skill-groups.edit', $group)" />
        </div>
    </form>
@endsection
