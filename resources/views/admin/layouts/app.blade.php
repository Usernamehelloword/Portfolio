<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'Dashboard') · Kimlay Admin</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Sora:wght@600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
</head>
<body class="admin-body">
<div class="admin-shell" data-admin-shell>

    <aside class="admin-sidebar" id="adminSidebar">
        <div class="admin-brand">
            <span class="admin-brand__logo">KIMLAY.</span>
            <span class="admin-brand__tag">Admin Panel</span>
        </div>

        <nav class="admin-nav">
            <span class="admin-nav__label">Overview</span>
            <x-admin::nav-item :href="route('admin.dashboard')" pattern="admin.dashboard">Dashboard</x-admin::nav-item>
            <x-admin::nav-item :href="route('admin.messages.index')" pattern="admin.messages.*">
                Inbox
                @php($unread = \App\Models\ContactMessage::where('is_read', false)->count())
                @if ($unread)
                    <span class="admin-badge">{{ $unread }}</span>
                @endif
            </x-admin::nav-item>

            <span class="admin-nav__label">Website content</span>
            <x-admin::nav-item :href="route('admin.settings.edit')" pattern="admin.settings.*">Site Settings</x-admin::nav-item>
            <x-admin::nav-item :href="route('admin.projects.index')" pattern="admin.projects.*">Projects</x-admin::nav-item>
            <x-admin::nav-item :href="route('admin.skill-groups.index')" pattern="admin.skill-groups.*|admin.skills.*">Skills</x-admin::nav-item>
            <x-admin::nav-item :href="route('admin.experiences.index')" pattern="admin.experiences.*">Experience</x-admin::nav-item>
            <x-admin::nav-item :href="route('admin.services.index')" pattern="admin.services.*">Services</x-admin::nav-item>
            <x-admin::nav-item :href="route('admin.stats.index')" pattern="admin.stats.*">About Stats</x-admin::nav-item>
            <x-admin::nav-item :href="route('admin.nav-links.index')" pattern="admin.nav-links.*">Nav Links</x-admin::nav-item>
            <x-admin::nav-item :href="route('admin.socials.index')" pattern="admin.socials.*">Social Links</x-admin::nav-item>

            <span class="admin-nav__label">Account</span>
            <x-admin::nav-item :href="route('admin.profile.edit')" pattern="admin.profile.*">Profile</x-admin::nav-item>
            <a href="{{ route('home') }}" target="_blank" rel="noopener" class="admin-nav__link">View Website ↗</a>
        </nav>

        <div class="admin-sidebar__footer">
            <span class="admin-sidebar__user">{{ auth()->user()->email }}</span>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="btn btn--ghost btn--sm btn--block">Log out</button>
            </form>
        </div>
    </aside>

    <div class="admin-main">
        <header class="admin-topbar">
            <button class="admin-burger" id="adminBurger" type="button" aria-label="Toggle menu" aria-expanded="false">
                <span></span><span></span><span></span>
            </button>
            <h1 class="admin-topbar__title">@yield('title', 'Dashboard')</h1>
            <a class="admin-topbar__site" href="{{ route('home') }}" target="_blank" rel="noopener">View site ↗</a>
        </header>

        <main class="admin-content">
            @if (session('status'))
                <div class="alert alert--success" data-autohide>{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert--error">
                    Please fix the {{ \Illuminate\Support\Str::plural('error', $errors->count()) }} highlighted below.
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
