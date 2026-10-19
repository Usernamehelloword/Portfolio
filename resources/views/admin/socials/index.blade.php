@extends('admin.layouts.app')

@section('title', 'Social Links')

@section('content')
    <div class="panel">
        <div class="panel__head">
            <h2 class="panel__title">Social links</h2>
            <a class="btn btn--primary btn--sm" href="{{ route('admin.socials.create') }}">+ New link</a>
        </div>

        @if ($socials->isEmpty())
            <p class="empty-state">No social links yet. They appear in the footer (first two also in the hero).</p>
        @else
            <table class="table">
                <thead>
                    <tr><th>Label</th><th>Icon</th><th>URL</th><th>Order</th><th></th></tr>
                </thead>
                <tbody>
                    @foreach ($socials as $social)
                        <tr>
                            <td><strong>{{ $social->label }}</strong></td>
                            <td>{{ $social->icon }}</td>
                            <td><code>{{ $social->href }}</code></td>
                            <td>{{ $social->sort_order }}</td>
                            <td class="table__actions">
                                <a class="btn btn--ghost btn--sm" href="{{ route('admin.socials.edit', $social) }}">Edit</a>
                                <form method="POST" action="{{ route('admin.socials.destroy', $social) }}" data-confirm="Delete this social link?">
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
