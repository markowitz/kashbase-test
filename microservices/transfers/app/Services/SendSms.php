<?php

namespace App\Services;

use App\Traits\MicroserviceClientHelper;

class SendSms
{

    use MicroserviceClientHelper;

    protected $client;

    public function __construct()
    {
        $this->client = $this->initClient('SMS');
    }

    public function send(array $data)
    {
        return $this->responseBody($this->client->post('api/send', $data));
    }
}