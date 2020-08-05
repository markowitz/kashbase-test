<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Sendchamp;
use Illuminate\Support\Arr;

class SmsController extends Controller
{
    protected $champ;

    public function __construct(Sendchamp $champ)
    {
        $this->champ = $champ;
    }

    public function send(Request $request)
    {
        $this->validate($request, [
            'to' => ['required', 'numeric'],
            'message' => ['required', 'min:15', 'string'],
            'sender_name' => ['required', 'string']
        ]);

        $response = $this->champ->send($request->all());

        if(Arr::get($response, "status") === "success") {
            return $this->respondWithSuccess('Message Sent', 200);
        }

        return $this->respondWithError($response['data'], $response['error'], 400);
    }
}
