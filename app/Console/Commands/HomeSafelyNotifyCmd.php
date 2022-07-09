<?php

namespace App\Console\Commands;

use App\Notifications\HomeSafely;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;
use Overtrue\EasySms\PhoneNumber;
use Leonis\Notifications\EasySms\Channels\EasySmsChannel;

class HomeSafelyNotifyCmd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'homesafely:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       $safe_mobiles = config('easysms.safe_mobile');

       foreach ($safe_mobiles as $key => $mobile) {
            Notification::route(
                EasySmsChannel::class,
                new PhoneNumber($mobile, 86)
            )->notify(new HomeSafely);
       }
    }
}
