@extends('admin.layouts.app')

@section('title', 'Edit Stat')

@section('content')
    <form method="POST" action="{{ route('admin.stats.update', $stat) }}">
        @csrf
        @method('PUT')

        <div class="panel">
            <div class="panel__head">
                <h2 class="panel__title">Edit stat</h2>
            </div>

            <div class="form-grid">
                <x-admin::field name="value" label="Value" type="number" required :min="0" :max="999999" :value="$stat->value" />
                <x-admin::field name="suffix" label="Suffix" :value="$stat->suffix" placeholder="+ / % / K" />
            </div>
            <div class="form-grid">
                <x-admin::field name="label" label="Label" required :value="$stat->label" />
                <x-admin::field name="sort_order" label="Sort order" type="number" :min="0" :value="$stat->sort_order" />
            </div>

            <x-admin::actions :cancel="route('admin.stats.index')" />
        </div>
    </form>
@endsection
