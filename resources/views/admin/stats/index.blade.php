@extends('admin.layouts.app')

@section('title', 'About Stats')

@section('content')
    <div class="panel">
        <div class="panel__head">
            <h2 class="panel__title">About-page stats</h2>
            <a class="btn btn--primary btn--sm" href="{{ route('admin.stats.create') }}">+ New stat</a>
        </div>

        @if ($stats->isEmpty())
            <p class="empty-state">No stats yet. Add your first one (e.g. 3+ Years Experience).</p>
        @else
            <table class="table">
                <thead>
                    <tr><th>Value</th><th>Suffix</th><th>Label</th><th>Order</th><th></th></tr>
                </thead>
                <tbody>
                    @foreach ($stats as $stat)
                        <tr>
                            <td><strong>{{ $stat->value }}</strong></td>
                            <td>{{ $stat->suffix }}</td>
                            <td>{{ $stat->label }}</td>
                            <td>{{ $stat->sort_order }}</td>
                            <td class="table__actions">
                                <a class="btn btn--ghost btn--sm" href="{{ route('admin.stats.edit', $stat) }}">Edit</a>
                                <form method="POST" action="{{ route('admin.stats.destroy', $stat) }}" data-confirm="Delete this stat?">
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
