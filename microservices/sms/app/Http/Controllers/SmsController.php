<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Sendchamp;

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

        return $this->champ->send($request->all());
    }
}
