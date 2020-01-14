<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Events\TransactionConfirmed;
use Carbon\Carbon;

use App\Mail\TransactionConfirmedMail;
use Mail;

class TransactionConfirmedMailing
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(TransactionConfirmed $event)
    {
        $transaction = $event->transaction;

        \Log::info('Transaction Confirmed');

        if ($transaction->isDirty('transaction_status')) {
            $origin_transaction_status = $transaction->getOriginal('transaction_status');

            if ($transaction->transaction_status == 'completed' && $origin_transaction_status == 'pending') {
                \Log::info('Queuing mail');

                $this->sendMail($transaction);
            }
        }
    }

    protected function sendMail($transaction){
        

        try{
            Mail::later(now()->addMinutes(1), new TransactionConfirmedMail($transaction));
        }catch(\Exception $e){
            \Log::error($e);
        }
    }
}
