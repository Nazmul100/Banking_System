@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Transactions and Balance</h1>
        <p>Current Balance: ${{ $currentBalance }}</p>

        <h2>All Transactions</h2>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Amount</th>
                <th>Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->id }}</td>
                    <td>{{ $transaction->transaction_type }}</td>
                    <td>${{ $transaction->amount }}</td>
                    <td>{{ $transaction->date }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
