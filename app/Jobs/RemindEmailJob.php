<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;
use App\Mail\RemindMembershipExpire;

class RemindEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $membership;

    /**
     * Create a new job instance.
     */
    public function __construct($membership)
    {
        //
        $this->membership = $membership;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        $userEmail = $this->membership->customers->email;
        $email = new RemindMembershipExpire($this->membership);
        Mail::to($userEmail)->send($email);
    }
}
