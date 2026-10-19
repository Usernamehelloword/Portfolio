@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="stat-cards">
        <div class="stat-card">
            <span class="stat-card__value">{{ $projectCount }}</span>
            <span class="stat-card__label">Projects</span>
            <a class="stat-card__link" href="{{ route('admin.projects.index') }}">Manage →</a>
        </div>
        <div class="stat-card">
            <span class="stat-card__value">{{ $skillCount }}</span>
            <span class="stat-card__label">Skills</span>
            <a class="stat-card__link" href="{{ route('admin.skill-groups.index') }}">Manage →</a>
        </div>
        <div class="stat-card">
            <span class="stat-card__value">{{ $serviceCount }}</span>
            <span class="stat-card__label">Services</span>
            <a class="stat-card__link" href="{{ route('admin.services.index') }}">Manage →</a>
        </div>
        <div class="stat-card {{ $unreadCount > 0 ? 'stat-card--accent' : '' }}">
            <span class="stat-card__value">{{ $unreadCount }}</span>
            <span class="stat-card__label">Unread messages</span>
            <a class="stat-card__link" href="{{ route('admin.messages.index') }}">Open inbox →</a>
        </div>
    </div>

    <div class="panel">
        <div class="panel__head">
            <h2 class="panel__title">Quick actions</h2>
        </div>
        <div class="quick-actions">
            <a class="btn btn--ghost" href="{{ route('admin.settings.edit') }}">Edit site text & images</a>
            <a class="btn btn--ghost" href="{{ route('admin.projects.create') }}">Add a project</a>
            <a class="btn btn--ghost" href="{{ route('admin.experiences.create') }}">Add experience</a>
            <a class="btn btn--ghost" href="{{ route('admin.services.create') }}">Add a service</a>
        </div>
    </div>

    <div class="panel">
        <div class="panel__head">
            <h2 class="panel__title">Latest messages</h2>
            <a class="btn btn--ghost btn--sm" href="{{ route('admin.messages.index') }}">View all</a>
        </div>

        @if ($recentMessages->isEmpty())
            <p class="empty-state">No messages yet — new contact form submissions will appear here.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Subject</th>
                        <th>Received</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recentMessages as $msg)
                        <tr class="{{ $msg->is_read ? '' : 'row-unread' }}">
                            <td>{{ $msg->name }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($msg->subject, 40) }}</td>
                            <td>{{ $msg->created_at->diffForHumans() }}</td>
                            <td class="table__actions">
                                <a class="btn btn--ghost btn--sm" href="{{ route('admin.messages.show', $msg) }}">Open</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
