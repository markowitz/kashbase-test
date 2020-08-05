<?php

namespace App\Traits;

trait TransferResponses
{
    protected function initiateResponse($response)
    {

        return [
            'recipient_code' => $response['data']['recipient_code'],
            'account_name' => $response['data']['details']['account_name'],
            'bank_name' => $response['data']['details']['bank_name']
        ];
    }

    protected function finalizeResponse($response)
    {
        return [
            'amount' => round($response['data']['amount']/100, 2),
            'currency' => $response['data']['currency'],
            'status' => $response['data']['status']
        ];
    }

    protected function transferResponse($response)
    {
        $data = [
            'transfer_code' => $response['data']['transfer_code'],
        ];

        return response()->json(['message' => $response['message'],
                                'data' => $data], 201);
    }


}