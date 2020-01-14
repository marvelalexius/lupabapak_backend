<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Transaction;

class TransactionConfirmedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $transaction;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $transaction = $this->transaction;
        $user = $transaction->user;
        $this->subject($this->createSubject());
        

        // override from and reply to
        $this->to(@$user->email);
            
        $this->from('cs@lupabapak.com');

        return $this->markdown('emails.transaction', compact('transaction'));
    }

    protected function createSubject()
    {
        $transaction = $this->transaction;
        $guest = $transaction->user;
        $subject = "Booking Confirmation #{$transaction->code}";
        return $subject;
    }
}
