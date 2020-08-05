<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

/**
 *
 */
trait RequestResponseTrait
{

    /**
     * Return JSON Response
     * @param array $data
     * @param int $code
     * @return JsonResponse
     */
    public function jsonResponse(array $data, $code = 200): JsonResponse
    {
        return response()->json(array_merge($data, ['status_code' => $code]), $code);
    }

    /**
     * Some operation (save only?) has completed successfully
     * @param mixed $data
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    public function respondWithSuccess($data = [], String $message = 'Success', int $code = 200)
    {
        return $this->jsonResponse(['message' => $message, 'data' => $data], $code);
    }

    /**
     * Respond with an Error
     * @param mixed $data
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    public function respondWithError($data = [], string $message = 'There was an error',  int $code = 400)
    {
        return $this->jsonResponse(['message' => $message, 'data' => $data], $code);
    }
}
