<?php declare(strict_types = 1);

namespace App\Util;

class Responses
{
    /** @param array<string, string|int|float|bool> $data */
    public function responseJSON(array $data, int $statusCode): void
    {
        header('Content-Type: application/json; charset=utf-8;');
        http_response_code($statusCode);
        echo json_encode($data);
    }
}
