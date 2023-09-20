@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Deposit Transactions</h1>

        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Amount</th>
                <th>Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($deposits as $deposit)
                <tr>
                    <td>{{ $deposit->id }}</td>
                    <td>${{ $deposit->amount }}</td>
                    <td>{{ $deposit->date }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
