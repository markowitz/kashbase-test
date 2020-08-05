<?php

namespace App\Http\Clients;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;

class MicroservicesRequest
{
    private $client;

    public function __construct($base_url, $token = null, $isMicroservice = true)
    {
        $this->config = ['base_uri' => $base_url];

        if(!$isMicroservice) {
            $this->config['headers'] = [
                'Authorization' => 'Bearer '.$token,
                'Content-Type'  => 'application/json',
                'Accept'        => 'application/json'
            ];
        }

        $this->client = new Client($this->config);
    }

    /**
     * Send a GET request.
     *
     * @param  string  $url
     * @param  boolean $async
     * @param array    $params
     * @return object
     */
    public function get($url, $async = false, $params = [])
    {
        $method = $async ? 'getAsync' : 'get';

        try {

            $response = $this->client->$method($url, $params);


        } catch (BadResponseException $e) {

            $response = $e->getMessage();
        }

        return $response;
    }

    /**
     * Send a post request.
     *
     * @param  string $url
     * @param  array  $params
     * @return object
     */
    public function post($url, $params = [], $multipart = false)
    {
        try {
            if ($multipart === false){
              $body = ['form_params' => $params];
            }elseif ($multipart === true) {
              $body = ['multipart' => $params];
            }

            $response = $this->client->post($url, $body);
        } catch (BadResponseException $e) {
            $response = $e->getResponse();
        }

        return $response;
    }
}