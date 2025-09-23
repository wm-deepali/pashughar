<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MembershipExpired extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($membership)
    {
        //
        $this->membership = $membership;
    }

   public function build()
    {
        $subId = $this->membership->order_number;
        return $this
            ->subject('Subscription #'.$subId.' ('.$this->membership->subscriptions->name.') Expired')
            ->view('email.subscriptionExpiredEmail')
            ->with([
                'membership' => $this->membership,
            ]);
    }
}
