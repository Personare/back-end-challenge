<?php

namespace App\Http\Response;

use App\Http\Response\Interfaces\ResponseInterface;

class JsonResponse implements ResponseInterface
{
    public function getResponse(array $data, int $statusCode): string
    {
        header('Content-Type: application/json; charset=utf-8;');
        http_response_code($statusCode);

        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}
