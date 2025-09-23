<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\SubscriptionHistory;
use Mail;
use App\Mail\RemindMembershipExpire;
use App\Mail\MembershipExpired;

class customcommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'membershipexpire:send-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        
        $subscription15Days = SubscriptionHistory::with('customers', 'subscriptions')->where('remaining_ads','>', 0)->where('payment_status', 'Completed')->whereDate('subscription_expiry', now()->addDays(15))->get();
        
        
        $subscription7Days = SubscriptionHistory::with('customers', 'subscriptions')->where('remaining_ads','>', 0)->where('payment_status', 'Completed')->whereDate('subscription_expiry', now()->addDays(7))->get();
        
        $subscriptionExpired = SubscriptionHistory::with('customers', 'subscriptions')->where('remaining_ads','>', 0)->where('payment_status', 'Completed')->whereDate('subscription_expiry', Carbon::yesterday())->get();
        
     
        if(isset($subscription15Days) && count($subscription15Days) > 0)
        {
            foreach ($subscription15Days as $membership) {
                if(isset($membership->customers) && isset($membership->subscriptions))
                {
                    if($membership->fifteen_days_reminder != 1)
                    {
                        $userEmail1 = $membership->customers->email;
                        $sendEmail1 = Mail::to($userEmail1)->send(new RemindMembershipExpire($membership));
                        if($sendEmail1)
                        {
                            SubscriptionHistory::where('id', $membership->id)->update(['fifteen_days_reminder'=>1]);
                        }
                    }
                    
                    
                    
                }
                
            }
        }
        if(isset($subscription7Days) && count($subscription7Days) > 0)
        {
            foreach ($subscription7Days as $membership1) {
                if(isset($membership1->customers) && isset($membership1->subscriptions))
                {
                    if($membership1->seven_days_reminder != 1)
                    {
                        $userEmail2 = $membership1->customers->email;
                        $sendEmail2 = Mail::to($userEmail2)->send(new RemindMembershipExpire($membership1));
                        if($sendEmail2)
                        {
                            SubscriptionHistory::where('id', $membership1->id)->update(['seven_days_reminder'=>1]);
                        }
                    }
                }
                
            }
        }
        if(isset($subscriptionExpired) && count($subscriptionExpired) > 0)
        {
            foreach ($subscriptionExpired as $membershipex) {
                if(isset($membershipex->customers) && isset($membershipex->subscriptions))
                {
                    if($membershipex->expired_reminder != 1)
                    {
                        $userEmail = $membershipex->customers->email;
                        $sendEmail = Mail::to($userEmail)->send(new MembershipExpired($membershipex));
                        if($sendEmail)
                        {
                            SubscriptionHistory::where('id', $membershipex->id)->update(['expired_reminder'=>1]);
                        }
                    }
                }
                
            }
        }
        
        
        

    
            $this->info('Pending order reminders sent successfully.');
        }
}
