<?php

namespace App\Services;

use App\Http\Clients\MicroserviceRequest;
use App\Traits\MicroserviceClientHelper;
use App\Traits\TransferResponses;

class Paystack
{
    use MicroserviceClientHelper, TransferResponses;

    protected $client, $headers;

    public function __construct()
    {
        $url = config('services.paystack.url');
        $token = config('services.paystack.secret_key');

        $this->client = new MicroserviceRequest($url, $token, false);
    }

    public function transfer($data)
    {

        $response = $this->responseBody($this->client->post('/transfer', $data));

        if(!$response['status']) {
            return $response;
        }

        return $this->transferResponse($response);

    }

    public function finalizeTransfer(array $data)
    {
        $response = $this->responseBody($this->client->post('/transfer/finalize_transfer', $data));

        if(!$response['status']) {
            return $response;
        }

        return $this->finalizeResponse($response);
    }

    public function pay()
    {

    }

    public function initiateTransfer($data)
    {
        $response = $this->responseBody($this->client->post('/transferrecipient', $data));

        if(!$response['status']) {
            return $response;
        }

        return $this->initiateResponse($response);
    }


}