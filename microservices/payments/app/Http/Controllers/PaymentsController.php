<?php

namespace App\Http\Controllers;

use App\Http\Requests\InitializeRequest;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PaymentsController extends Controller
{
    protected $payment;

    public function __construct(PaymentService $payment)
    {
        $this->payment = $payment;
    }

    public function pay(InitializeRequest $request)
    {
        $validate = $request->validated();

        $response = $this->payment->pay($validate);

        if(!Arr::get($response, 'status')) {
            return $this->respondWithError('payment was not successul', 400);
        }

        return $this->respondWithSuccess($response['data'], 'payment was successful', 200);
    }
}
