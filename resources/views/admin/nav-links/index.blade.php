@extends('admin.layouts.app')

@section('title', 'Nav Links')

@section('content')
    <div class="panel">
        <div class="panel__head">
            <h2 class="panel__title">Navbar links</h2>
            <a class="btn btn--primary btn--sm" href="{{ route('admin.nav-links.create') }}">+ New link</a>
        </div>

        @if ($links->isEmpty())
            <p class="empty-state">No nav links yet. If the list stays empty, the navbar falls back to its default links.</p>
        @else
            <table class="table">
                <thead>
                    <tr><th>Label</th><th>Target</th><th>Order</th><th></th></tr>
                </thead>
                <tbody>
                    @foreach ($links as $link)
                        <tr>
                            <td><strong>{{ $link->label }}</strong></td>
                            <td><code>{{ $link->href }}</code></td>
                            <td>{{ $link->sort_order }}</td>
                            <td class="table__actions">
                                <a class="btn btn--ghost btn--sm" href="{{ route('admin.nav-links.edit', $link) }}">Edit</a>
                                <form method="POST" action="{{ route('admin.nav-links.destroy', $link) }}" data-confirm="Delete this nav link?">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn--danger btn--sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
