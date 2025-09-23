<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RemindMembershipExpire extends Mailable
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
            ->subject('Subscription #'.$subId.' ('.$this->membership->subscriptions->name.') Expiry Reminder')
            ->view('email.reminderEmail')
            ->with([
                'membership' => $this->membership,
            ]);
    }
}
