<?php

namespace App\Http\Controllers\Paypal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use PayPalCheckoutSdk\Orders\OrdersGetRequest;
use App\Http\Controllers\Paypal\PaypalClient;

use App\Transaction;
use App\Log;
use App\LogLink;

class TransactionController extends Controller
{
    use PaypalPaymentTrait;

    public function payment(Request $request, $transaction_id)
    {
        $transaction = Transaction::where('code', $transaction_id)->first();

        $client_id = env('PAYPAL_CLIENT');

        return view($this->viewPrefix().'index', compact('transaction','client_id'));
    }

    public function getOrder(Request $request)
    {
        $log = new Log();

        $order_id = $request->order_id;
        $code = $request->transaction_code;
        // $id = $request->reservationId;

        $transaction = Transaction::whereCode($code)->first();

        $client = PaypalClient::client();
        $response = $client->execute(new OrdersGetRequest($order_id));

        $log->paypal_id = $response->result->id;
        $log->currency = $response->result->purchase_units[0]->amount->currency_code;
        $log->amount = $response->result->purchase_units[0]->amount->value;
        $log->status = $response->result->status;

        $log->save();

        foreach ($response->result->links as $link) {
            $log_link = new LogLink();
            $log_link->paypal_log_id = $log->id;
            $log_link->link = $link->href;
            $log_link->rel = $link->rel;
            $log_link->method = $link->method;
            $log_link->save();
        }

        // COMPLETED
        if($transaction->transaction_status == "pending"){
        
              
            if($log->status==="COMPLETED"){
                $transaction->transaction_status = 'completed'; // waiting confirmation from property
            }else{
                $reservation->transaction_status = 'completed'; // waiting confirmation from property
            }
            
            $transaction->save();
        }

        return response()->json(["message"=>"Transaction Completed"], 200);
    }
}
