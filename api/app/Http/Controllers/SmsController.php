<?php

namespace App\Http\Controllers;

use App\Traits\MicroservicesClientHelper;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    use MicroservicesClientHelper;

    protected $client, $url;

    public function __construct()
    {
        $this->client = $this->initClient('SMS');
    }

    public function send(Request $request)
    {
        return $this->client->post("send", $request->all());
    }
}
