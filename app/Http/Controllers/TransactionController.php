<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Str;

use App\Model\Transaction;
use App\Model\TransactionDetail;

class TransactionController extends Controller
{
    public function store(Request $request) {
        $carts = json_decode($request->getContent());
        $user = $request->user();
        $code = Str::random(5);

        $total = 0;

        $cart_ids = collect($carts)->pluck('id');

        foreach ($carts as $cart) {
            $total += $cart->price * $cart->pivot->quantity;
        }

        $transaction = new Transaction();

        $transaction->user_id = $user->id;
        $transaction->code = $code;
        $transaction->total = $total;
        $transaction->transaction_status = "pending";

        $transaction->save();

        foreach ($carts as $cart) {
            $detail = new TransactionDetail();
            $detail->transaction_id = $transaction->id;
            $detail->product_id = $cart->id;
            $detail->quantity = $cart->pivot->quantity;
            $detail->price = $cart->pivot->price;
            $detail->save();
        }

        $user->carts()->detach($cart_ids);

        return response()->json([
            'message' => 'Success, your transaction has been accepted with code '.$code,
            'data' => $code,
            'code' => 200
        ], 200);
    }

    public function show(Request $request, $transaction_code)
    {
        $user = $request->user();

        $transaction = Transaction::where('code', $transaction_code)->where('user_id', $user->id)->first();

        return response()->json([
            'status' => 200,
            'message' => 'Transaction found',
            'data' => $transaction,
        ]);
    }

    public function get(Request $request, $transaction_code)
    {
        $transaction = Transaction::where('code', $transaction_code)->first();

        return view('detail', compact('transaction'));
    }
}
