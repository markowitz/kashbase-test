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

        $response = $this->paystack->initiateTransfer($requestedData);


        if(!$response['status']) {
            return $this->respondWithError($response['message'], 400);
        }

        return $this->respondWithSuccess($response['data'], $response['message'], 200);


    }

    public function transfer(TransferRequest $request)
    {
        $requestedData = $request->validated();
        $requestedData['source'] = 'balance'; //we can only tranfer from balance for now so user doesn't need to input data

        $response = $this->paystack->transfer($requestedData);

        if(!$response['status']) {
            return $this->respondWithError($response['message'], 400);
        }

        return $this->respondWithSuccess($response['data'], $response['message'], 200);
    }

    public function finalize(FinalizeTransfer $request)
    {
        $requestedData = $request->validated();

        $response = $this->paystack->finalizeTransfer($requestedData);

        if(!$response['status']) {
            return $this->respondWithError($response['message'], 400);
        }

        return $this->respondWithSuccess($response['data'], $response['message'], 200);


    }
}
