<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Str;

use App\Transaction;
use App\TransactionDetail;

class TransactionController extends Controller
{
    public function store(Request $request) {
        $carts = json_decode($request->getContent());
        $user = $request->user();
        $code = Str::random(5);

        $total = 0;

        foreach ($carts as $cart) {
            $total += $cart->price * $cart->quantity;
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
            $detail->quantity = $cart->quantity;
            $detail->price = $cart->price;
            $detail->subtotal = $cart->quantity * $cart->price;
            $detail->save();
        }

        return response()->json([
            'message' => 'Success, your transaction has been accepted with code '.$code,
            'status' => 'success',
            'data' => $code,
            'code' => 200
        ], 200);
    }
}
