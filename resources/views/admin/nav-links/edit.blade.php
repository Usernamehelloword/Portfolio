@extends('admin.layouts.app')

@section('title', 'Edit Nav Link')

@section('content')
    <form method="POST" action="{{ route('admin.nav-links.update', $link) }}">
        @csrf
        @method('PUT')

        <div class="panel">
            <div class="panel__head">
                <h2 class="panel__title">Edit navbar link</h2>
            </div>

            <div class="form-grid">
                <x-admin::field name="label" label="Label" required :value="$link->label" />
                <x-admin::field name="href" label="Target" required :value="$link->href" />
            </div>
            <div class="form-grid">
                <x-admin::field name="sort_order" label="Sort order" type="number" :min="0" :value="$link->sort_order" />
            </div>

            <x-admin::actions :cancel="route('admin.nav-links.index')" />
        </div>
    </form>
@endsection
