<?php declare(strict_types = 1);

namespace App\Service\HttpResponse;

interface IResponse
{
    /** @param array<string|int|float|bool> $data */
    public function getResponse(array $data, int $statusCode): string;
}
