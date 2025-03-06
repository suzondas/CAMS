@extends('layouts.default')

@section('content')
    <div class="container">
        <h2>Transactions</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('transactions.create') }}" class="btn btn-primary mb-3">Add Transaction</a>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Bank</th>
                <th>Date</th>
                <th>Number</th>
                <th>Amount</th>
                <th>User</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->id }}</td>
                    <td>{{ $transaction->transaction_type }}</td>
                    <td>{{ $transaction->bank_name }}</td>
                    <td>{{ $transaction->transaction_date }}</td>
                    <td>{{ $transaction->transaction_number }}</td>
                    <td>{{ $transaction->transaction_amount }}</td>
                    <td>{{ $transaction->user->email }}</td>
                    <td>
                    <span class="badge {{ $transaction->transaction_status ? 'badge-success' : 'badge-danger' }}">
                        {{ $transaction->transaction_status ? 'Completed' : 'Pending' }}
                    </span>
                    </td>
                    <td>
                        <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $transactions->links() }}
    </div>
@endsection
