@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Entry</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('entries.update', $entry->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="item">Item</label>
            <input type="text" class="form-control" id="item" name="item" value="{{ $entry->item }}" required>
        </div>

        <div class="form-group">
            <label for="type">Type</label>
            <select class="form-control" id="type" name="type" required>
                <option value="income" {{ $entry->type == 'income' ? 'selected' : '' }}>Income</option>
                <option value="expense" {{ $entry->type == 'expense' ? 'selected' : '' }}>Expense</option>
            </select>
        </div>

        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="text" class="form-control" id="amount" name="amount" value="{{ $entry->amount }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Entry</button>
    </form>
</div>
@endsection
