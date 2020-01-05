<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Str;

use App\Transaction;
use App\TransactionDetail;

class TransactionController extends Controller
{
    public function store(Request $request) {
        $carts = $request->json()->all();
        $user = $request->user();
        $code = Str::random(5);

        $total = 0;

        $transaction = new Transaction();

        foreach ($carts as $cart) {
            $total += $cart['price'];
        }

        $transaction->user_id = $user->id;
        $transaction->code = $code;
        $transaction->total = $total;
        $transaction->transaction_status = "pending";

        $transaction->save();

        foreach ($carts as $cart) {
            $detail = new TransactionDetail();
            $detail->transaction_id = $transaction->id;
            $detail->product_id = $cart['id'];
            $detail->quantity = $cart['quantity'];
            $detail->price = $cart['price'];
            $detail->subtotal = $total;
            $detail->save();
        }
        
        return response()->json([
            'message' => 'Success, your transaction has been accepted with code '.$code,
            'status' => 'success',
            'code' => 200
        ], 200);
    }
}
