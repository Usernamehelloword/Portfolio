@extends('admin.layouts.app')

@section('title', 'Projects')

@section('content')
    <div class="panel">
        <div class="panel__head">
            <h2 class="panel__title">Projects</h2>
            <a class="btn btn--primary btn--sm" href="{{ route('admin.projects.create') }}">+ New project</a>
        </div>

        @if ($projects->isEmpty())
            <p class="empty-state">No projects yet. They appear in the “Featured Work” section.</p>
        @else
            <table class="table">
                <thead>
                    <tr><th></th><th>Name</th><th>Technologies</th><th>Order</th><th></th></tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <td class="table__thumb">
                                @if ($project->image)
                                    <img src="{{ asset($project->image) }}" alt="{{ $project->name }}" width="72" height="48">
                                @else
                                    <span class="table__thumb--empty">No image</span>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $project->name }}</strong>
                                <span class="table__sub">{{ \Illuminate\Support\Str::limit($project->description, 60) }}</span>
                            </td>
                            <td>{{ \Illuminate\Support\Str::limit($project->technologies, 40) }}</td>
                            <td>{{ $project->sort_order }}</td>
                            <td class="table__actions">
                                <a class="btn btn--ghost btn--sm" href="{{ route('admin.projects.edit', $project) }}">Edit</a>
                                <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" data-confirm="Delete this project and its image?">
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
