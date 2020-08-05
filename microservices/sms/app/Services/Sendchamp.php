<?php

namespace App\Services;

use App\Http\Clients\MicroservicesRequest;
use App\Traits\MicroserviceClientHelper;

class Sendchamp
{

    use MicroserviceClientHelper;

    public function __construct()
    {
        $baseUrl = config('services.SENDCHAMP.url');
        $token = config('services.SENDCHAMP.secret_key');

        $this->client = new MicroservicesRequest($baseUrl, $token, false);
    }

    public function send()
    {
        $data = [
            'to' => '23490126727',
            'message' => 'we are simulating the sms sending to test',
            'sender_name' => 'test'
        ];

         return $this->responseBody($this->client->post('api/v1/sms/send', $data));
    }
}