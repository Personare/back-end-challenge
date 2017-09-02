<?php

namespace App\Http\Controllers;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;
use Zend\Diactoros\Response\JsonResponse;

/**
 * Class Controller
 * @package App\Http\Controllers
 */
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
    protected function response($data, $status = 200, array $headers = [], $encodingOptions = JsonResponse::DEFAULT_JSON_FLAGS): JsonResponse
    {
        return new JsonResponse($data, $status, $headers, $encodingOptions);
    }

    /**
     * @param string $message
     * @return JsonResponse
     * @throws \InvalidArgumentException
     */
    protected function responseNotFound($message = 'Not Found'): JsonResponse
    {
        return $this->response(['message' => $message], 404);
    }

    /**
     * @param array $collection
     * @param TransformerAbstract $transformer
     * @return JsonResponse
     * @throws \InvalidArgumentException
     */
    protected function responseCollection(array $collection, TransformerAbstract $transformer): JsonResponse
    {
        $fractal = new Manager();
        $resource = new Collection($collection, $transformer);

        return $this->response($fractal->createData($resource)->toArray());
    }
}