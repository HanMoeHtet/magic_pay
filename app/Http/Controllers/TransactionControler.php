<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class TransactionControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        return view('transactions.index', compact('user'));
    }

    public function datatable()
    {
        $query = Transaction::with(['benefactor', 'beneficiary'])
            ->where('benefactor_id', '=', Auth::id())
            ->orWhere('beneficiary_id', '=', Auth::id());

        return datatables($query)
            ->addColumn('date', function ($each) {
                return $each->created_at;
            })
            ->editColumn('id', function ($each) {
                $link = route('transactions.show', $each->id);
                return "<a href='{$link}'>{$each->id}</a>";
            })
            ->editColumn('benefactor', function ($each) {
                return "{$each->benefactor->name} ({$each->benefactor->phone_number})";
            })
            ->editColumn('beneficiary', function ($each) {
                return "{$each->beneficiary->name} ({$each->beneficiary->phone_number})";
            })
            ->rawColumns(['id'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        $benefactor = User::findOrFail($transaction->benefactor_id);
        $beneficiary = User::findOrFail($transaction->beneficiary_id);

        return view('transactions.show')->with([
            'transaction' => $transaction,
            'amount' => $transaction->amount,
            'benefactor' => $benefactor,
            'beneficiary' => $beneficiary,
            'user' => Auth::user(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
