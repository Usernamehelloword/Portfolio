@extends('admin.layouts.app')

@section('title', 'Profile')

@section('content')
    <form method="POST" action="{{ route('admin.profile.update') }}">
        @csrf
        @method('PUT')

        <div class="panel">
            <div class="panel__head">
                <h2 class="panel__title">Profile</h2>
                <p class="panel__hint">Update your admin name, email and password.</p>
            </div>

            <div class="form-grid">
                <x-admin::field name="name" label="Name" required :value="$user->name" />
                <x-admin::field name="email" label="Email" type="email" required :value="$user->email" />
            </div>

            <div class="panel__head">
                <h2 class="panel__title panel__title--sub">Change password</h2>
                <p class="panel__hint">Leave these blank to keep your current password.</p>
            </div>

            <div class="form-grid">
                <x-admin::field name="current_password" label="Current password" type="password" autocomplete="current-password" hint="Required only when setting a new password." />
                <x-admin::field name="new_password" label="New password" type="password" autocomplete="new-password" hint="Minimum 8 characters." />
            </div>
            <div class="form-grid">
                <x-admin::field name="new_password_confirmation" label="Confirm new password" type="password" autocomplete="new-password" />
            </div>

            <x-admin::actions label="Save profile" />
        </div>
    </form>
@endsection
