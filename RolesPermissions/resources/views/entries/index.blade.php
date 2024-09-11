@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ auth()->user()->role == 'admin' ? 'All Entries' : 'Your Entries' }}</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('entries.create') }}" class="btn btn-primary mb-3">Add New Entry</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Sl No</th>
                <th>Item</th>
                <th>Type</th>
                <th>Amount</th>
                @if(auth()->user()->role == 'admin')
                    <th>User</th>
                @endif
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($entries as $key => $entry)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $entry->item }}</td>
                    <td>{{ ucfirst($entry->type) }}</td>
                    <td>{{ $entry->amount }}</td>
                    @if(auth()->user()->role == 'admin')
                        <td>{{ $entry->user->name }}</td>
                    @endif
                    <td>
                        <a href="{{ route('entries.edit', $entry->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('entries.destroy', $entry->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    {{ $entries->links() }}
</div>
@endsection
