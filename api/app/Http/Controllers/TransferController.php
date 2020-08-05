<?php

namespace App\Http\Controllers;

use App\Traits\MicroservicesClientHelper;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    use MicroservicesClientHelper;

    protected $client, $url;

    public function __construct()
    {
        $this->client = $this->initClient('TRANSFERS');

        $this->url = "/api/transfer";
    }

    public function initiateTransfer(Request $request)
    {
        return $this->client->post("{$this->url}/initiate", $request->all());
    }

    public function transfer(Request $request)
    {
        return $this->client->post("{$this->url}", $request->all());
    }

    public function finalize(Request $request)
    {
        return $this->client->post("{$this->url}/finalize", $request->all());
    }
}
