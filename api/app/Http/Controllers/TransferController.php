<?php

namespace App\Http\Controllers;

use App\Events\SendSms;
use App\Traits\MicroservicesClientHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class TransferController extends Controller
{
    use MicroservicesClientHelper;

    protected $client, $smsClient;

    public function __construct()
    {
        $this->client = $this->initClient('TRANSFERS');
        $this->smsClient = $this->initClient('SMS');
    }

    public function initiateTransfer(Request $request)
    {
        return $this->requestToResponse($this->client->post("initiate", $request->all()));
    }

    public function transfer(Request $request)
    {
         return $this->requestToResponse($this->client->post("send", $request->all()));
    }


    public function finalize(Request $request)
    {
        $response = $this->responseBody($this->client->post("finalize", $request->all()));

        if(Arr::get($response, 'status_code') === 200) {
            $data = [
                'to' => '08137105984', //get logged in user phone number (simulating because i did not add phone number to user registration)
                'message' => "you've successfully transfered {$response['data']['amount']}{$response['data']['currency']}",
                'sender_name' => 'test'//hardcoding this for now. should add to env and type to request
            ];

            event(new SendSms($data));
        }


        return $response;




    }
}
