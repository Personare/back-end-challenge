<?php

namespace App\Controllers;

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
}