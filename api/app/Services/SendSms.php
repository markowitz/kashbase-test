<?php

namespace App\Services;

use App\Traits\MicroservicesClientHelper;

class SendSms
{

    use MicroservicesClientHelper;

    protected $client;

    public function __construct()
    {
        $this->client = $this->initClient('SMS');
    }

    public function send($data)
    {
        return $this->responseBody($this->client->post('send', $data));
    }
}