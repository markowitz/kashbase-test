<?php

namespace App\Http\Controllers;

use App\Http\Requests\FinalizeTransfer;
use App\Http\Requests\InitiateTransfer;
use App\Http\Requests\TransferRequest;
use App\Services\Paystack;
use App\Services\SendSms;
use Illuminate\Http\Request;

class TransfersController extends Controller
{
    protected $paystack, $sms;

    public function __construct(Paystack $paystack, SendSms $sms)
    {
        $this->paystack = $paystack;
        $this->sms = $sms;
    }


    public function initiate(InitiateTransfer $request)
    {
        $requestedData = $request->validated();

        return $this->paystack->initiateTransfer($requestedData);

    }

    public function transfer(TransferRequest $request)
    {
        $requestedData = $request->validated();
        $requestedData['source'] = 'balance'; //we can only tranfer from balance for now so user doesn't need to input data

        return $this->paystack->transfer($requestedData);
    }

    public function finalize(FinalizeTransfer $request)
    {
        $requestedData = $request->validated();

        $response = $this->paystack->finalizeTransfer($requestedData);

        if(!$response['status']) {
            return response()->json(['message' => $response['message']], 400);
        }
        $data = [
            'to' => '08137105984', //get logged in user phone number (simulating because i did not add phone number to user registration)
            'message' => "you've successfully transfered {$response['amount']}{$response['currency']}",
            'sender_name' => 'test'//hardcoding this for now. should add to env and type to request
        ];

        $sms = $this->sms->send($data);

        //i'm logging this for now. naturally there should be like an error log in  the sms microservice that will log if there's any error
        //we can also make this a job. should incase it fails, you can fix why it failed and retry job again
        //as long as the payment went through we should flash a successful message t
        \Log::info($sms);

        return response()->json(['message' => 'transfer successful'], 200);


    }
}
