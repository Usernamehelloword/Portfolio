@extends('admin.layouts.app')

@section('title', 'New Social Link')

@section('content')
    <form method="POST" action="{{ route('admin.socials.store') }}">
        @csrf

        <div class="panel">
            <div class="panel__head">
                <h2 class="panel__title">Add a social link</h2>
            </div>

            <div class="form-grid">
                <x-admin::field name="label" label="Label" required :value="old('label', $social->label ?? '')" placeholder="GitHub" />
                <x-admin::select name="icon" label="Icon" required :options="array_combine($icons, array_map('ucfirst', $icons))" :selected="old('icon', $social->icon ?? 'github')" />
            </div>
            <div class="form-grid">
                <x-admin::field name="href" label="URL" required :value="old('href', $social->href ?? '')" placeholder="https://github.com/yourname" />
                <x-admin::field name="sort_order" label="Sort order" type="number" :min="0" :value="old('sort_order', 0)" />
            </div>

            <x-admin::actions :cancel="route('admin.socials.index')" label="Add link" />
        </div>
    </form>
@endsection
