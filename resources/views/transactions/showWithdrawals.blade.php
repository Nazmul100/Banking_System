@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Withdrawal Transactions</h1>

        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Amount</th>
                <th>Fee</th>
                <th>Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($withdrawals as $withdrawal)
                <tr>
                    <td>{{ $withdrawal->id }}</td>
                    <td>${{ $withdrawal->amount }}</td>
                    <td>${{ $withdrawal->fee }}</td>
                    <td>{{ $withdrawal->date }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
