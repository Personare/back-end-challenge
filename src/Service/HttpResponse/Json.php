<?php declare(strict_types = 1);

namespace App\Service\HttpResponse;

class Json implements IResponse
{
    /**
     * {@inheritDoc}
     */
    public function getResponse(array $data, int $statusCode): string
    {
        header('Content-Type: application/json; charset=utf-8;');
        http_response_code($statusCode);

        return json_encode($data, \JSON_UNESCAPED_UNICODE);
    }
}
