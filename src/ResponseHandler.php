<?php

declare(strict_types=1);

namespace CurrencyConverter;

class ResponseHandler
{
    public function printConversion($response): void
    {
        $this->header();

        http_response_code(200);

        echo json_encode($response);
    }

    public function printException($message, $status_code): void
    {
        $this->header();

        http_response_code($status_code);

        echo json_encode(array('error' => $message));
    }

    private function header(): void
    {
        header('Content-Type: application/json; charset=utf-8');
    }

    public function __destruct()
    {
        exit;
    }
}
