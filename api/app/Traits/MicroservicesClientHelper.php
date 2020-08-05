<?php

namespace App\Traits;


use App\Http\Clients\MicroserviceRequest;

trait MicroservicesClientHelper
{
     /**
     * Initialize the microservice client.
     *
     * @param  string $microservice
     * @return MicroServiceRequest
     */
    protected function initClient($microservice)
    {
        $microservice = strtoupper($microservice);

        return new MicroServiceRequest(
            env('API_'.$microservice)
        );
    }

    /**
     * Convert a guzzle request to a response.
     *
     * @param  object $request
     * @return \Illuminate\Http\Response
     */
    protected function requestToResponse($request)
    {
        if (is_string($request)) {
            abort(500, $request);
        }

        $response = json_decode($request->getBody(true), true);

        return $this->response($response);
    }

    /**
     * Return the appropriate response.
     *
     * @param  string $response
     * @return \Illuminate\Http\Response
     */
    protected function response($response)
    {
        return response($response, 200, ['content-type' => 'application/json']);
    }

    /**
     *  Get response body as Assoc Array
     */
    protected function responseBody($request)
    {
        if (is_string($request)) {
            abort(500, $request);
        }
        return json_decode($request->getBody(true), true);
    }
}