@extends('admin.layouts.app')

@section('title', 'Services')

@section('content')
    <div class="panel">
        <div class="panel__head">
            <h2 class="panel__title">Services</h2>
            <a class="btn btn--primary btn--sm" href="{{ route('admin.services.create') }}">+ New service</a>
        </div>

        @if ($services->isEmpty())
            <p class="empty-state">No services yet. They appear in the “What I Can Do” section.</p>
        @else
            <table class="table">
                <thead>
                    <tr><th>Icon</th><th>Title</th><th>Description</th><th>Order</th><th></th></tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                        <tr>
                            <td><code>{{ $service->icon }}</code></td>
                            <td><strong>{{ $service->title }}</strong></td>
                            <td>{{ \Illuminate\Support\Str::limit($service->description, 60) }}</td>
                            <td>{{ $service->sort_order }}</td>
                            <td class="table__actions">
                                <a class="btn btn--ghost btn--sm" href="{{ route('admin.services.edit', $service) }}">Edit</a>
                                <form method="POST" action="{{ route('admin.services.destroy', $service) }}" data-confirm="Delete this service?">
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
