@extends('admin.layouts.app')

@section('title', 'Message')

@section('content')
    <div class="panel">
        <div class="panel__head">
            <div>
                <h2 class="panel__title">{{ $message->subject }}</h2>
                <p class="panel__hint">Received {{ $message->created_at->format('M j, Y — g:i A') }}</p>
            </div>
            @if (! $message->is_read)
                <span class="pill pill--accent">Unread</span>
            @endif
        </div>

        <div class="message-meta">
            <div class="message-meta__row">
                <span class="message-meta__label">From</span>
                <span><strong>{{ $message->name }}</strong></span>
            </div>
            <div class="message-meta__row">
                <span class="message-meta__label">Email</span>
                <span>{{ $message->email }}</span>
            </div>
        </div>

        <div class="message-body">
            {{ $message->message }}
        </div>

        <div class="form-actions">
            <a class="btn btn--primary" href="mailto:{{ $message->email }}?subject=Re: {{ rawurlencode($message->subject) }}">Reply by email</a>

            <form method="POST" action="{{ route('admin.messages.toggle', $message) }}">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn--ghost">
                    Mark as {{ $message->is_read ? 'unread' : 'read' }}
                </button>
            </form>

            <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" data-confirm="Delete this message?">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn--danger">Delete</button>
            </form>

            <a class="btn btn--ghost" href="{{ route('admin.messages.index') }}">← Back to inbox</a>
        </div>
    </div>
@endsection
