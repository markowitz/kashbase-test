<?php

namespace App\Http\Controllers;

use App\Traits\MicroservicesClientHelper;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    use MicroservicesClientHelper;

    protected $client;

    public function __construct()
    {
        $this->client = $this->initClient('TRANSFERS');
    }

    public function initiateTransfer(Request $request)
    {
        return $this->client->post("initiate", $request->all());
    }

    public function transfer(Request $request)
    {
        return $this->client->post("send", $request->all());
    }

    public function finalize(Request $request)
    {
        return $this->client->post("finalize", $request->all());
    }
}
