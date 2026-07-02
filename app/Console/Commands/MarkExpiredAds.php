<?php
// app/Console/Commands/MarkExpiredAds.php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Ad;

class MarkExpiredAds extends Command
{
    protected $signature = 'ads:mark-expired';
    protected $description = 'Mark ads as Expired when expire_at date has passed';

    public function handle()
    {
        $count = Ad::where('status', 'Published')
            ->whereNotNull('expire_at')
            ->where('expire_at', '<', now())
            ->update(['status' => 'Expired']);

        $this->info("{$count} ads marked as Expired.");
    }
}