@extends('admin.layouts.app')

@section('title', 'Inbox')

@section('content')
    <div class="panel">
        <div class="panel__head">
            <h2 class="panel__title">Contact messages</h2>
        </div>

        @if ($messages->isEmpty())
            <p class="empty-state">No messages yet — new contact form submissions will appear here.</p>
        @else
            <table class="table">
                <thead>
                    <tr><th></th><th>Name</th><th>Email</th><th>Subject</th><th>Received</th><th></th></tr>
                </thead>
                <tbody>
                    @foreach ($messages as $message)
                        <tr class="{{ $message->is_read ? '' : 'row-unread' }}">
                            <td>@if (! $message->is_read) <span class="unread-dot" title="Unread"></span> @endif</td>
                            <td><strong>{{ $message->name }}</strong></td>
                            <td>{{ $message->email }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($message->subject, 36) }}</td>
                            <td>{{ $message->created_at->format('M j, Y g:i A') }}</td>
                            <td class="table__actions">
                                <a class="btn btn--ghost btn--sm" href="{{ route('admin.messages.show', $message) }}">Open</a>
                                <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" data-confirm="Delete this message?">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn--danger btn--sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="pagination">
                {{ $messages->links() }}
            </div>
        @endif
    </div>
@endsection
