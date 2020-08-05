<?php

namespace App\Listeners;

use App\Events\SendSms;
use App\Services\SendSms as ServicesSendSms;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendSmsNotification
{
    protected $sms;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(ServicesSendSms $sms)
    {
        $this->sms = $sms;
    }

    /**
     * Handle the event.
     *
     * @param  SendSms  $event
     * @return void
     */
    public function handle(SendSms $event)
    {
        $response = $this->sms->send($event->sms);

        \Log::info($response);
    }
}
