@extends('admin.layouts.app')

@section('title', 'Experience')

@section('content')
    <div class="panel">
        <div class="panel__head">
            <h2 class="panel__title">Experience timeline</h2>
            <a class="btn btn--primary btn--sm" href="{{ route('admin.experiences.create') }}">+ New entry</a>
        </div>

        @if ($experiences->isEmpty())
            <p class="empty-state">No experience entries yet. They appear in the “Experience” timeline.</p>
        @else
            <table class="table">
                <thead>
                    <tr><th>Period</th><th>Title</th><th>Description</th><th>Current</th><th>Order</th><th></th></tr>
                </thead>
                <tbody>
                    @foreach ($experiences as $experience)
                        <tr>
                            <td><strong>{{ $experience->period }}</strong></td>
                            <td>{{ $experience->title }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($experience->description, 50) }}</td>
                            <td>@if ($experience->is_current) <span class="pill pill--accent">Current</span> @else — @endif</td>
                            <td>{{ $experience->sort_order }}</td>
                            <td class="table__actions">
                                <a class="btn btn--ghost btn--sm" href="{{ route('admin.experiences.edit', $experience) }}">Edit</a>
                                <form method="POST" action="{{ route('admin.experiences.destroy', $experience) }}" data-confirm="Delete this experience entry?">
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
