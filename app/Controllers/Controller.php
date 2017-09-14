<?php

namespace App\Controllers;

use App\Exceptions\Exception;
use Zend\Diactoros\Response\JsonResponse;

class Controller
{
    /**
     * @param $data
     * @param int $status
     * @param array $headers
     * @param int $encodingOptions
     * @return JsonResponse
     * @throws \InvalidArgumentException
     */
    protected function response($data, $status = 200, array $headers = [], $encodingOptions = JsonResponse::DEFAULT_JSON_FLAGS)
    {
        return new JsonResponse($data, $status, $headers, $encodingOptions);
    }

    /**
     * @param \Exception $exception
     * @return JsonResponse
     * @throws \InvalidArgumentException
     */
    protected function responseException(\Exception $exception)
    {
        $data = ['error' => 'Unexpected Error'];

        if ($exception instanceof Exception) {
            $data = ['error' => $exception->getMessage()];
        }

        return $this->response($data, 500);
    }
}