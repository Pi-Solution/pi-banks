<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Bank;

use App\Transaction;

use Illuminate\Support\Facades\DB;

class BankTransactionsController extends Controller
{
    //get all transactions of one bank
    public function index($id){

        //get all transaction with same bank id
        $transaction = Transaction::where('bank_id', $id)->get();
        /*
        $transaction =  DB::table('transactions')
        ->join('partners', 'transactions.partner_id', '=', 'partners.id')
        ->select('transactions.id', 'transactions.type_of_transaction','transactions.amount', 'transactions.bank_id', 'transactions.updated_at', 'partners.name')
        ->where('bank_id', $id)
        ->get();
        */
        //dd($transaction);

        //get sum of all income
        $income = Transaction::where('bank_id', $id)
                             ->where('type_of_transaction', 1)
                             ->sum('amount');
        //get sum of all expenses
        $expenses = Transaction::where('bank_id', $id)
                             ->where('type_of_transaction', 2)
                             ->sum('amount');
        //get Bank starting balance
        $starting_balance = Bank::find($id)->starting_balance;
        //balance calculation
        $balance = $starting_balance + $income - $expenses;
        //profit calculation
        $profit = $income - $expenses;

        $data = [
            'data'      =>      $transaction,
            'balance'   =>      round($balance, 2),
            'profit'    =>      round($profit, 2)
        ];
        return $data;
    }
}
