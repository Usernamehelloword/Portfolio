@extends('admin.layouts.app')

@section('title', "Edit: {$group->category}")

@section('content')
    <form method="POST" action="{{ route('admin.skill-groups.update', $group) }}">
        @csrf
        @method('PUT')

        <div class="panel">
            <div class="panel__head">
                <h2 class="panel__title">Group details</h2>
            </div>

            <div class="form-grid">
                <x-admin::field name="category" label="Category name" required :value="$group->category" />
                <x-admin::select name="icon" label="Icon" required :options="array_combine($icons, array_map('ucfirst', $icons))" :selected="$group->icon" />
            </div>
            <div class="form-grid">
                <x-admin::field name="blurb" label="Short description" :value="$group->blurb" />
                <x-admin::field name="sort_order" label="Sort order" type="number" :min="0" :value="$group->sort_order" />
            </div>

            <x-admin::actions :cancel="route('admin.skill-groups.index')" />
        </div>
    </form>

    <div class="panel">
        <div class="panel__head">
            <h2 class="panel__title">Skills in “{{ $group->category }}”</h2>
            <a class="btn btn--primary btn--sm" href="{{ route('admin.skill-groups.skills.create', $group) }}">+ New skill</a>
        </div>

        @if ($group->skills->isEmpty())
            <p class="empty-state">No skills in this group yet.</p>
        @else
            <table class="table">
                <thead>
                    <tr><th>Name</th><th>Abbr</th><th>Level</th><th>Color</th><th>Order</th><th></th></tr>
                </thead>
                <tbody>
                    @foreach ($group->skills as $skill)
                        <tr>
                            <td><strong>{{ $skill->name }}</strong></td>
                            <td>{{ $skill->abbr }}</td>
                            <td>{{ $skill->level }}%</td>
                            <td><span class="color-dot" style="--dot: {{ $skill->color }}"></span><code>{{ $skill->color }}</code></td>
                            <td>{{ $skill->sort_order }}</td>
                            <td class="table__actions">
                                <a class="btn btn--ghost btn--sm" href="{{ route('admin.skill-groups.skills.edit', [$group, $skill]) }}">Edit</a>
                                <form method="POST" action="{{ route('admin.skill-groups.skills.destroy', [$group, $skill]) }}" data-confirm="Delete this skill?">
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
