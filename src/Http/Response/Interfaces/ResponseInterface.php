<?php

namespace App\Http\Response\Interfaces;

interface ResponseInterface
{
    public function getResponse(array $data, int $statusCode): string;
}
