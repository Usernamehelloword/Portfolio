@extends('admin.layouts.app')

@section('title', 'Skill Groups')

@section('content')
    <div class="panel">
        <div class="panel__head">
            <h2 class="panel__title">Skill groups</h2>
            <a class="btn btn--primary btn--sm" href="{{ route('admin.skill-groups.create') }}">+ New group</a>
        </div>

        @if ($groups->isEmpty())
            <p class="empty-state">No skill groups yet. Each group is a card in the Skills section (e.g. Frontend).</p>
        @else
            <table class="table">
                <thead>
                    <tr><th>Category</th><th>Icon</th><th>Blurb</th><th>Skills</th><th>Order</th><th></th></tr>
                </thead>
                <tbody>
                    @foreach ($groups as $group)
                        <tr>
                            <td><strong>{{ $group->category }}</strong></td>
                            <td>{{ $group->icon }}</td>
                            <td>{{ $group->blurb }}</td>
                            <td>{{ $group->skills_count }}</td>
                            <td>{{ $group->sort_order }}</td>
                            <td class="table__actions">
                                <a class="btn btn--ghost btn--sm" href="{{ route('admin.skill-groups.edit', $group) }}">Manage</a>
                                <form method="POST" action="{{ route('admin.skill-groups.destroy', $group) }}" data-confirm="Delete this group and all of its skills?">
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
