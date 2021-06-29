<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\ReceiveQrRequest;
use App\Http\Requests\TransferConfirmRequest;
use App\Http\Requests\TransferStoreRequest;
use App\Models\Transaction;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private User $user;

    public function __construct()
    {
        $this->middleware('auth:web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', ['user' => Auth::user()]);
    }

    public function profile()
    {
        return view('profile', ['user' => Auth::user()]);
    }


    public function reset_password_edit()
    {
        return view('password-reset');
    }

    public function reset_password_update(PasswordResetRequest $request)
    {
        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('home')->with('message', 'Password reset successfully.');
    }

    public function transfer_show(Request $request)
    {
        if ($request->has('phone_number')) {
            $request->flash('phone_number');
        }
        return view('transfer', ['user' => Auth::user()]);
    }

    public function transfer_confirm(TransferConfirmRequest $request)
    {
        $amount = $request->amount;
        $benefactor = $user = Auth::user();
        $beneficiary = User::where('phone_number', $request->phone_number)->first();
        return view('transfer-confirm', compact('user', 'benefactor', 'beneficiary', 'amount'));
    }

    public function transfer_store(TransferStoreRequest $request)
    {
        $benefactor = Auth::user();
        $beneficiary = User::find($request->beneficiary_id);

        DB::beginTransaction();
        try {
            $transaction = new Transaction([
                'benefactor_id' => $benefactor->id,
                'beneficiary_id' => $beneficiary->id,
                'amount' => $request->amount
            ]);
            DB::commit();
            $transaction->save();
            return redirect()->route('transactions.show', $transaction)->with('message', "Send $request->amount to $beneficiary->phone_number.");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('home')->with('errorMessage', 'An error occurred.');
        }
    }

    public function receive_qr(ReceiveQrRequest $request)
    {
        $amount = 0;
        if ($request->has('amount')) {
            $amount = $request->amount;
        }

        $user = Auth::user();
        $qr_code = base64_encode(
            QrCode::format('png')->size(200)->generate(json_encode([
                'phone_number' => $user->phone_number,
                'amount' => $amount,
            ])),
        );
        return view('receive_qr', compact('user', 'qr_code'))->with('amount', $amount);
    }

    public function scan_and_pay()
    {
        $user = Auth::user();
        return view('scan-and-pay', compact('user'));
    }
}
