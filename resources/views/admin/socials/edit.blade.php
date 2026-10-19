@extends('admin.layouts.app')

@section('title', 'Edit Social Link')

@section('content')
    <form method="POST" action="{{ route('admin.socials.update', $social) }}">
        @csrf
        @method('PUT')

        <div class="panel">
            <div class="panel__head">
                <h2 class="panel__title">Edit social link</h2>
            </div>

            <div class="form-grid">
                <x-admin::field name="label" label="Label" required :value="$social->label" />
                <x-admin::select name="icon" label="Icon" required :options="array_combine($icons, array_map('ucfirst', $icons))" :selected="$social->icon" />
            </div>
            <div class="form-grid">
                <x-admin::field name="href" label="URL" required :value="$social->href" />
                <x-admin::field name="sort_order" label="Sort order" type="number" :min="0" :value="$social->sort_order" />
            </div>

            <x-admin::actions :cancel="route('admin.socials.index')" />
        </div>
    </form>
@endsection
