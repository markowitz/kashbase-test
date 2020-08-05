<?php

namespace App\Http\Controllers;

use App\Events\SendSms;
use App\Traits\MicroservicesClientHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PaymentsController extends Controller
{
    use MicroservicesClientHelper;

    public function __construct()
    {
        $this->client = $this->initClient('PAYMENTS');
    }


    public function pay(Request $request)
    {
        $response = $this->responseBody($this->client->post('pay', $request->all()));


        if(Arr::get($response, 'status_code') === 200) {
            $data = [
                'to' => '08137105984', //get logged in user phone number (simulating because i did not add phone number to user registration)
                'message' => "you've successfully made payment {$response['data']['amount']}{$response['data']['currency']}",
                'sender_name' => 'test'//hardcoding this for now. should add to env and type to request
            ];

            event(new SendSms($data));
        }

        return $response;
    }

}
