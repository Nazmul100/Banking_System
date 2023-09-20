<?php

namespace App\Http\Controllers;
use App\Models\Transaction;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function showTransactionsAndBalance()
    {
        if (auth()->check()) {
            // User is authenticated, proceed with retrieving transactions
            $user = auth()->user();
            $transactions = Transaction::where('user_id', $user->id)->get();
            $currentBalance = $user->balance;

            return view('transactions.showTransactionsAndBalance', compact('transactions', 'currentBalance'));
        }
        else {

        }


    }

    public function showDeposits()
    {
        $user = auth()->user();
        $deposits = Transaction::where('user_id', $user->id)
            ->where('transaction_type', 'Deposit')
            ->get();

        return view('transactions.showDeposits', compact('deposits'));
    }

    public function deposit(Request $request)
    {
        $user = auth()->user();
        $amount = $request->input('amount');

        // Validate the request, e.g., check if the amount is positive.

        // Update user's balance
        $user->balance += $amount;
        $user->save();

        // Create a deposit transaction record
        Transaction::create([
            'user_id' => $user->id,
            'transaction_type' => 'Deposit',
            'amount' => $amount,
            'date' => Carbon::now(),
        ]);

        return redirect()->route('transactions.showTransactionsAndBalance')
            ->with('success', 'Deposit successful');
    }

    public function showWithdrawals()
    {
        $user = auth()->user();
        $withdrawals = Transaction::where('user_id', $user->id)
            ->where('transaction_type', 'Withdrawal')
            ->get();

        return view('transactions.showWithdrawals', compact('withdrawals'));
    }

    public function withdraw(Request $request)
    {
        $user = auth()->user();
        $amount = $request->input('amount');

        // Validate the request, e.g., check if the user has sufficient balance.

        // Apply withdrawal rate based on the user's account type
        $withdrawalRate = ($user->account_type === 'Business') ? 0.025 : 0.015;
        $withdrawalFee = $amount * $withdrawalRate;

        // Implement free withdrawal conditions for Individual accounts
        if ($user->account_type === 'Individual') {
            $today = Carbon::now();
            $isFriday = ($today->dayOfWeek === Carbon::FRIDAY);
            $isFirst1KWithdrawal = ($amount <= 1000);
            $isFirst5KWithdrawalThisMonth = ($amount <= 5000 && $this->hasReached5KWithdrawalLimitThisMonth($user));

            if ($isFriday || $isFirst1KWithdrawal || $isFirst5KWithdrawalThisMonth) {
                $withdrawalFee = 0;
            }
        }

        // Deduct the withdrawal fee from the amount
        $withdrawalAmount = $amount - $withdrawalFee;

        // Update user's balance
        $user->balance -= $withdrawalAmount;
        $user->save();

        // Create a withdrawal transaction record
        Transaction::create([
            'user_id' => $user->id,
            'transaction_type' => 'Withdrawal',
            'amount' => $amount,
            'fee' => $withdrawalFee,
            'date' => Carbon::now(),
        ]);

        return redirect()->route('transactions.showTransactionsAndBalance')
            ->with('success', 'Withdrawal successful');
    }

    private function hasReached5KWithdrawalLimitThisMonth($user)
    {
        $today = Carbon::now();
        $startOfMonth = $today->startOfMonth();
        $endOfMonth = $today->endOfMonth();

        $totalWithdrawalsThisMonth = Transaction::where('user_id', $user->id)
            ->where('transaction_type', 'Withdrawal')
            ->whereBetween('date', [$startOfMonth, $endOfMonth])
            ->sum('amount');

        return ($totalWithdrawalsThisMonth >= 5000);
    }
}
