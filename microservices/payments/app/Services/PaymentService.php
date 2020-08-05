<?php

namespace App\Services;

use App\Http\Clients\MicroserviceRequest;
use App\Traits\MicroservicesClientHelper;
use Illuminate\Support\Arr;

class PaymentService
{
    use MicroservicesClientHelper;

    protected $client;

    public function __construct()
    {
        $url = config('services.paystack.url');
        $token = config('services.paystack.secret_key');

        $this->client =   new MicroserviceRequest($url, $token, false);

    }


    public function pay(array $data)
    {
        $response = $this->responseBody($this->client->post('/transaction/initialize', $data));

        if(!Arr::get($response, 'status')) {
            return $response;
        }

        return $this->verify($response['data']['reference']);


    }


    protected function verify($reference)
    {
        return $this->responseBody($this->client->get("/transaction/verify/{$reference}"));
    }
}